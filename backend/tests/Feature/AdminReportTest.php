<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminReportTest extends TestCase
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
            $table->string('member_id')->nullable();
            $table->timestamp('created_at')->nullable();
        });
        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('city')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('verification_status')->nullable();
            $table->timestamp('created_at')->nullable();
        });
        Schema::connection('sqlite')->create('subscriptions', function ($table): void {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
        });
        Schema::connection('sqlite')->create('user_subscriptions', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('profile_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('created_at')->nullable();
        });
        Schema::connection('sqlite')->create('vendor_customer_assignments', function ($table): void {
            $table->id();
            $table->timestamp('assigned_at')->nullable();
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

    public function test_report_page_loads_live_analytics(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->get(route('admin.report'))
            ->assertOk()
            ->assertSee('New Registrations')
            ->assertSee('Profile completions')
            ->assertSee('Membership sales')
            ->assertSee('Vendor sourced leads')
            ->assertSee('Registration Trend')
            ->assertSee('Profile Distribution')
            ->assertSee('Recent Membership Transactions');
    }

    public function test_report_filters_keep_the_selected_period_and_search(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->get(route('admin.report', [
            'period' => 'last_month',
            'search' => 'no-matching-report-transaction',
        ]))
            ->assertOk()
            ->assertSee('No transactions found for this filter.')
            ->assertSee('value="last_month"', false)
            ->assertSee('value="no-matching-report-transaction"', false);
    }
}
