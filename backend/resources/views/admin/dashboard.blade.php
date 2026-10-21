@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <!-- Page Title Head -->
            <div class="page-title-head d-flex align-items-center mb-3">
                <div class="flex-grow-1">
                    <h4 class="page-main-title m-0" style="color: #6A1B29;">Dashboard</h4>
                    <p class="text-muted mb-0 fs-13">Here's a quick overview of your matrimony platform.</p>
                </div>

                <div class="text-end d-flex align-items-center gap-2">
                    <ol class="breadcrumb m-0 py-0 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">GenZ Matrimony</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <span class="badge rounded-pill px-3 py-2 text-dark border bg-white shadow-sm ms-2">
                        <span class="avatar-xs d-inline-block text-center rounded-circle text-white me-1"
                            style="background-color: #6A1B29; width: 22px; height: 22px; line-height: 22px; font-size: 10px;">AJ</span>
                        Admin <span class="text-muted fs-11">(Super Admin)</span>
                    </span>
                </div>
            </div>

            <!-- Date Indicator -->
            <div class="mb-3">
                <span class="text-muted fs-12 fw-medium">
                    <i class="ti ti-calendar me-1"></i>
                    {{ now()->format('l, j F Y') }}
                </span>
            </div>

            <!-- ROW 1: 4 Metric KPI Cards -->
            <div class="row g-3 mb-4">
                <!-- Total Members -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3 position-relative overflow-hidden"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="position-absolute top-0 start-0 bottom-0"
                            style="width: 4px; background-color: #6A1B29;"></div>
                        <div class="card-body ps-4 py-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-muted fs-12 fw-medium">
                                    <span class="badge rounded-circle me-1"
                                        style="background-color: #FAF5F5; color: #6A1B29;">+</span> Total Members
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1" style="color: #6A1B29;">{{ number_format($totalMembers) }}</h3>
                            @if($memberGrowth !== null)
                                <span class="{{ $memberGrowth >= 0 ? 'text-success' : 'text-danger' }} fs-11 fw-semibold">
                                    <i class="ti {{ $memberGrowth >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ $memberGrowth >= 0 ? '+' : '' }}{{ number_format($memberGrowth, 1) }}% new members vs last month
                                </span>
                            @else
                                <span class="text-muted fs-11">No members registered last month</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pending Reviews -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3 position-relative overflow-hidden"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="position-absolute top-0 start-0 bottom-0 bg-warning" style="width: 4px;"></div>
                        <div class="card-body ps-4 py-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-muted fs-12 fw-medium">
                                    <span class="badge rounded-circle me-1 bg-warning-subtle text-warning">+</span> Pending
                                    Reviews
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($pendingReviews) }}</h3>
                            <span class="text-muted fs-11">Needs admin attention</span>
                        </div>
                    </div>
                </div>

                <!-- Active Vendors -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3 position-relative overflow-hidden"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="position-absolute top-0 start-0 bottom-0 bg-success" style="width: 4px;"></div>
                        <div class="card-body ps-4 py-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-muted fs-12 fw-medium">
                                    <span class="badge rounded-circle me-1 bg-success-subtle text-success">+</span> Active
                                    Vendors
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1 text-dark">{{ number_format($activeVendors) }}</h3>
                            <span class="text-muted fs-11">Currently active vendors</span>
                        </div>
                    </div>
                </div>

                <!-- Membership Revenue -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3 position-relative overflow-hidden"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="position-absolute top-0 start-0 bottom-0"
                            style="width: 4px; background-color: #AF384E;"></div>
                        <div class="card-body ps-4 py-3">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <span class="text-muted fs-12 fw-medium">
                                    <span class="badge rounded-circle me-1"
                                        style="background-color: #FFF0F2; color: #AF384E;">+</span> Membership Revenue
                                </span>
                            </div>
                            <h3 class="fw-bold mb-1" style="color: #6A1B29;">₹{{ number_format($membershipRevenue, 2) }}</h3>
                            @if($revenueGrowth !== null)
                                <span class="{{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }} fs-11 fw-semibold">
                                    <i class="ti {{ $revenueGrowth >= 0 ? 'ti-trending-up' : 'ti-trending-down' }}"></i>
                                    {{ $revenueGrowth >= 0 ? '+' : '' }}{{ number_format($revenueGrowth, 1) }}% vs last month
                                </span>
                            @else
                                <span class="text-muted fs-11">Revenue this month</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- ROW 2: Registration Overview & Verification Queue -->
            <div class="row g-3 mb-4">
                <!-- Registration Overview Chart -->
                <div class="col-lg-8">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1" style="color: #6A1B29;">Registration Overview</h5>
                                <p class="text-muted fs-12 mb-0">New profiles created over the last 7 months</p>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm btn-light btn-icon" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('admin.report', ['period' => 'last_90_days']) }}">Open Reports</a></li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">Refresh</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div dir="ltr">
                                <div id="registration-overview-chart" class="apex-charts" style="min-height: 250px;"
                                    data-registration-values="{{ json_encode($registrationValues) }}"
                                    data-registration-labels="{{ json_encode($registrationLabels) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Queue -->
                <div class="col-lg-4">
                    <div class="card card-h-100 border-0 shadow-sm rounded-3" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="card-title mb-1" style="color: #6A1B29;">Verification Queue</h5>
                            <p class="text-muted fs-12 mb-0">Profiles waiting for review</p>
                        </div>
                        <div class="card-body pt-0 d-flex flex-column justify-content-around">
                            <div class="d-flex align-items-center justify-content-between p-3 rounded-2 mb-2"
                                style="background-color: #FCF7F8; border: 1px solid #F7ECEE;">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar-xs rounded-circle d-flex align-items-center justify-content-center"
                                        style="background-color: #F8EBEF; color: #6A1B29;">
                                        <i class="ti ti-photo"></i>
                                    </span>
                                    <span class="fs-13 fw-medium text-dark">Photo verification</span>
                                </div>
                                <a href="{{ route('admin.profile-verification.index', ['status' => 'pending']) }}"
                                class="badge px-3 py-2 rounded-pill fs-12 fw-bold text-decoration-none"
                                style="background-color: #F8EBEF; color: #6A1B29;">{{ number_format($photoVerificationQueue) }}</a>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 rounded-2 mb-2"
                                style="background-color: #FCF7F8; border: 1px solid #F7ECEE;">
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="avatar-xs rounded-circle d-flex align-items-center justify-content-center bg-info-subtle text-info">
                                        <i class="ti ti-id"></i>
                                    </span>
                                    <span class="fs-13 fw-medium text-dark">Pending profiles without photo</span>
                                </div>
                                <a href="{{ route('admin.profile-verification.index', ['status' => 'pending']) }}"
                                    class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fs-12 fw-bold text-decoration-none">{{ number_format($profilesWithoutPhoto) }}</a>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 rounded-2"
                                style="background-color: #FCF7F8; border: 1px solid #F7ECEE;">
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="avatar-xs rounded-circle d-flex align-items-center justify-content-center bg-warning-subtle text-warning">
                                        <i class="ti ti-briefcase"></i>
                                    </span>
                                    <span class="fs-13 fw-medium text-dark">Vendor applications</span>
                                </div>
                                <a href="{{ route('admin.vendors.index', ['status' => 'Pending']) }}"
                                    class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fs-12 fw-bold text-decoration-none">{{ number_format($vendorApplications) }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- ROW 3: Recent Registrations Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 mb-4" style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1" style="color: #6A1B29;">Recent Registrations</h5>
                                <p class="text-muted fs-12 mb-0">Latest profiles and their review status</p>
                            </div>
                            <div>
                                <a href="{{ route('users.index') }}"
                                    class="btn btn-sm btn-link text-decoration-none fw-semibold" style="color: #6A1B29;">
                                    View All <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 js-data-table">
                                    <thead
                                        style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; color: #6A1B29;">
                                        <tr>
                                            <th class="ps-4">User ID</th>
                                            <th>Name</th>
                                            <th>Profile</th>
                                            <th>Status</th>
                                            <th class="pe-4">Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-13">
                                        @forelse($recentRegistrations as $profile)
                                            @php
                                                $verificationStatus = $profile->verification_status ?: 'pending';
                                                $statusLabel = [
                                                    'pending' => 'Pending',
                                                    'approved' => 'Approved',
                                                    'rejected' => 'Rejected',
                                                    'update_requested' => 'Update requested',
                                                ][$verificationStatus] ?? ucfirst(str_replace('_', ' ', $verificationStatus));
                                                $statusClass = [
                                                    'pending' => 'bg-warning-subtle text-warning border-warning-subtle',
                                                    'approved' => 'bg-success-subtle text-success border-success-subtle',
                                                    'rejected' => 'bg-danger-subtle text-danger border-danger-subtle',
                                                    'update_requested' => 'bg-info-subtle text-info border-info-subtle',
                                                ][$verificationStatus] ?? 'bg-secondary-subtle text-secondary border-secondary-subtle';
                                            @endphp
                                            <tr>
                                                <td class="ps-4 fw-semibold" style="color: #6A1B29;">
                                                    {{ $profile->member_id ?: ($profile->profile_id ?: ('#' . $profile->id)) }}
                                                </td>
                                                <td class="fw-medium text-dark">{{ $profile->member_name ?: 'Member' }}</td>
                                                <td class="text-muted">
                                                    {{ $profile->gender ?: 'Gender not set' }} · {{ $profile->city ?: 'Location not set' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.profile-verification.index', [
                                                        'status' => in_array($verificationStatus, ['pending', 'approved', 'rejected', 'update_requested'], true) ? $verificationStatus : 'pending',
                                                        'id' => $profile->id,
                                                    ]) }}" class="badge rounded-pill {{ $statusClass }} border px-2 py-1 fs-11 text-decoration-none">
                                                        {{ $statusLabel }}
                                                    </a>
                                                </td>
                                                <td class="pe-4 text-muted">
                                                    {{ $profile->created_at ? \Carbon\Carbon::parse($profile->created_at)->format('d M Y') : 'N/A' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">No profiles found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        © GenZ Matrimonial - Developed for <span
                            class="fw-bold text-decoration-underline text-reset fs-12">Thirumana Admin</span>
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex justify-content-end gap-3">
                            <a href="javascript: void(0);" class="link-reset">About</a>
                            <a href="javascript: void(0);" class="link-reset">Support</a>
                            <a href="javascript: void(0);" class="link-reset">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

    <!-- ApexChart Script for Registration Overview -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartElement = document.querySelector('#registration-overview-chart');
            if (!chartElement) return;

            const registrationValues = JSON.parse(chartElement.dataset.registrationValues || '[]');
            const registrationLabels = JSON.parse(chartElement.dataset.registrationLabels || '[]');
            const chartOptions = {
                series: [{
                    name: 'Registrations',
                    type: 'column',
                    data: registrationValues
                }, {
                    name: 'Trend Line',
                    type: 'line',
                    data: registrationValues
                }],
                chart: {
                    height: 250,
                    type: 'line',
                    toolbar: { show: false }
                },
                stroke: {
                    width: [0, 3],
                    curve: 'smooth'
                },
                colors: ['#F3D3D9', '#6A1B29'],
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '32%'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                labels: registrationLabels,
                xaxis: {
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: '#9e9e9e', fontSize: '11px' }
                    }
                },
                yaxis: {
                    show: false
                },
                grid: {
                    borderColor: '#F3E5E8',
                    strokeDashArray: 3
                },
                legend: {
                    show: false
                }
            };

            const chart = new ApexCharts(chartElement, chartOptions);
            chart.render();
        });
    </script>
@endsection