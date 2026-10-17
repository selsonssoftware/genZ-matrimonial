@extends('layout')
@section('content')
<div class="row">
    <div class="col-xxl-5">
        <div class="row h-100">
            <div class="col-lg-3 col-md-6 col-xxl-6">
                <div class="card card-h-100 overflow-hidden">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="overflow-hidden flex-shrink-0">
                                <h3 class="fw-normal text-reset fs-20 lh-base">
                                    <span class="text-muted fs-base text-uppercase h5">Good Day,</span> <br />
                                    <b>David Dev!</b>
                                </h3>
                            </div>
                            <div class="flex-grow-1 text-end">
                                <img class="d-none d-xxl-inline-block" src="assets/images/svg/email-campaign.svg" width="110" alt="Generic placeholder image" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-center p-2 bg-light bg-opacity-50">
                        <p class="d-flex align-items-center justify-content-between w-100 mb-0">
                            <span class="me-2">
                                <i class="ti ti-calendar fs-15 align-middle"></i>
                                <span class="align-middle ms-1 fw-semibold">
                                    <script>
                                        document.write(new Date().toLocaleDateString("en-US", { day: "numeric", month: "short", year: "numeric" }))
                                    </script>
                                </span>
                            </span>
                            <span class="text-nowrap">
                                <i class="ti ti-clock fs-15 align-middle"></i>
                                <span class="align-middle ms-1 fw-semibold" id="clock-widget"></span>
                            </span>
                        </p>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>
            <!-- end col-->

            <div class="col-lg-3 col-md-6 col-xxl-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fs-base text-uppercase" title="Number of Orders">Orders</h5>
                                <h3 class="my-3 py-1 fw-semibold"><span data-target="9,754">0</span></h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="ti ti-arrow-down"></i> 1.89%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded-circle fs-22">
                                    <i class="ti ti-shopping-cart text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-lg-3 col-md-6 col-xxl-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fs-base text-uppercase" title="Average Revenue">Revenue</h5>
                                <h3 class="my-3 py-1 fw-semibold">$<span data-target="75.21">0</span>k</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><i class="ti ti-arrow-down"></i> 5.23%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded-circle fs-22">
                                    <i class="ti ti-pig-money text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->

            <div class="col-lg-3 col-md-6 col-xxl-6">
                <div class="card card-h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="text-muted fs-base text-uppercase" title="Growth">Growth</h5>
                                <h3 class="my-3 py-1 fw-semibold">+ <span data-target="25.08">0</span>%</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><i class="ti ti-arrow-up"></i> 4.87%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded-circle fs-22">
                                    <i class="ti ti-trending-up text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row -->
    </div>
    <!-- end col -->

    <div class="col-xxl-7">
        <div class="row h-100">
            <div class="col-lg-6">
                <div class="card card-h-100">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Store Performance Analytics</h4>
                        <div>
                            <a href="#" class="btn btn-sm btn-default" data-action="card-refresh"><i class="ti ti-refresh me-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div dir="ltr">
                            <div id="total-sales-chart" class="apex-charts"></div>
                        </div>
                        <div class="text-center mb-1">
                            <span class="badge badge-outline-light text-dark p-1 px-2 rounded-pill fs-12"><i class="ti ti-star-filled text-danger me-1"></i> POOR SALES</span>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
            <div class="col-lg-6">
                <div class="card card-h-100">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">Weekly Performance Insights</h4>
                        <div class="dropdown ms-auto">
                            <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical fs-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-refresh me-2"></i> Refresh Data </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i> Download Report </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#"> <i class="ti ti-share me-2"></i> Share Insights </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"> <i class="ti ti-archive me-2"></i> Archive Widget </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div dir="ltr">
                            <div id="weekly-performance-chart" class="apex-charts"></div>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
        </div>
        <!-- end row-->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection