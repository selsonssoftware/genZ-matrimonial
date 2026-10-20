<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MatrimonyMasterDataTest extends TestCase
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
            $table->timestamps();
        });
        Schema::connection('sqlite')->create('users', function ($table): void {
            $table->id();
            $table->string('name')->nullable();
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

    public function test_master_data_page_loads_with_database_filters(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->get(route('admin.matrimonymasterdata', [
            'religion' => 'Hindu',
            'age_from' => 18,
        ]))
            ->assertOk()
            ->assertSee('Matrimony Master Data')
            ->assertSee('Christian')
            ->assertSee('Muslim')
            ->assertSee('Jain')
            ->assertSee('Mesham')
            ->assertSee('Revathi')
            ->assertSee('Bharadwaja')
            ->assertSee('Photo available only')
            ->assertSee('Showing');
    }

    public function test_master_data_export_returns_csv(): void
    {
        $this->actingAs((new Admin)->forceFill(['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.test', 'role' => 'admin']), 'admin');

        $this->get(route('admin.matrimonymasterdata.export', [
            'status' => 'approved',
        ]))
            ->assertOk()
            ->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }
}
