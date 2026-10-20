<?php $__env->startSection('content'); ?>
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
                    <!-- Search Input -->
                    <div class="input-group shadow-sm" style="width: 170px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search" />
                    </div>

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
                <!-- Active subscriptions -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">✦</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+9.6%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">New Registrations</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;">3,482</h3>
                        </div>
                    </div>
                </div

                <!-- Collected this month -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">✦</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+15.2%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Profile completions
                            </div>
                            <h3 class="fw-bold mb-0 text-dark">86.4%</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending payments -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">✦</span>
                                <span class="text-muted fs-11">Requires follow-up</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Membership sales</div>
                            <h3 class="fw-bold mb-0 text-dark">₹82.1L</h3>
                        </div>
                    </div>
                </div>

                <!-- Refund requests -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FDE8E8; color: #E02424; font-size: 13px;">✦</span>
                                <span class="text-danger fs-11 fw-semibold">Needs review</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">vendor Sourced leads</div>
                            <h3 class="fw-bold mb-0 text-dark">685</h3>
                        </div>
                    </div>
                </div>
            </div>

<!--trend chart-->
  <div class="col-xxl-4 col-xl-6">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div>
                                            <h4 class="fs-13 mb-2 fw-bold text-uppercase text-muted">Total Orders</h4>
                                            <div class="d-flex align-items-center gap-2 mb-2 py-1">
                                                <div class="avatar-md flex-shrink-0">
                                                    <span class="avatar-title text-bg-success rounded-circle">
                                                        <i class="ti ti-basket fs-xxl"></i>
                                                    </span>
                                                </div>
                                                <h3 class="mb-0">$<span data-target="659.8">0</span>k</h3>
                                                <span class="badge fs-13 ms-auto badge-soft-danger"><i class="ti ti-arrow-down"></i> 3.21%</span>
                                            </div>
                                        </div>
                                        <!-- Filter -->
                                        <div class="app-search app-search-sm">
                                            <select class="form-select form-control form-select-sm">
                                                <option value="All">All Time</option>
                                                <option value="today">Today</option>
                                                <option value="last_7_days">Last 7 Days</option>
                                                <option value="last_30_days">Last 30 Days</option>
                                                <option value="last_90_days" selected>Last 90 Days</option>
                                                <option value="this_month">This Month</option>
                                                <option value="last_month">Last Month</option>
                                            </select>
                                            <i class="ti ti-calendar app-search-icon text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <div dir="ltr">
                                                <div id="total-orders-chart" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body-->
                            </div>
                            <!-- end card-->
                        </div>



            <!-- Recent Transactions Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1 text-dark">Recent Transactions</h5>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">TXN ID</th>
                                <th class="py-3">USER ID</th>
                                <th class="py-3">PLAN</th>
                                <th class="py-3">DATE</th>
                                <th class="py-3">AMOUNT</th>
                                <th class="pe-4 py-3">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="fs-13">
                            <!-- Row 1 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90182</td>
                                <td class="text-muted">TM-10481</td>
                                <td class="text-dark">Gold · 6 months</td>
                                <td class="text-muted">13 Oct 2026</td>
                                <td class="fw-medium text-dark">₹2,499</td>
                                <td class="pe-4"><span class="fw-semibold text-success">Success</span></td>
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90181</td>
                                <td class="text-muted">TM-10332</td>
                                <td class="text-dark">Silver · 3 months</td>
                                <td class="text-muted">13 Oct 2026</td>
                                <td class="fw-medium text-dark">₹999</td>
                                <td class="pe-4"><span class="fw-semibold text-success">Success</span></td>
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90180</td>
                                <td class="text-muted">TM-10298</td>
                                <td class="text-dark">Gold · 6 months</td>
                                <td class="text-muted">12 Oct 2026</td>
                                <td class="fw-medium text-dark">₹2,499</td>
                                <td class="pe-4"><span class="fw-semibold text-warning"
                                        style="color: #d39e00 !important;">Pending</span></td>
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90179</td>
                                <td class="text-muted">TM-10117</td>
                                <td class="text-dark">Silver · 3 months</td>
                                <td class="text-muted">12 Oct 2026</td>
                                <td class="fw-medium text-dark">₹999</td>
                                <td class="pe-4"><span class="fw-semibold" style="color: #e07e34;">Refund review</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <span class="text-muted fs-12">Showing 1-4 of 1,280 transactions</span>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link text-muted border-0" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link text-white rounded-2 mx-1 px-2 border-0"
                                    href="#" style="background-color: #561325;">1</a></li>
                            <li class="page-item"><a class="page-link text-dark rounded-2 mx-1 px-2 border-0" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link text-dark border-0" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Edit Plan Modal -->
            <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold" id="editPlanModalLabel" style="color: #561325;">Edit Membership
                                Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editPlanForm">
                            <div class="modal-body px-4">
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Plan Name</label>
                                    <input type="text" class="form-control fs-13" id="planName" value="Gold" required />
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Price (₹)</label>
                                        <input type="number" class="form-control fs-13" id="planPrice" value="2499"
                                            required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Duration (Months)</label>
                                        <input type="number" class="form-control fs-13" id="planDuration" value="6"
                                            required />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Features Description</label>
                                    <input type="text" class="form-control fs-13" id="planDesc"
                                        value="Premium discovery · priority support" required />
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 px-4 pb-4">
                                <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn fs-13 text-white fw-semibold"
                                    style="background-color: #561325;">Update Plan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\GenZ\backend\resources\views/report.blade.php ENDPATH**/ ?>