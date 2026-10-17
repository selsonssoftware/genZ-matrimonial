<?php

namespace Tests\Feature;

use App\Models\Admin;
use Tests\TestCase;

class MatrimonyMasterDataTest extends TestCase
{
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
