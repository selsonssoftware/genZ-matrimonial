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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Thirumana</a></li>
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
                    <script>
                        document.write(new Date().toLocaleDateString("en-US", { weekday: 'long', day: "numeric", month: "long", year: "numeric" }))
                    </script>
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
                            <h3 class="fw-bold mb-1" style="color: #6A1B29;">12,840</h3>
                            <span class="text-success fs-11 fw-semibold"><i class="ti ti-trending-up"></i> +12.8% vs last
                                month</span>
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
                            <h3 class="fw-bold mb-1 text-dark">186</h3>
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
                            <h3 class="fw-bold mb-1 text-dark">248</h3>
                            <span class="text-success fs-11 fw-semibold"><i class="ti ti-trending-up"></i> +8.4% vs last
                                month</span>
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
                            <h3 class="fw-bold mb-1" style="color: #6A1B29;">₹4.82L</h3>
                            <span class="text-success fs-11 fw-semibold"><i class="ti ti-trending-up"></i> +15.2% vs last
                                month</span>
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
                                    <li><a class="dropdown-item" href="#">Download Report</a></li>
                                    <li><a class="dropdown-item" href="#">Refresh</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div dir="ltr">
                                <div id="registration-overview-chart" class="apex-charts" style="min-height: 250px;"></div>
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
                                <span class="badge px-3 py-2 rounded-pill fs-12 fw-bold"
                                    style="background-color: #F8EBEF; color: #6A1B29;">82</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between p-3 rounded-2 mb-2"
                                style="background-color: #FCF7F8; border: 1px solid #F7ECEE;">
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="avatar-xs rounded-circle d-flex align-items-center justify-content-center bg-info-subtle text-info">
                                        <i class="ti ti-id"></i>
                                    </span>
                                    <span class="fs-13 fw-medium text-dark">Identity documents</span>
                                </div>
                                <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fs-12 fw-bold">64</span>
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
                                <span
                                    class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fs-12 fw-bold">40</span>
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
                                <table class="table table-hover align-middle mb-0">
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
                                        <tr>
                                            <td class="ps-4 fw-semibold" style="color: #6A1B29;">TM-10482</td>
                                            <td class="fw-medium text-dark">Priya S.</td>
                                            <td class="text-muted">Female · Chennai</td>
                                            <td><span
                                                    class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 fs-11">Pending</span>
                                            </td>
                                            <td class="pe-4 text-muted">13 Oct 2026</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-semibold" style="color: #6A1B29;">TM-10481</td>
                                            <td class="fw-medium text-dark">Arun K.</td>
                                            <td class="text-muted">Male · Coimbatore</td>
                                            <td><span
                                                    class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-2 py-1 fs-11">Approved</span>
                                            </td>
                                            <td class="pe-4 text-muted">13 Oct 2026</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-semibold" style="color: #6A1B29;">TM-10480</td>
                                            <td class="fw-medium text-dark">Nivetha R.</td>
                                            <td class="text-muted">Female · Madurai</td>
                                            <td><span
                                                    class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 fs-11">Pending</span>
                                            </td>
                                            <td class="pe-4 text-muted">12 Oct 2026</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 fw-semibold" style="color: #6A1B29;">TM-10479</td>
                                            <td class="fw-medium text-dark">Karthik M.</td>
                                            <td class="text-muted">Male · Salem</td>
                                            <td><span
                                                    class="badge rounded-pill bg-info-subtle text-info border border-info-subtle px-2 py-1 fs-11">Review</span>
                                            </td>
                                            <td class="pe-4 text-muted">12 Oct 2026</td>
                                        </tr>
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
            const chartOptions = {
                series: [{
                    name: 'Registrations',
                    type: 'column',
                    data: [420, 560, 510, 680, 620, 890, 950]
                }, {
                    name: 'Trend Line',
                    type: 'line',
                    data: [420, 560, 510, 680, 620, 890, 950]
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
                labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
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

            if (document.querySelector("#registration-overview-chart")) {
                const chart = new ApexCharts(document.querySelector("#registration-overview-chart"), chartOptions);
                chart.render();
            }
        });
    </script>
@endsection