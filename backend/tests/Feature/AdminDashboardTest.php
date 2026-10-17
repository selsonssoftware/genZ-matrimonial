<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
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

        Schema::connection('sqlite')->create('users', function ($table): void {
            $table->id();
            $table->string('name')->nullable();
            $table->string('role')->nullable();
            $table->string('member_id')->nullable();
            $table->timestamps();
        });

        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('verification_status')->nullable();
            $table->timestamps();
        });

        Schema::connection('sqlite')->create('profile_photos', function ($table): void {
            $table->id();
            $table->string('profile_id');
        });

        Schema::connection('sqlite')->create('vendor', function ($table): void {
            $table->id();
            $table->string('status');
        });

        Schema::connection('sqlite')->create('subscriptions', function ($table): void {
            $table->id();
            $table->decimal('amount', 10, 2);
        });

        Schema::connection('sqlite')->create('user_subscriptions', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->string('payment_status');
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

    public function test_dashboard_displays_live_metrics_queue_chart_and_recent_profiles(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 99, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'member_id' => 'AD-1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Recent Member', 'role' => 'user', 'member_id' => 'TM-100', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Another Member', 'role' => 'user', 'member_id' => 'TM-101', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Last Month Member', 'role' => 'user', 'member_id' => 'TM-099', 'created_at' => now()->subMonthNoOverflow()->startOfMonth()->addDay(), 'updated_at' => now()],
        ]);

        DB::table('profiles')->insert([
            ['id' => 1, 'user_id' => 2, 'profile_id' => 'P-100', 'gender' => 'Female', 'city' => 'Chennai', 'verification_status' => 'pending', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'user_id' => 3, 'profile_id' => 'P-101', 'gender' => 'Male', 'city' => 'Salem', 'verification_status' => 'pending', 'created_at' => now()->subDays(2), 'updated_at' => now()],
            ['id' => 3, 'user_id' => 4, 'profile_id' => 'P-099', 'gender' => 'Male', 'city' => 'Madurai', 'verification_status' => 'approved', 'created_at' => now()->subMonthNoOverflow()->startOfMonth()->addDay(), 'updated_at' => now()],
        ]);
        DB::table('profile_photos')->insert(['profile_id' => 'P-100']);

        DB::table('vendor')->insert([
            ['id' => 1, 'status' => 'Active'],
            ['id' => 2, 'status' => 'Pending'],
            ['id' => 3, 'status' => 'Pending'],
        ]);
        DB::table('subscriptions')->insert([
            ['id' => 1, 'amount' => 1200],
            ['id' => 2, 'amount' => 600],
        ]);
        DB::table('user_subscriptions')->insert([
            ['id' => 1, 'subscription_id' => 1, 'payment_status' => 'paid', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'subscription_id' => 2, 'payment_status' => 'success', 'created_at' => now()->subMonthNoOverflow()->startOfMonth()->addDay(), 'updated_at' => now()],
        ]);

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('3', false)
            ->assertSee('+100.0% new members vs last month')
            ->assertSee('2', false)
            ->assertSee('1,200.00')
            ->assertSee('+100.0% vs last month')
            ->assertSee('Photo verification')
            ->assertSee('Pending profiles without photo')
            ->assertSee('Recent Member')
            ->assertSee('TM-100')
            ->assertSee('data: [0,0,0,0,0,1,2]', false);
    }
}
