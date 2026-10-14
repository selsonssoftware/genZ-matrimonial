@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Membership & Matrimony Payments</h3>
                    <p class="text-muted mb-0 fs-13">Manage member upgrade plans, contact view packages, subscriptions and
                        invoices.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search Input -->
                    <div class="input-group shadow-sm" style="width: 180px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search Matrimony ID..." />
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
                <!-- Active Subscriptions -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 26px; height: 26px; background-color: #FCECEE; color: #561325; font-size: 13px;">
                                    <i class="ti ti-users"></i>
                                </span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+9.6%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Active Premium Profiles</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;">3,482</h3>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 26px; height: 26px; background-color: #FCECEE; color: #561325; font-size: 13px;">
                                    <i class="ti ti-currency-rupee"></i>
                                </span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+15.2%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Subscription Revenue (This Month)</div>
                            <h3 class="fw-bold mb-0 text-dark">₹4.82L</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending Verifications / Payments -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 26px; height: 26px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">
                                    <i class="ti ti-clock"></i>
                                </span>
                                <span class="text-muted fs-11">Offline / UPI review</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Pending Approvals</div>
                            <h3 class="fw-bold mb-0 text-dark">62</h3>
                        </div>
                    </div>
                </div>

                <!-- Refund Requests -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 26px; height: 26px; background-color: #FDE8E8; color: #E02424; font-size: 13px;">
                                    <i class="ti ti-arrow-back-up"></i>
                                </span>
                                <span class="text-danger fs-11 fw-semibold">Disputes</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Refund Requests</div>
                            <h3 class="fw-bold mb-0 text-dark">8</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matrimony Membership Plans Section -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0 text-dark">Matrimony Membership Tiers</h5>
                    <button type="button" class="btn btn-sm text-white fw-semibold px-3 py-1 rounded-3 shadow-sm"
                        style="background-color: #561325;" data-bs-toggle="modal" data-bs-target="#editPlanModal">
                        <i class="ti ti-plus me-1"></i> Add Custom Package
                    </button>
                </div>

                <div class="row g-3">
                    <!-- Free / Basic Tier -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative"
                            style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 44px; height: 44px; background-color: #FCECEE; color: #561325;">
                                            <i class="ti ti-heart-handshake fs-20"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-dark mb-0">Free Match</h5>
                                            <h4 class="fw-bold mb-0" style="color: #561325;">₹0</h4>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled fs-12 text-muted mb-3">
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Create complete
                                            Bio-data</li>
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Send up to 5 Express
                                            Interests</li>
                                        <li class="text-muted opacity-50"><i class="ti ti-x text-danger me-1"></i> View
                                            Contact Numbers (Locked)</li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-sm rounded-3 fw-semibold px-3 py-2 w-100"
                                    data-bs-toggle="modal" data-bs-target="#editPlanModal"
                                    style="background-color: #FCECEE; color: #561325; border: 1px solid #F5D3D8;">
                                    Configure Tier
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Silver Matrimony Tier -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative"
                            style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 44px; height: 44px; background-color: #FCECEE; color: #561325;">
                                            <i class="ti ti-sparkles fs-20"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-dark mb-0">Silver Connect</h5>
                                            <h4 class="fw-bold mb-0" style="color: #561325;">₹999 <span
                                                    class="fs-13 fw-normal text-muted">/ 3 Months</span></h4>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled fs-12 text-muted mb-3">
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> View 30 Verified
                                            Mobile Numbers</li>
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Send Unlimited
                                            Express Interests</li>
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Kundali / Horoscope
                                            Matching Access</li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-sm rounded-3 fw-semibold px-3 py-2 w-100"
                                    data-bs-toggle="modal" data-bs-target="#editPlanModal"
                                    style="background-color: #FCECEE; color: #561325; border: 1px solid #F5D3D8;">
                                    Configure Tier
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Gold Matrimony Tier -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white position-relative"
                            style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="rounded-3 d-flex align-items-center justify-content-center me-3"
                                            style="width: 44px; height: 44px; background-color: #FCECEE; color: #561325;">
                                            <i class="ti ti-crown fs-20"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-dark mb-0">Gold Alliance</h5>
                                            <h4 class="fw-bold mb-0" style="color: #561325;">₹2,499 <span
                                                    class="fs-13 fw-normal text-muted">/ 6 Months</span></h4>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled fs-12 text-muted mb-3">
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> View 100 Verified
                                            Direct Contacts</li>
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Priority Profile
                                            Placement in Searches</li>
                                        <li class="mb-1"><i class="ti ti-check text-success me-1"></i> Dedicated
                                            Relationship Executive</li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-sm rounded-3 fw-semibold px-3 py-2 w-100"
                                    data-bs-toggle="modal" data-bs-target="#editPlanModal"
                                    style="background-color: #FCECEE; color: #561325; border: 1px solid #F5D3D8;">
                                    Configure Tier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Matrimony Transactions Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div
                    class="card-header bg-white border-0 pt-4 px-4 pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">Matrimony Subscription Logs</h5>
                        <p class="text-muted fs-12 mb-0">Track payments, gateway orders, renewals, and member invoices.</p>
                    </div>
                    <button class="btn btn-sm fw-semibold rounded-3"
                        style="background-color: #FAF5F5; color: #561325; border: 1px solid #F3E5E8;">
                        <i class="ti ti-file-spreadsheet me-1"></i> Export Statement
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">INVOICE ID</th>
                                <th class="py-3">MEMBER DETAILS</th>
                                <th class="py-3">MATRIMONY PLAN</th>
                                <th class="py-3">PAYMENT MODE</th>
                                <th class="py-3">DATE & TIME</th>
                                <th class="py-3">AMOUNT</th>
                                <th class="py-3">STATUS</th>
                                <th class="pe-4 py-3 text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="fs-13">
                            <!-- Row 1 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90182</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            class="avatar-xs rounded-circle bg-light d-flex align-items-center justify-content-center text-dark fw-bold fs-11">
                                            AK
                                        </div>
                                        <div>
                                            <span class="fw-medium text-dark d-block">Arun Kumar</span>
                                            <small class="text-muted">TM-10481 (Groom)</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">Gold Alliance ·
                                        6 Mo</span></td>
                                <td><i class="ti ti-brand-google-filled text-danger me-1"></i> UPI (PhonePe)</td>
                                <td class="text-muted">13 Oct 2026, <small>04:30 PM</small></td>
                                <td class="fw-bold text-dark">₹2,499</td>
                                <td><span
                                        class="badge rounded-pill bg-success-subtle text-success border border-success-subtle">Success</span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-light border-0 p-1" title="Download Invoice"><i
                                            class="ti ti-download fs-15"></i></button>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90181</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            class="avatar-xs rounded-circle bg-light d-flex align-items-center justify-content-center text-dark fw-bold fs-11">
                                            PS
                                        </div>
                                        <div>
                                            <span class="fw-medium text-dark d-block">Priya S.</span>
                                            <small class="text-muted">TM-10332 (Bride)</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info-emphasis">Silver Connect · 3
                                        Mo</span></td>
                                <td><i class="ti ti-credit-card text-primary me-1"></i> Razorpay (HDFC)</td>
                                <td class="text-muted">13 Oct 2026, <small>11:15 AM</small></td>
                                <td class="fw-bold text-dark">₹999</td>
                                <td><span
                                        class="badge rounded-pill bg-success-subtle text-success border border-success-subtle">Success</span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-light border-0 p-1" title="Download Invoice"><i
                                            class="ti ti-download fs-15"></i></button>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90180</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            class="avatar-xs rounded-circle bg-light d-flex align-items-center justify-content-center text-dark fw-bold fs-11">
                                            KM
                                        </div>
                                        <div>
                                            <span class="fw-medium text-dark d-block">Karthik M.</span>
                                            <small class="text-muted">TM-10298 (Groom)</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">Gold Alliance ·
                                        6 Mo</span></td>
                                <td><i class="ti ti-building-bank text-secondary me-1"></i> Net Banking (SBI)</td>
                                <td class="text-muted">12 Oct 2026, <small>07:45 PM</small></td>
                                <td class="fw-bold text-dark">₹2,499</td>
                                <td><span
                                        class="badge rounded-pill bg-warning-subtle text-warning border border-warning-subtle">Pending</span>
                                </td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-light border-0 p-1" title="Approve Offline Payment"><i
                                            class="ti ti-check fs-15 text-success"></i></button>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">TX-90179</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div
                                            class="avatar-xs rounded-circle bg-light d-flex align-items-center justify-content-center text-dark fw-bold fs-11">
                                            DP
                                        </div>
                                        <div>
                                            <span class="fw-medium text-dark d-block">Divya P.</span>
                                            <small class="text-muted">TM-10117 (Bride)</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill bg-info-subtle text-info-emphasis">Silver Connect · 3
                                        Mo</span></td>
                                <td><i class="ti ti-brand-google-filled text-danger me-1"></i> UPI (GPay)</td>
                                <td class="text-muted">12 Oct 2026, <small>02:10 PM</small></td>
                                <td class="fw-bold text-dark">₹999</td>
                                <td><span
                                        class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle">Refund
                                        review</span></td>
                                <td class="pe-4 text-center">
                                    <button class="btn btn-sm btn-light border-0 p-1" title="Review Dispute"><i
                                            class="ti ti-eye fs-15 text-primary"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <span class="text-muted fs-12">Showing 1-4 of 1,280 matrimony transactions</span>
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

            <!-- Edit Matrimony Plan Modal -->
            <div class="modal fade" id="editPlanModal" tabindex="-1" aria-labelledby="editPlanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold" id="editPlanModalLabel" style="color: #561325;">Configure
                                Matrimony Package</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editPlanForm">
                            <div class="modal-body px-4">
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Package Tier Name</label>
                                    <input type="text" class="form-control fs-13" id="planName" value="Gold Alliance"
                                        required />
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Price (INR ₹)</label>
                                        <input type="number" class="form-control fs-13" id="planPrice" value="2499"
                                            required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Validity (Months)</label>
                                        <input type="number" class="form-control fs-13" id="planDuration" value="6"
                                            required />
                                    </div>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Direct Contacts Unlock</label>
                                        <input type="number" class="form-control fs-13" id="contactLimit" value="100"
                                            required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fs-13 fw-semibold">Horoscope Access</label>
                                        <select class="form-select fs-13">
                                            <option value="Yes" selected>Enabled</option>
                                            <option value="No">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Short Highlights</label>
                                    <input type="text" class="form-control fs-13" id="planDesc"
                                        value="Priority search · dedicated advisor support" required />
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 px-4 pb-4">
                                <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn fs-13 text-white fw-semibold"
                                    style="background-color: #561325;">Save Matrimony Tier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

        <!-- Footer -->
        <footer class="footer py-3 bg-white border-top">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start fs-12 text-muted">
                        ©
                        <script>document.write(new Date().getFullYear())</script> Thirumana Matrimony Portal
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex justify-content-end gap-3 fs-12">
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Payment Policy</a>
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Terms of Service</a>
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Support Desk</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection