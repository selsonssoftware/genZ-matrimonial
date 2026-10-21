@extends('layout')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .reports-page {
            --primary: #561325;
            --primary-dark: #42101d;
            --primary-light: #fcecee;
            --accent: #e8c5cd;
            --gold: #d0a044;
            --background: #f8f4f5;
            --white: #ffffff;
            --text: #42101d;
            --muted: #897b80;
            --border: #f3e5e8;
            --success: #258552;
            --danger: #c94d58;
            --shadow: 0 3px 15px rgba(81, 23, 43, 0.04);
        }

        .reports-page,
        .reports-page * {
            box-sizing: border-box;
        }

        .reports-page {
            background: var(--background);
            color: var(--text);
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            font-size: 14px;
        }

        .reports-page button,
        .reports-page input,
        .reports-page select {
            font: inherit;
        }

        .reports-page button {
            cursor: pointer;
        }

        .reports-page {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
            padding: 24px;
        }

        /* Header */

        .reports-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .reports-page .header-title h1 {
            margin: 0 0 7px;
            color: var(--primary-dark);
            font-size: 27px;
            font-weight: 750;
            letter-spacing: -0.6px;
        }

        .reports-page .header-title p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .reports-page .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .report-search {
            display: flex;
            gap: 7px;
        }

        .report-search input {
            min-width: 180px;
            padding: 9px 11px;
            border: 1px solid var(--border);
            border-radius: 7px;
            color: var(--text);
            font-size: 12px;
        }

        .reports-page .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 10px 16px;
            border: 1px solid transparent;
            border-radius: 7px;
            font-weight: 600;
            font-size: 12px;
            transition: 0.2s ease;
        }

        .reports-page .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .reports-page .btn-primary:hover {
            background: var(--primary-dark);
        }

        .reports-page .btn-outline {
            background: var(--white);
            border-color: var(--border);
            color: var(--primary);
        }

        .reports-page .btn-outline:hover {
            background: var(--primary-light);
        }

        /* Filters */

        .reports-page .filter-panel {
            display: flex;
            align-items: end;
            flex-wrap: wrap;
            gap: 15px;
            padding: 17px;
            margin-bottom: 20px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow);
        }

        .reports-page .filter-field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            min-width: 150px;
        }

        .reports-page .filter-field label {
            color: #7c6870;
            font-size: 11px;
            font-weight: 650;
        }

        .reports-page .filter-field input,
        .reports-page .filter-field select {
            width: 100%;
            min-height: 39px;
            padding: 9px 11px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 6px;
            outline: none;
            color: var(--text);
            font-size: 12px;
        }

        .reports-page .filter-field input:focus,
        .reports-page .filter-field select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(121, 33, 61, 0.07);
        }

        .reports-page .date-range {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reports-page .date-range input {
            min-width: 135px;
        }

        .reports-page .date-separator {
            color: var(--muted);
            font-size: 12px;
        }

        .reports-page .filter-actions {
            display: flex;
            gap: 8px;
            margin-left: auto;
        }

        /* Summary cards */

        .reports-page .report-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .reports-page .report-card {
            position: relative;
            min-width: 0;
            padding: 19px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .reports-page .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(81, 23, 43, 0.07);
        }

        .reports-page .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 17px;
        }

        .reports-page .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 10px;
            font-size: 19px;
        }

        .reports-page .card-change {
            padding: 5px 7px;
            background: #eaf6ee;
            color: var(--success);
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .reports-page .card-label {
            margin: 0 0 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .reports-page .card-value {
            margin: 0 0 8px;
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -0.6px;
            overflow-wrap: anywhere;
        }

        .reports-page .card-description {
            margin: 0;
            color: #9b8e93;
            font-size: 11px;
        }

        /* Charts */

        .reports-page .charts-grid {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .reports-page .report-panel {
            min-width: 0;
            padding: 21px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow);
        }

        .reports-page .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }

        .reports-page .panel-header h2 {
            margin: 0 0 6px;
            color: var(--primary-dark);
            font-size: 15px;
            font-weight: 750;
        }

        .reports-page .panel-header p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .reports-page .chart-period {
            padding: 7px 9px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            color: var(--primary);
            font-size: 11px;
        }

        .reports-page .chart-container {
            position: relative;
            width: 100%;
            height: 245px;
        }

        /* Vendor table */

        .reports-page .vendor-panel {
            margin-bottom: 20px;
        }

        .reports-page .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
        }

        .reports-page .table-toolbar h2 {
            margin: 0 0 5px;
            color: var(--primary-dark);
            font-size: 15px;
        }

        .reports-page .table-toolbar p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .reports-page .table-search {
            width: 220px;
            max-width: 100%;
            min-height: 37px;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            outline: none;
            font-size: 12px;
        }

        .reports-page .table-search:focus {
            border-color: var(--primary);
        }

        .reports-page .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .reports-page .report-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        .reports-page .report-table thead {
            background: #f8f1f3;
        }

        .reports-page .report-table th {
            padding: 14px 13px;
            color: #795263;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 0.35px;
        }

        .reports-page .report-table td {
            padding: 15px 13px;
            border-bottom: 1px solid #f0e8eb;
            color: #67535c;
            font-size: 12px;
        }

        .reports-page .report-table tbody tr:last-child td {
            border-bottom: none;
        }

        .reports-page .report-table tbody tr:hover {
            background: #fdf9fa;
        }

        .reports-page .vendor-id {
            color: var(--primary);
            font-weight: 750;
        }

        .reports-page .agent-cell {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .reports-page .commission {
            color: var(--primary);
            font-weight: 750;
        }

        .reports-page .conversion-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            background: #eaf6ee;
            color: var(--success);
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
        }

        .reports-page .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 11px;
        }

        .reports-page .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .reports-page .page-btn {
            width: 30px;
            height: 30px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            color: var(--primary);
        }

        .reports-page .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .reports-page .empty-state {
            padding: 28px !important;
            text-align: center;
            color: var(--muted) !important;
        }

        /* Toast message */

        .reports-page .report-toast {
            position: fixed;
            right: 24px;
            bottom: 24px;
            z-index: 9999;
            max-width: calc(100vw - 32px);
            padding: 14px 19px;
            background: var(--primary-dark);
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.15);
            font-size: 13px;
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: 0.25s ease;
        }

        .reports-page .report-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */

        @media (max-width: 1200px) {
            .reports-page .report-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .reports-page .filter-actions {
                margin-left: 0;
            }
        }

        @media (max-width: 900px) {
            .reports-page .charts-grid {
                grid-template-columns: 1fr;
            }

            .reports-page {
                padding: 18px;
            }
        }

        @media (max-width: 600px) {
            .reports-page {
                padding: 13px;
            }

            .reports-page .reports-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .reports-page .header-title h1 {
                font-size: 23px;
            }

            .reports-page .header-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .reports-page .report-search {
                width: 100%;
            }

            .reports-page .header-actions .btn {
                flex: 1;
            }

            .reports-page .report-search input {
                min-width: 0;
                flex: 1;
            }

            .reports-page .report-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .reports-page .report-card {
                padding: 16px;
            }

            .reports-page .card-value {
                font-size: 25px;
            }

            .reports-page .filter-panel {
                align-items: stretch;
                flex-direction: column;
                padding: 14px;
            }

            .reports-page .filter-field {
                width: 100%;
            }

            .reports-page .date-range {
                width: 100%;
            }

            .reports-page .date-range input {
                min-width: 0;
                width: 100%;
            }

            .reports-page .filter-actions {
                width: 100%;
            }

            .reports-page .filter-actions .btn {
                flex: 1;
            }

            .reports-page .report-panel {
                padding: 15px;
            }

            .reports-page .chart-container {
                height: 220px;
            }

            .reports-page .table-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .reports-page .table-search {
                width: 100%;
            }

            .reports-page .table-footer {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
<main class="reports-page">

    <!-- PAGE HEADER -->
    <header class="reports-header">
        <div class="header-title">
            <h1>Reports & Analytics</h1>
            <p>Monitor registrations, revenue, membership and vendor performance.</p>
        </div>

        <div class="header-actions">
            <form method="GET" action="{{ route('admin.report') }}" class="report-search">
                <input type="hidden" name="period" value="{{ $period }}">
                <input type="search" name="search" value="{{ $search }}"
                    placeholder="Search transactions" aria-label="Search transactions">
                <button class="btn btn-outline" type="submit">Search</button>
            </form>
            <button class="btn btn-outline" id="refreshBtn" type="button">
                ↻ Refresh
            </button>
        </div>
    </header>

    <!-- FILTERS -->
    <form method="GET" action="{{ route('admin.report') }}" class="filter-panel">
        <input type="hidden" name="period" value="{{ $period }}">
        <input type="hidden" name="search" value="{{ $search }}">
        <div class="filter-field">
            <label for="vendorStartDate">Assignment Start Date</label>
            <input type="date" id="vendorStartDate" name="vendor_start_date"
                value="{{ $vendorFilters['vendor_start_date'] ?? '' }}">
        </div>
        <div class="filter-field">
            <label for="vendorEndDate">Assignment End Date</label>
            <input type="date" id="vendorEndDate" name="vendor_end_date"
                value="{{ $vendorFilters['vendor_end_date'] ?? '' }}">
        </div>
        <div class="filter-field">
            <label for="vendorCity">Vendor City</label>
            <select id="vendorCity" name="vendor_city">
                <option value="">All Cities</option>
                @foreach($vendorCities as $city)
                    <option value="{{ $city }}" @selected(($vendorFilters['vendor_city'] ?? '') === $city)>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-field">
            <label for="vendorSearch">Search Vendors</label>
            <input type="search" id="vendorSearch" name="vendor_search"
                value="{{ $vendorFilters['vendor_search'] ?? '' }}" placeholder="Vendor ID or agent">
        </div>
        <div class="filter-actions">
            <button class="btn btn-primary" type="submit">Apply Filters</button>
            <a class="btn btn-outline" href="{{ route('admin.report', ['period' => $period, 'search' => $search]) }}">
                Reset
            </a>
        </div>
    </form>

    <!-- SUMMARY CARDS -->
    <section class="report-stats">

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">♙</div>
                @if($registrationChange !== null)
                    <span class="card-change">{{ $registrationChange >= 0 ? '↑' : '↓' }}
                        {{ number_format(abs($registrationChange), 1) }}%</span>
                @else
                    <span class="card-change">{{ $period === 'all' ? 'All time' : 'New' }}</span>
                @endif
            </div>
            <p class="card-label">New Registrations</p>
            <h2 class="card-value" id="registrationValue">{{ number_format($newRegistrations) }}</h2>
            <p class="card-description">{{ $periods[$period] }}</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">✓</div>
                <span class="card-change">{{ $periods[$period] }}</span>
            </div>
            <p class="card-label">Profile completions</p>
            <h2 class="card-value">{{ number_format($profileCompletion, 1) }}%</h2>
            <p class="card-description">Member profiles completed</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">₹</div>
                <span class="card-change">{{ $periods[$period] }}</span>
            </div>
            <p class="card-label">Membership sales</p>
            <h2 class="card-value">₹{{ number_format($membershipSales, 2) }}</h2>
            <p class="card-description">Paid membership sales</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">♧</div>
                <span class="card-change">{{ $periods[$period] }}</span>
            </div>
            <p class="card-label">Vendor sourced leads</p>
            <h2 class="card-value">{{ number_format($vendorLeads) }}</h2>
            <p class="card-description">Leads submitted by vendors</p>
        </article>

    </section>

    <!-- CHARTS -->
    <section class="charts-grid">

        <article class="report-panel">
            <div class="panel-header">
                <div>
                    <h2>Registration Trend</h2>
                    <p>New member registrations over time</p>
                </div>

                <form method="GET" action="{{ route('admin.report') }}">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <select class="chart-period" id="trendPeriod" name="period"
                        aria-label="Registration chart period" onchange="this.form.submit()">
                        @foreach($periods as $value => $label)
                            <option value="{{ $value }}" @selected($period === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="chart-container">
                <canvas id="registrationChart"></canvas>
            </div>
        </article>

        <article class="report-panel">
            <div class="panel-header">
                <div>
                    <h2>Profile Distribution</h2>
                    <p>Distribution of registered profiles by gender</p>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="memberChart"></canvas>
            </div>
        </article>

    </section>

    <!-- VENDOR PERFORMANCE -->
    <section class="report-panel vendor-panel">

        <div class="table-toolbar">
            <div>
                <h2>Vendor Performance</h2>
                <p>Assigned profiles and commission from registered vendors</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="report-table js-data-table" id="vendorTable" data-page-length="10"
                data-empty-table="No vendor records found.">
                <thead>
                    <tr>
                        <th>Vendor ID</th>
                        <th>Agent</th>
                        <th>City</th>
                        <th>Assigned Profiles</th>
                        <th>Paid Memberships</th>
                        <th>Conversion Rate</th>
                        <th>Status</th>
                        <th>Commission</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($vendors as $vendor)
                        @php
                            $conversionRate = $vendor->customers_count > 0
                                ? ($vendor->paid_memberships_count / $vendor->customers_count) * 100
                                : 0;
                        @endphp
                        <tr>
                            <td>VN-{{ str_pad($vendor->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $vendor->agent_name }}</td>
                            <td>{{ $vendor->city }}</td>
                            <td>{{ number_format($vendor->customers_count) }}</td>
                            <td>{{ number_format($vendor->paid_memberships_count) }}</td>
                            <td>{{ number_format($conversionRate, 1) }}%</td>
                            <td>{{ $vendor->status }}</td>
                            <td>₹{{ number_format((float) $vendor->commission, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <section class="report-panel vendor-panel">
        <div class="table-toolbar">
            <div>
                <h2>Recent Membership Transactions</h2>
                <p>Transactions matching the selected period and search.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="report-table js-data-table" data-page-length="10"
                data-empty-table="No transactions found for this filter.">
                <thead>
                    <tr>
                        <th>Transaction</th>
                        <th>Member</th>
                        <th>Profile ID</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        @php
                            $paymentStatus = strtolower($transaction->payment_status ?: ($transaction->status ?: 'unknown'));
                            $statusClass = in_array($paymentStatus, ['paid', 'success', 'successful', 'completed'], true)
                                ? 'bg-success-subtle text-success'
                                : (in_array($paymentStatus, ['pending', 'initiated', 'processing'], true)
                                    ? 'bg-warning-subtle text-warning-emphasis'
                                    : 'bg-secondary-subtle text-secondary');
                        @endphp
                        <tr>
                            <td>{{ $transaction->transaction_id ?: ('#' . $transaction->id) }}</td>
                            <td>{{ $transaction->member_name ?: 'Member' }}</td>
                            <td>{{ $transaction->profile_id ?: 'N/A' }}</td>
                            <td>{{ $transaction->plan_name ?: 'Plan unavailable' }}</td>
                            <td>₹{{ number_format((float) $transaction->amount, 2) }}</td>
                            <td><span class="badge rounded-pill {{ $statusClass }}">{{ ucfirst($paymentStatus) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">No transactions found for this filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="table-footer">
            <span>
                @if($transactions->count() > 0)
                    {{ number_format($transactions->count()) }} matching transactions
                @else
                    No transactions to show
                @endif
            </span>
        </div>
    </section>

</main>

<script>
"use strict";

/* CHARTS */

function createRegistrationChart() {
    const ctx = document.getElementById("registrationChart");

    registrationChart = new Chart(ctx, {
        type: "bar",

        data: {
            labels: @json($registrationLabels),

            datasets: [{
                label: "Registrations",
                data: @json($registrationValues),
                backgroundColor: "#e8c5cd",
                hoverBackgroundColor: "#561325",
                borderRadius: 5,
                maxBarThickness: 26
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    backgroundColor: "#42101d",
                    padding: 12
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: "#897b80",
                        font: {
                            size: 10
                        }
                    }
                },

                y: {
                    beginAtZero: true,
                    border: {
                        display: false
                    },
                    grid: {
                        color: "#f3e5e8"
                    },
                    ticks: {
                        precision: 0,
                        color: "#897b80",
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });
}

function createMemberChart() {
    const ctx = document.getElementById("memberChart");

    memberChart = new Chart(ctx, {
        type: "doughnut",

        data: {
            labels: @json($profileDistribution->keys()->values()),

            datasets: [{
                data: @json($profileDistribution->pluck('count')->values()),
                backgroundColor: [
                    "#561325",
                    "#d88fa1",
                    "#d5a044"
                ],
                borderWidth: 2,
                borderColor: "#ffffff",
                hoverOffset: 6
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: "66%",

            plugins: {
                legend: {
                    position: "right",

                    labels: {
                        color: "#67535c",
                        usePointStyle: true,
                        pointStyle: "rectRounded",
                        boxWidth: 10,
                        padding: 17,
                        font: {
                            size: 11
                        }
                    }
                },

                tooltip: {
                    callbacks: {
                        label(context) {
                            return context.label + ": " +
                                context.formattedValue + " profiles";
                        }
                    }
                }
            }
        }
    });
}

/* EVENT LISTENERS */

document.getElementById("refreshBtn")
    .addEventListener("click", () => window.location.reload());

/* INITIALIZE PAGE */

createRegistrationChart();
createMemberChart();
</script>

@endsection