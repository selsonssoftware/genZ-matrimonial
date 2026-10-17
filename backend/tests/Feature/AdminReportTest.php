<?php

namespace Tests\Feature;

use App\Models\Admin;
use Tests\TestCase;

class AdminReportTest extends TestCase
{
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
