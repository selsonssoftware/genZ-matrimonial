<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    private string $originalConnection;

    private array $originalSqliteConfig;

    protected function setUp(): void
    {
        parent::setUp();

        $this->originalConnection = config('database.default');
        $this->originalSqliteConfig = config('database.connections.sqlite');
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');

        Schema::connection('sqlite')->create('admin', function ($table): void {
            $table->id();
            $table->string('name');
            $table->string('mailid')->unique();
            $table->string('password');
            $table->timestamp('created_date')->nullable();
            $table->timestamp('updated_date')->nullable();
        });
    }

    protected function tearDown(): void
    {
        DB::purge('sqlite');
        config([
            'database.default' => $this->originalConnection,
            'database.connections.sqlite' => $this->originalSqliteConfig,
        ]);

        parent::tearDown();
    }

    public function test_admin_profile_login_redirect_returns_to_the_requested_page(): void
    {
        $this->get(route('admin.setting'))
            ->assertRedirect(route('login'));

        $this->get(route('admin.profile-verification.index'))
            ->assertRedirect(route('login'));

        $this->actingAs((new Admin)->forceFill(['id' => 1]), 'admin');

        $this->get(route('login'))
            ->assertRedirect(route('admin.profile-verification.index'));
    }

    public function test_authenticated_user_visiting_login_is_sent_to_admin_dashboard(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 1]), 'admin')
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }

    public function test_login_form_posts_to_the_current_host(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('action="/login"', false);
    }

    public function test_successful_admin_login_always_redirects_to_dashboard(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => Hash::make('password'),
        ]);

        $this->withSession([
            'url.intended' => route('admin.profile-verification.index'),
        ])->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_can_log_in_with_a_case_insensitive_name(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => Hash::make('password'),
        ]);

        $this->post(route('login.submit'), [
            'login' => 'admin',
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_can_log_in_when_admin_table_has_no_name_column(): void
    {
        Schema::connection('sqlite')->table('admin', function ($table): void {
            $table->dropColumn('name');
        });

        $admin = Admin::create([
            'email' => 'admin@example.test',
            'password' => Hash::make('password'),
        ]);

        $this->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_successful_login_hashes_a_legacy_plain_text_password(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'old-password',
        ]);

        $this->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'old-password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($admin, 'admin');
        $this->assertNotSame('old-password', $admin->fresh()->password);
        $this->assertTrue(Hash::check('old-password', $admin->fresh()->password));
    }
}
