@extends('layout')

@section('content')

    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Reports & Analytics
                    </h3>
                    <p class="text-muted mb-0 fs-13">Monitor registrations, Revenue, Membership and vendor activity.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <form method="GET" action="{{ route('admin.report') }}" class="input-group shadow-sm" style="width: 250px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="search" name="search" value="{{ $search }}"
                            class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search transactions" aria-label="Search transactions" />
                        <input type="hidden" name="period" value="{{ $period }}">
                        <button class="btn btn-sm btn-light border" type="submit">Search</button>
                    </form>

                    <!-- Notification Bell Icon -->
                    <button
                        class="btn btn-sm btn-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 34px; height: 34px; background-color: #fff;">
                        <i class="ti ti-bell fs-16 text-muted"></i>
                    </button>

                    <!-- Admin Profile Badge -->
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-12 shadow-sm"
                            style="background-color: #561325; width: 34px; height: 34px;">
                            AJ
                        </div>
                        <div class="d-none d-sm-block text-start lh-1">
                            <span class="fw-bold d-block text-dark fs-13">Admin</span>
                            <small class="text-muted fs-11">Super Admin</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Metric KPI Cards -->
            <div class="row g-3 mb-4">
                <!-- New registrations -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">✦</span>
                                @if($registrationChange !== null)
                                    <span class="badge rounded-pill {{ $registrationChange >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-10 border">
                                        {{ $registrationChange >= 0 ? '+' : '' }}{{ number_format($registrationChange, 1) }}%
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary fs-10 border">
                                        {{ $period === 'all' ? 'All time' : 'New' }}
                                    </span>
                                @endif
                            </div>
                            <div class="text-muted fs-12 mb-1">New Registrations</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;">{{ number_format($newRegistrations) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Profile completion -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">✦</span>
                                <span class="badge rounded-pill bg-light text-muted fs-10 border">Complete profiles</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Profile completions
                            </div>
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($profileCompletion, 1) }}%</h3>
                        </div>
                    </div>
                </div>

                <!-- Membership sales -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">✦</span>
                                <span class="text-muted fs-11">{{ $periods[$period] }}</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Membership sales</div>
                            <h3 class="fw-bold mb-0 text-dark">₹{{ number_format($membershipSales, 2) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Vendor leads -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FDE8E8; color: #E02424; font-size: 13px;">✦</span>
                                <span class="text-muted fs-11">{{ $periods[$period] }}</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Vendor sourced leads</div>
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($vendorLeads) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

<!--trend chart-->
   <div class="row">
   <div class="col-xxl-4 col-xl-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div>
                                            <h4 class="fs-13 mb-2 fw-bold text-uppercase text-muted">Registration Trend</h4>
                                            <div class="d-flex align-items-center gap-2 mb-2 py-1">
                                                <div class="avatar-md flex-shrink-0">
                                                    <span class="avatar-title text-bg-success rounded-circle">
                                                        <i class="ti ti-basket fs-xxl"></i>
                                                    </span>
                                                </div>
                                                <h3 class="mb-0">{{ number_format($newRegistrations) }}</h3>
                                                <span class="text-muted fs-11 ms-auto">{{ $periods[$period] }}</span>
                                            </div>
                                        </div>
                                        <!-- Filter -->
                                        <form method="GET" action="{{ route('admin.report') }}" class="app-search app-search-sm">
                                            <input type="hidden" name="search" value="{{ $search }}">
                                            <select name="period" class="form-select form-control form-select-sm"
                                                aria-label="Report date range" onchange="this.form.submit()">
                                                @foreach($periods as $value => $label)
                                                    <option value="{{ $value }}" @selected($period === $value)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <i class="ti ti-calendar app-search-icon text-muted"></i>
                                        </form>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div dir="ltr">
                                                <div id="registration-trend-chart" class="apex-charts"
                                                    data-labels='{{ json_encode($registrationLabels, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}'
                                                    data-values='{{ json_encode($registrationValues, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}'></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>

<!--profile distribution-->

 <div class="col-xxl-3 col-xl-4">
                            <div class="card card-h-100">
                                <div class="card-header justify-content-between">
                                    <h4 class="card-title">Profile Distribution</h4>
                                </div>
                                <div class="card-body">
                                    <div dir="ltr">
                                        <div id="profile-distribution-chart" class="apex-charts"
                                            data-series='{{ json_encode($profileDistribution->pluck("count")->values(), JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}'
                                            data-labels='{{ json_encode($profileDistribution->keys()->values(), JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP) }}'></div>
                                    </div>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-sm table-nowrap table-borderless table-centered mb-0 js-data-table">
                                            <thead class="bg-light bg-opacity-50 thead-sm">
                                                <tr class="text-uppercase fs-xxs">
                                                    <th>Gender</th>
                                                    <th>Profiles</th>
                                                    <th>Share</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($profileDistribution as $gender => $distribution)
                                                    <tr>
                                                        <td class="text-muted">{{ $gender }}</td>
                                                        <td>{{ number_format($distribution['count']) }}</td>
                                                        <td>{{ number_format($distribution['share'], 1) }}%</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>

</div>



            <!-- Recent Transactions Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1 text-dark">Recent Membership Transactions</h5>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover js-data-table" data-page-length="10" data-empty-table="No transactions found for this filter.">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">TRANSACTION</th>
                                <th class="py-3">MEMBER</th>
                                <th class="py-3">PROFILE ID</th>
                                <th class="py-3">PLAN</th>
                                <th class="py-3">AMOUNT</th>
                                <th class="pe-4 py-3">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="fs-13">
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
                                    <td class="ps-4 fw-semibold text-dark">
                                        {{ $transaction->transaction_id ?: ('#' . $transaction->id) }}
                                        <small class="d-block text-muted">{{ $transaction->created_at ? \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') : 'N/A' }}</small>
                                    </td>
                                    <td class="text-dark">{{ $transaction->member_name ?: 'Member' }}</td>
                                    <td class="text-muted">{{ $transaction->profile_id ?: 'N/A' }}</td>
                                    <td class="text-muted">{{ $transaction->plan_name ?: 'Plan unavailable' }}</td>
                                    <td class="fw-medium text-dark">₹{{ number_format((float) $transaction->amount, 2) }}</td>
                                    <td class="pe-4"><span class="badge rounded-pill {{ $statusClass }}">{{ ucfirst($paymentStatus) }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No transactions found for this filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <span class="text-muted fs-12">
                        @if($transactions->count() > 0)
                            {{ number_format($transactions->count()) }} matching transactions
                        @else
                            No transactions to show
                        @endif
                    </span>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const registrationChart = document.querySelector('#registration-trend-chart');

            if (registrationChart && window.ApexCharts) {
                const registrationLabels = JSON.parse(registrationChart.dataset.labels);
                const registrationValues = JSON.parse(registrationChart.dataset.values);
                new ApexCharts(registrationChart, {
                    series: [
                        { name: 'Registrations', type: 'column', data: registrationValues },
                        { name: 'Trend', type: 'line', data: registrationValues }
                    ],
                    chart: { height: 250, type: 'line', toolbar: { show: false } },
                    stroke: { width: [0, 3], curve: 'smooth' },
                    colors: ['#F3D3D9', '#6A1B29'],
                    plotOptions: { bar: { borderRadius: 4, columnWidth: '45%' } },
                    dataLabels: { enabled: false },
                    labels: registrationLabels,
                    xaxis: {
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: { rotate: -45, style: { colors: '#9e9e9e', fontSize: '10px' } }
                    },
                    yaxis: { min: 0, forceNiceScale: true },
                    grid: { borderColor: '#F3E5E8', strokeDashArray: 3 },
                    legend: { show: false },
                    noData: { text: 'No registration data for this period' }
                }).render();
            }

            const distributionChart = document.querySelector('#profile-distribution-chart');
            if (distributionChart && window.ApexCharts) {
                new ApexCharts(distributionChart, {
                    series: JSON.parse(distributionChart.dataset.series),
                    labels: JSON.parse(distributionChart.dataset.labels),
                    chart: { type: 'donut', height: 220 },
                    colors: ['#6A1B29', '#D58B9A', '#E8C7CE'],
                    legend: { position: 'bottom' },
                    dataLabels: { enabled: true },
                    noData: { text: 'No profiles yet' }
                }).render();
            }
        });
    </script>

@endsection