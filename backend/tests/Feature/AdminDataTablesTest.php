<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminDataTablesTest extends TestCase
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
            $table->string('name');
            $table->string('member_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('city')->nullable();
            $table->string('plan')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('profiles', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('profile_id');
            $table->string('gender')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->decimal('height', 6, 2)->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('community')->nullable();
            $table->string('city')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('verification_status')->default('pending');
            $table->timestamps();
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
        Schema::connection('sqlite')->create('vendor', function ($table): void {
            $table->id();
            $table->string('agent_name');
            $table->string('vendor_mobile')->nullable();
            $table->string('city');
            $table->string('status');
            $table->decimal('commission', 10, 2)->default(0);
        });
        Schema::connection('sqlite')->create('vendor_logins', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('email');
        });
        Schema::connection('sqlite')->create('vendor_customer_assignments', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->string('profile_id');
            $table->timestamp('assigned_at')->nullable();
        });
        Schema::connection('sqlite')->create('interests', function ($table): void {
            $table->id();
            $table->string('profile_id')->nullable();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('status');
            $table->timestamp('created_at')->nullable();
        });
        Schema::connection('sqlite')->create('subscriptions', function ($table): void {
            $table->id();
            $table->string('profile_id')->nullable();
            $table->string('plan_name');
            $table->decimal('amount', 10, 2);
            $table->unsignedInteger('validity_days')->nullable();
            $table->text('features')->nullable();
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('user_subscriptions', function ($table): void {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('subscription_id');
            $table->string('profile_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });

        $this->actingAs(
            (new Admin)->forceFill([
                'id' => 99,
                'name' => 'Test Admin',
                'email' => 'admin@example.test',
                'role' => 'admin',
            ]),
            'admin'
        );

        $this->seedTableRows();
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

    public function test_requested_data_tables_render_all_matching_rows_for_datatables(): void
    {
        $this->get(route('admin.vendors.index'))
            ->assertOk()
            ->assertSee('id="vendorDirectoryTable"', false)
            ->assertSee('data-page-length="10"', false)
            ->assertSee('VN-00011');

        $this->get(route('admin.matches-interests'))
            ->assertOk()
            ->assertSee('data-page-length="10"', false)
            ->assertSee('IN-00011');

        $this->get(route('admin.membership'))
            ->assertOk()
            ->assertSee('data-page-length="10"', false)
            ->assertSee('TXN-11');

        $this->get(route('admin.matrimonymasterdata'))
            ->assertOk()
            ->assertSee('data-page-length="10"', false)
            ->assertSee('Showing all 11 matching members')
            ->assertSee('TM-011');

        $this->get(route('admin.report', ['period' => 'all']))
            ->assertOk()
            ->assertSee('data-page-length="10"', false)
            ->assertSee('TXN-11');
    }

    private function seedTableRows(): void
    {
        DB::table('subscriptions')->insert([
            'id' => 1,
            'profile_id' => 'PLAN-1',
            'plan_name' => 'Premium',
            'amount' => 1000,
            'validity_days' => 30,
            'features' => 'Premium features',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($id = 1; $id <= 11; $id++) {
            $memberId = sprintf('TM-%03d', $id);
            DB::table('users')->insert([
                'id' => $id,
                'name' => sprintf('Member %02d', $id),
                'member_id' => $memberId,
                'email' => sprintf('member%02d@example.test', $id),
                'phone' => sprintf('555%07d', $id),
                'gender' => $id % 2 === 0 ? 'Female' : 'Male',
                'age' => 25,
                'city' => 'Chennai',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('profiles')->insert([
                'id' => $id,
                'user_id' => $id,
                'profile_id' => $memberId,
                'gender' => $id % 2 === 0 ? 'Female' : 'Male',
                'age' => 25,
                'height' => 165,
                'religion' => 'Hindu',
                'caste' => 'Community',
                'community' => 'Community',
                'city' => 'Chennai',
                'marital_status' => 'Never Married',
                'verification_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('vendor')->insert([
                'id' => $id,
                'agent_name' => sprintf('Vendor %02d', $id),
                'city' => 'Chennai',
                'status' => 'Active',
                'commission' => 100,
            ]);
            DB::table('vendor_logins')->insert([
                'vendor_id' => $id,
                'email' => sprintf('vendor%02d@example.test', $id),
            ]);
            DB::table('vendor_customer_assignments')->insert([
                'vendor_id' => $id,
                'profile_id' => $memberId,
                'assigned_at' => now(),
            ]);
            DB::table('interests')->insert([
                'id' => $id,
                'profile_id' => $memberId,
                'sender_id' => $id,
                'receiver_id' => $id,
                'status' => 'Pending',
                'created_at' => now(),
            ]);
            DB::table('user_subscriptions')->insert([
                'user_id' => $id,
                'subscription_id' => 1,
                'profile_id' => $memberId,
                'transaction_id' => sprintf('TXN-%02d', $id),
                'payment_status' => 'paid',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
