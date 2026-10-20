<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MatrimonyMasterBulkReviewTest extends TestCase
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

        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->decimal('height', 6, 2)->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('community')->nullable();
            $table->string('city')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('verification_status')->default('pending');
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('users', function ($table): void {
            $table->id();
            $table->string('name');
            $table->string('member_id')->nullable();
            $table->string('phone')->nullable();
        });
        Schema::connection('sqlite')->create('profile_photos', function ($table): void {
            $table->id();
            $table->string('profile_id');
            $table->string('image')->nullable();
            $table->boolean('is_primary')->default(false);
        });
        Schema::connection('sqlite')->create('horoscope_details', function ($table): void {
            $table->id();
            $table->string('profile_id');
            $table->string('rasi')->nullable();
            $table->string('star')->nullable();
            $table->string('gothram')->nullable();
        });
        Schema::connection('sqlite')->create('education_details', function ($table): void {
            $table->id();
            $table->string('profile_id');
            $table->string('qualification')->nullable();
        });
        Schema::connection('sqlite')->create('vendor_customer_assignments', function ($table): void {
            $table->id();
            $table->string('profile_id');
            $table->unsignedBigInteger('vendor_id');
        });
        Schema::connection('sqlite')->create('vendor', function ($table): void {
            $table->id();
            $table->string('agent_name');
        });

        $this->actingAs(
            (new Admin)->forceFill(['id' => 7, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']),
            'admin'
        );
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

    public function test_bulk_action_updates_selected_profiles_and_keeps_the_current_filters(): void
    {
        DB::table('profiles')->insert([
            ['id' => 11, 'profile_id' => 'TM-11', 'verification_status' => 'pending'],
            ['id' => 12, 'profile_id' => 'TM-12', 'verification_status' => 'pending'],
            ['id' => 13, 'profile_id' => 'TM-13', 'verification_status' => 'pending'],
        ]);

        $this->post(route('admin.matrimonymasterdata.bulk-review', ['status' => 'pending']), [
            'ids' => [11, 12],
            'decision' => 'approved',
        ])
            ->assertRedirect(route('admin.matrimonymasterdata', ['status' => 'pending']))
            ->assertSessionHas('success', '2 profile(s) updated.');

        $this->assertSame('approved', DB::table('profiles')->where('id', 11)->value('verification_status'));
        $this->assertSame('approved', DB::table('profiles')->where('id', 12)->value('verification_status'));
        $this->assertSame('pending', DB::table('profiles')->where('id', 13)->value('verification_status'));
        $this->assertSame(7, DB::table('profiles')->where('id', 11)->value('reviewed_by'));
    }

    public function test_view_link_opens_the_selected_profiles_own_verification_status_page(): void
    {
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Pending Member',
            'member_id' => 'TM-11',
        ]);
        DB::table('profiles')->insert([
            'id' => 11,
            'user_id' => 5,
            'profile_id' => 'TM-11',
            'verification_status' => 'pending',
        ]);

        $this->get(route('admin.matrimonymasterdata'))
            ->assertOk()
            ->assertSee(route('admin.profile-verification.index', [
                'status' => 'pending',
                'id' => 11,
            ]));
    }

    public function test_bulk_action_requires_at_least_one_profile_and_a_valid_decision(): void
    {
        DB::table('profiles')->insert([
            'id' => 11,
            'profile_id' => 'TM-11',
            'verification_status' => 'pending',
        ]);

        $this->post(route('admin.matrimonymasterdata.bulk-review'), [
            'decision' => 'approved',
        ])->assertSessionHasErrors('ids');

        $this->post(route('admin.matrimonymasterdata.bulk-review'), [
            'ids' => [11],
            'decision' => 'invalid',
        ])->assertSessionHasErrors('decision');

        $this->assertSame('pending', DB::table('profiles')->where('id', 11)->value('verification_status'));
    }
}
