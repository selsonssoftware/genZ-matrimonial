<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminTopbarBackendTest extends TestCase
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
            $table->string('role')->default('admin');
            $table->string('password');
            $table->timestamp('created_date')->nullable();
            $table->timestamp('updated_date')->nullable();
        });
        Schema::connection('sqlite')->create('users', function ($table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('verification_status')->default('pending');
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('app_settings', function ($table): void {
            $table->id();
            $table->string('setting_key')->unique();
            $table->longText('setting_value')->nullable();
            $table->timestamps();
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

    public function test_notification_dropdown_shows_pending_profiles_from_database(): void
    {
        $this->signInAdmin();

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Pending Member', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Approved Member', 'created_at' => now(), 'updated_at' => now()],
        ]);
        DB::table('profiles')->insert([
            [
                'id' => 31,
                'user_id' => 1,
                'profile_id' => 'TM-31',
                'verification_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 32,
                'user_id' => 2,
                'profile_id' => 'TM-32',
                'verification_status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->view('layout')
            ->assertSee('1 pending')
            ->assertSee('Pending Member')
            ->assertDontSee('Approved Member')
            ->assertSee('status=pending', false)
            ->assertSee('id=31', false);
    }

    public function test_admin_can_open_change_password_and_save_a_new_password(): void
    {
        $this->signInAdmin();
        $this->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'CurrentPass123',
        ])->assertRedirect('/admin/dashboard');

        $this->get(route('change.password'))
            ->assertOk()
            ->assertSee(route('change.password.update'))
            ->assertSee('name="new_password"', false)
            ->assertSee('name="new_password_confirmation"', false)
            ->assertDontSee('name="current_password"', false);

        $this->from(route('change.password'))
            ->post(route('change.password.update'), [
                'new_password' => 'x',
                'new_password_confirmation' => 'different',
            ])
            ->assertRedirect(route('change.password'))
            ->assertSessionHasErrors([
                'new_password' => 'The confirmation password does not match.',
            ]);

        $this->from(route('change.password'))
            ->post(route('change.password.update'), [
                'new_password' => 'x',
                'new_password_confirmation' => 'x',
            ])
            ->assertRedirect(route('change.password'))
            ->assertSessionHas('success');

        $this->post(route('logout'))->assertRedirect(route('login'));

        $this->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'CurrentPass123',
        ])->assertSessionHasErrors('login');

        $this->post(route('login.submit'), [
            'login' => 'admin@example.test',
            'password' => 'x',
        ])->assertRedirect('/admin/dashboard');

        $this->assertTrue(Hash::check(
            'x',
            DB::table('admin')->where('id', 1)->value('password')
        ));
    }

    public function test_admin_can_change_own_password_without_settings_permissions(): void
    {
        $this->signInAdmin('support');
        DB::table('app_settings')->insert([
            'setting_key' => 'role_permissions',
            'setting_value' => json_encode([
                'support' => [
                    'settings' => [
                        'view' => false,
                        'edit' => false,
                    ],
                ],
            ], JSON_THROW_ON_ERROR),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->get(route('change.password'))->assertOk();

        $this->from(route('change.password'))
            ->post(route('change.password.update'), [
                'new_password' => 'x',
                'new_password_confirmation' => 'x',
            ])
            ->assertRedirect(route('change.password'))
            ->assertSessionHas('success');
    }

    public function test_change_password_requires_an_authenticated_admin(): void
    {
        $this->get(route('change.password'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_dashboard_does_not_show_admin_menu_before_login(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect(route('login'));
    }

    public function test_login_page_uses_the_public_favicon(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee(asset('favicon.ico'));
    }

    private function signInAdmin(string $role = 'admin'): void
    {
        DB::table('admin')->insert([
            'id' => 1,
            'name' => 'Test Admin',
            'mailid' => 'admin@example.test',
            'role' => $role,
            'password' => Hash::make('CurrentPass123'),
            'created_date' => now(),
            'updated_date' => now(),
        ]);

        $this->actingAs(Admin::findOrFail(1), 'admin');
    }
}
