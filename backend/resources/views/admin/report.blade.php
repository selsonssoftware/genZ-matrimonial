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

<!--membership distribution-->

 <div class="col-xxl-3 col-xl-4">
                            <div class="card card-h-100">
                                <div class="card-header justify-content-between">
                                    <h4 class="card-title">Membership Distribution</h4>
                                    <!-- <div class="dropdown ms-auto">
                                        <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical fs-lg"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#"> <i class="ti ti-chart-bar me-2"></i> View Detailed Report </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"> <i class="ti ti-download me-2"></i> Export Analytics </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#"> <i class="ti ti-filter-2 me-2"></i> Apply Filters </a>
                                            </li>
                                            <li><hr class="dropdown-divider" /></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#"> <i class="ti ti-trash me-2"></i> Remove Widget </a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>

                                <div class="card-body p-0">
                                    <div class="row g-0">
                                        <div class="col">
                                            <!-- <div class="border-bottom p-2 border-end border-dashed">
                                                <h3 class="mb-0 d-flex gap-2 align-items-center justify-content-center">
                                                    <i class="ti ti-users"></i>
                                                    <span id="active-users-count">125</span>
                                                </h3>
                                            </div> -->
                                        </div>
                                        <div class="col">
                                            <!-- <div class="border-bottom p-2 border-dashed">
                                                <h3 class="mb-0 d-flex gap-2 align-items-center justify-content-center">
                                                    <i class="ti ti-device-analytics"></i>
                                                    <span id="active-views-count">125</span>
                                                </h3>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- end row-->
                                </div>

                                <div class="card-body">
                                    <div dir="ltr">
                                        <div id="total-users-chart" class="apex-charts"></div>
                                    </div>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-sm table-nowrap table-borderless table-centered mb-0">
                                            <thead class="bg-light bg-opacity-50 thead-sm">
                                                <tr class="text-uppercase fs-xxs">
                                                    <th>Gender</th>
                                                    <th>Views</th>
                                                    <th>B. Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">Male profiles</a>
                                                    </td>
                                                    <td>25</td>
                                                    <td>87.5%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">Female profiles</a>
                                                    </td>
                                                    <td>15</td>
                                                    <td>21.48%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0);" class="text-muted">Others / undisclosed</a>
                                                    </td>
                                                    <td>10</td>
                                                    <td>63.59%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end .table-responsive-->
                                    <!-- <div class="text-center mt-2">
                                        <a href="#" class="btn btn-sm btn-secondary">View All <i class="ti ti-arrow-right ms-1"></i></a>
                                    </div> -->
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
                    <h5 class="fw-bold mb-1 text-dark">Recent Transactions</h5>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">VENDOR ID</th>
                                <th class="py-3">AGENT ID</th>
                                <th class="py-3">CUSTOMERS</th>
                                <th class="py-3">CONVERTED</th>
                                <th class="py-3">COMMISION</th>
                                <th class="pe-4 py-3">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="fs-13">
                            <!-- Row 1 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">VN-90182</td>
                                <td class="text-muted">AG-10481</td>
                                <td class="text-dark">38</td>
                                <td class="text-muted">14</td>
                                <td class="fw-medium text-dark">₹2,499</td>
                                <td class="pe-4"><span class="fw-semibold text-success">Success</span></td>
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">VN-90181</td>
                                <td class="text-muted">AG-10332</td>
                                <td class="text-dark">25</td>
                                <td class="text-muted">10</td>
                                <td class="fw-medium text-dark">₹1,299</td>
                                <td class="pe-4"><span class="fw-semibold text-success">Success</span></td>
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">VN-90180</td>
                                <td class="text-muted">AG-10298</td>
                                <td class="text-dark">15</td>
                                <td class="text-muted">8</td>
                                <td class="fw-medium text-dark">₹1,299</td>
                                <td class="pe-4"><span class="fw-semibold text-warning"
                                        style="color: #d39e00 !important;">Pending</span></td>
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">VN-90179</td>
                                <td class="text-muted">AG-10117</td>
                                <td class="text-dark">12</td>
                                <td class="text-muted">5</td>
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
                            <li class="page-item"><a class="page-link text-dark border-0" href="#"></a></li>
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics | Thirumana Admin</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary: #79213d;
            --primary-dark: #51172b;
            --primary-light: #f6e8ed;
            --accent: #dca3b5;
            --gold: #d0a044;
            --background: #f7f3f2;
            --white: #ffffff;
            --text: #51172b;
            --muted: #897b80;
            --border: #eee4e7;
            --success: #258552;
            --danger: #c94d58;
            --shadow: 0 3px 15px rgba(81, 23, 43, 0.04);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            font-size: 14px;
        }

        button,
        input,
        select {
            font: inherit;
        }

        button {
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

        .header-title h1 {
            margin: 0 0 7px;
            color: var(--primary-dark);
            font-size: 27px;
            font-weight: 750;
            letter-spacing: -0.6px;
        }

        .header-title p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn {
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

        .btn-primary {
            background: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            background: var(--white);
            border-color: var(--border);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary-light);
        }

        /* Filters */

        .filter-panel {
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

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            min-width: 150px;
        }

        .filter-field label {
            color: #7c6870;
            font-size: 11px;
            font-weight: 650;
        }

        .filter-field input,
        .filter-field select {
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

        .filter-field input:focus,
        .filter-field select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(121, 33, 61, 0.07);
        }

        .date-range {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-range input {
            min-width: 135px;
        }

        .date-separator {
            color: var(--muted);
            font-size: 12px;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            margin-left: auto;
        }

        /* Summary cards */

        .report-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .report-card {
            position: relative;
            min-width: 0;
            padding: 19px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(81, 23, 43, 0.07);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 17px;
        }

        .card-icon {
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

        .card-change {
            padding: 5px 7px;
            background: #eaf6ee;
            color: var(--success);
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .card-label {
            margin: 0 0 7px;
            color: var(--muted);
            font-size: 12px;
        }

        .card-value {
            margin: 0 0 8px;
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -0.6px;
            overflow-wrap: anywhere;
        }

        .card-description {
            margin: 0;
            color: #9b8e93;
            font-size: 11px;
        }

        /* Charts */

        .charts-grid {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .report-panel {
            min-width: 0;
            padding: 21px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 11px;
            box-shadow: var(--shadow);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-header h2 {
            margin: 0 0 6px;
            color: var(--primary-dark);
            font-size: 15px;
            font-weight: 750;
        }

        .panel-header p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .chart-period {
            padding: 7px 9px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            color: var(--primary);
            font-size: 11px;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 245px;
        }

        /* Vendor table */

        .vendor-panel {
            margin-bottom: 20px;
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 17px;
        }

        .table-toolbar h2 {
            margin: 0 0 5px;
            color: var(--primary-dark);
            font-size: 15px;
        }

        .table-toolbar p {
            margin: 0;
            color: var(--muted);
            font-size: 11px;
        }

        .table-search {
            width: 220px;
            max-width: 100%;
            min-height: 37px;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 7px;
            outline: none;
            font-size: 12px;
        }

        .table-search:focus {
            border-color: var(--primary);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            white-space: nowrap;
        }

        .report-table thead {
            background: #f8f1f3;
        }

        .report-table th {
            padding: 14px 13px;
            color: #795263;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: 0.35px;
        }

        .report-table td {
            padding: 15px 13px;
            border-bottom: 1px solid #f0e8eb;
            color: #67535c;
            font-size: 12px;
        }

        .report-table tbody tr:last-child td {
            border-bottom: none;
        }

        .report-table tbody tr:hover {
            background: #fdf9fa;
        }

        .vendor-id {
            color: var(--primary);
            font-weight: 750;
        }

        .agent-cell {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .commission {
            color: var(--primary);
            font-weight: 750;
        }

        .conversion-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            background: #eaf6ee;
            color: var(--success);
            border-radius: 5px;
            font-size: 10px;
            font-weight: 700;
        }

        .table-footer {
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

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            width: 30px;
            height: 30px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--white);
            color: var(--primary);
        }

        .page-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        .empty-state {
            padding: 28px !important;
            text-align: center;
            color: var(--muted) !important;
        }

        /* Toast message */

        .report-toast {
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

        .report-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */

        @media (max-width: 1200px) {
            .report-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .filter-actions {
                margin-left: 0;
            }
        }

        @media (max-width: 900px) {
            .charts-grid {
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

            .reports-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-title h1 {
                font-size: 23px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .report-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .report-card {
                padding: 16px;
            }

            .card-value {
                font-size: 25px;
            }

            .filter-panel {
                align-items: stretch;
                flex-direction: column;
                padding: 14px;
            }

            .filter-field {
                width: 100%;
            }

            .date-range {
                width: 100%;
            }

            .date-range input {
                min-width: 0;
                width: 100%;
            }

            .filter-actions {
                width: 100%;
            }

            .filter-actions .btn {
                flex: 1;
            }

            .report-panel {
                padding: 15px;
            }

            .chart-container {
                height: 220px;
            }

            .table-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .table-search {
                width: 100%;
            }

            .table-footer {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<main class="reports-page">

    <!-- PAGE HEADER -->
    <header class="reports-header">
        <div class="header-title">
            <h1>Reports & Analytics</h1>
            <p>Monitor registrations, revenue, membership and vendor performance.</p>
        </div>

        <div class="header-actions">
            <button class="btn btn-outline" id="refreshBtn" type="button">
                ↻ Refresh
            </button>

            <button class="btn btn-primary" id="exportBtn" type="button">
                ↓ Export Report
            </button>
        </div>
    </header>

    <!-- FILTERS -->
    <section class="filter-panel">

        <div class="filter-field">
            <label for="startDate">Start Date</label>
            <input type="date" id="startDate">
        </div>

        <div class="filter-field">
            <label for="endDate">End Date</label>
            <input type="date" id="endDate">
        </div>

        <div class="filter-field">
            <label for="regionFilter">Region</label>
            <select id="regionFilter">
                <option value="all">All Regions</option>
                <option value="tamilnadu">Tamil Nadu</option>
                <option value="kerala">Kerala</option>
                <option value="karnataka">Karnataka</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="filter-actions">
            <button class="btn btn-primary" id="applyFiltersBtn" type="button">
                Apply Filters
            </button>

            <button class="btn btn-outline" id="resetFiltersBtn" type="button">
                Reset
            </button>
        </div>

    </section>

    <!-- SUMMARY CARDS -->
    <section class="report-stats">

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">♙</div>
                <span class="card-change">↑ 12.5%</span>
            </div>
            <p class="card-label">New Registrations</p>
            <h2 class="card-value" id="registrationValue">1,284</h2>
            <p class="card-description">Compared with the previous period</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">✓</div>
                <span class="card-change">↑ 5.2%</span>
            </div>
            <p class="card-label">Profile Completion</p>
            <h2 class="card-value">86.4%</h2>
            <p class="card-description">Member profiles completed</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">₹</div>
                <span class="card-change">↑ 8.7%</span>
            </div>
            <p class="card-label">Membership Sales</p>
            <h2 class="card-value">₹4.82L</h2>
            <p class="card-description">Total membership revenue</p>
        </article>

        <article class="report-card">
            <div class="card-top">
                <div class="card-icon">♧</div>
                <span class="card-change">↑ 10.1%</span>
            </div>
            <p class="card-label">Vendor-sourced Leads</p>
            <h2 class="card-value">642</h2>
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

                <select class="chart-period" id="trendPeriod"
                        aria-label="Registration chart period">
                    <option value="7">Last 7 days</option>
                    <option value="14">Last 14 days</option>
                    <option value="30">Last 30 days</option>
                </select>
            </div>

            <div class="chart-container">
                <canvas id="registrationChart"></canvas>
            </div>
        </article>

        <article class="report-panel">
            <div class="panel-header">
                <div>
                    <h2>Member Distribution</h2>
                    <p>Distribution of registered profiles</p>
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
                <p>Vendor registrations, conversions and commissions</p>
            </div>

            <input
                type="search"
                id="vendorSearch"
                class="table-search"
                placeholder="Search vendor or agent..."
                aria-label="Search vendors"
            >
        </div>

        <div class="table-responsive">
            <table class="report-table" id="vendorTable">
                <thead>
                    <tr>
                        <th>Vendor ID</th>
                        <th>Agent</th>
                        <th>Customers</th>
                        <th>Converted</th>
                        <th>Conversion Rate</th>
                        <th>Commission</th>
                    </tr>
                </thead>

                <tbody id="vendorTableBody"></tbody>
            </table>
        </div>

        <div class="table-footer">
            <span id="tableInfo">Showing vendor records</span>

            <div class="pagination" id="pagination">
                <button class="page-btn active" type="button">1</button>
            </div>
        </div>

    </section>

</main>

<div class="report-toast" id="reportToast" role="status"
     aria-live="polite"></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
"use strict";

/*
 * DEMO DATA
 * Replace this array with data from your backend/API.
 */
const vendorData = [
    {
        id: "VN-00248",
        agent: "R. Senthil",
        region: "tamilnadu",
        customers: 36,
        converted: 18,
        commission: 12500,
        date: "2026-10-13"
    },
    {
        id: "VN-00247",
        agent: "M. Fathima",
        region: "tamilnadu",
        customers: 21,
        converted: 11,
        commission: 8100,
        date: "2026-10-12"
    },
    {
        id: "VN-00246",
        agent: "K. Prakash",
        region: "kerala",
        customers: 18,
        converted: 9,
        commission: 6200,
        date: "2026-10-11"
    },
    {
        id: "VN-00245",
        agent: "S. Priya",
        region: "karnataka",
        customers: 42,
        converted: 27,
        commission: 15400,
        date: "2026-10-10"
    },
    {
        id: "VN-00244",
        agent: "A. Kumar",
        region: "tamilnadu",
        customers: 29,
        converted: 15,
        commission: 9400,
        date: "2026-10-09"
    },
    {
        id: "VN-00243",
        agent: "N. Revathi",
        region: "other",
        customers: 15,
        converted: 6,
        commission: 4300,
        date: "2026-10-08"
    }
];

let filteredVendors = [...vendorData];
let registrationChart = null;
let memberChart = null;

const money = amount =>
    new Intl.NumberFormat("en-IN", {
        style: "currency",
        currency: "INR",
        maximumFractionDigits: 0
    }).format(amount);

function showToast(message) {
    const toast = document.getElementById("reportToast");

    toast.textContent = message;
    toast.classList.add("show");

    clearTimeout(showToast.timer);

    showToast.timer = setTimeout(() => {
        toast.classList.remove("show");
    }, 2800);
}

/* CHARTS */

function createRegistrationChart() {
    const ctx = document.getElementById("registrationChart");

    registrationChart = new Chart(ctx, {
        type: "bar",

        data: {
            labels: [
                "Oct 1", "Oct 3", "Oct 5", "Oct 7",
                "Oct 9", "Oct 11", "Oct 13"
            ],

            datasets: [{
                label: "Registrations",
                data: [120, 145, 130, 180, 165, 210, 245],
                backgroundColor: "#dca3b5",
                hoverBackgroundColor: "#79213d",
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
                    backgroundColor: "#51172b",
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
                        color: "#f1e8eb"
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
            labels: [
                "Female profiles",
                "Male profiles",
                "Other / undisclosed"
            ],

            datasets: [{
                data: [48, 38, 14],
                backgroundColor: [
                    "#842742",
                    "#dba2b3",
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
                                context.formattedValue + "%";
                        }
                    }
                }
            }
        }
    });
}

/* TABLE RENDERING */

function renderVendorTable(data) {
    const tbody = document.getElementById("vendorTableBody");

    if (!data.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="empty-state">
                    No vendor records found.
                </td>
            </tr>
        `;

        document.getElementById("tableInfo").textContent =
            "No records found";

        document.getElementById("pagination").innerHTML = "";
        return;
    }

    tbody.innerHTML = data.map(vendor => {
        const rate = vendor.customers > 0
            ? (vendor.converted / vendor.customers) * 100
            : 0;

        return `
            <tr>
                <td>
                    <span class="vendor-id">${escapeHTML(vendor.id)}</span>
                </td>

                <td>
                    <span class="agent-cell">${escapeHTML(vendor.agent)}</span>
                </td>

                <td>${vendor.customers}</td>

                <td>${vendor.converted}</td>

                <td>
                    <span class="conversion-badge">
                        ${rate.toFixed(1)}%
                    </span>
                </td>

                <td>
                    <span class="commission">
                        ${money(vendor.commission)}
                    </span>
                </td>
            </tr>
        `;
    }).join("");

    document.getElementById("tableInfo").textContent =
        `Showing ${data.length} of ${vendorData.length} vendor records`;

    document.getElementById("pagination").innerHTML = `
        <button class="page-btn active" type="button" aria-current="page">1</button>
    `;
}

/* Prevent HTML injection when displaying text values */

function escapeHTML(value) {
    return String(value).replace(/[&<>"']/g, character => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    })[character]);
}

/* FILTERS */

function applyFilters() {
    const start = document.getElementById("startDate").value;
    const end = document.getElementById("endDate").value;
    const region = document.getElementById("regionFilter").value;
    const search = document.getElementById("vendorSearch")
        .value.trim().toLowerCase();

    if (start && end && start > end) {
        showToast("End date must be on or after the start date.");
        return;
    }

    filteredVendors = vendorData.filter(vendor => {
        const matchesStart = !start || vendor.date >= start;
        const matchesEnd = !end || vendor.date <= end;
        const matchesRegion = region === "all" ||
            vendor.region === region;

        const matchesSearch =
            vendor.id.toLowerCase().includes(search) ||
            vendor.agent.toLowerCase().includes(search);

        return matchesStart &&
            matchesEnd &&
            matchesRegion &&
            matchesSearch;
    });

    renderVendorTable(filteredVendors);

    /*
     * The summary cards and charts remain demo values.
     * Update them from your report API when integrating your backend.
     */
    showToast("Vendor table filters applied.");
}

function resetFilters() {
    document.getElementById("startDate").value = "";
    document.getElementById("endDate").value = "";
    document.getElementById("regionFilter").value = "all";
    document.getElementById("vendorSearch").value = "";

    filteredVendors = [...vendorData];

    renderVendorTable(filteredVendors);

    showToast("Filters have been reset.");
}

/* CHART PERIOD SELECTOR */

function updateTrendPeriod() {
    const period = Number(
        document.getElementById("trendPeriod").value
    );

    let labels;
    let values;

    if (period === 7) {
        labels = ["Oct 7", "Oct 8", "Oct 9", "Oct 10",
                  "Oct 11", "Oct 12", "Oct 13"];
        values = [120, 145, 130, 180, 165, 210, 245];
    } else if (period === 14) {
        labels = Array.from({ length: 14 }, (_, i) =>
            `Day ${i + 1}`
        );

        values = [80, 95, 110, 90, 125, 145, 130,
                  160, 155, 180, 170, 195, 220, 245];
    } else {
        labels = Array.from({ length: 30 }, (_, i) =>
            `${i + 1}`
        );

        values = Array.from({ length: 30 }, (_, i) =>
            Math.round(80 + i * 4 + 20 * Math.abs(Math.sin(i)))
        );
    }

    registrationChart.data.labels = labels;
    registrationChart.data.datasets[0].data = values;
    registrationChart.update();
}

/* EXPORT VENDOR DATA TO CSV */

function exportReport() {
    if (!filteredVendors.length) {
        showToast("There are no vendor records to export.");
        return;
    }

    const headers = [
        "Vendor ID",
        "Agent",
        "Region",
        "Customers",
        "Converted",
        "Conversion Rate",
        "Commission",
        "Date"
    ];

    const rows = filteredVendors.map(vendor => {
        const rate = vendor.customers > 0
            ? ((vendor.converted / vendor.customers) * 100).toFixed(1) + "%"
            : "0%";

        return [
            vendor.id,
            vendor.agent,
            vendor.region,
            vendor.customers,
            vendor.converted,
            rate,
            vendor.commission,
            vendor.date
        ];
    });

    const csvEscape = value =>
        '"' + String(value).replace(/"/g, '""') + '"';

    const csv = [headers, ...rows]
        .map(row => row.map(csvEscape).join(","))
        .join("\r\n");

    const blob = new Blob(
        ["\uFEFF" + csv],
        { type: "text/csv;charset=utf-8;" }
    );

    const url = URL.createObjectURL(blob);
    const link = document.createElement("a");

    link.href = url;
    link.download = "vendor-performance-report.csv";

    document.body.appendChild(link);
    link.click();
    link.remove();

    URL.revokeObjectURL(url);

    showToast("Vendor report CSV downloaded.");
}

/* EVENT LISTENERS */

document.getElementById("applyFiltersBtn")
    .addEventListener("click", applyFilters);

document.getElementById("resetFiltersBtn")
    .addEventListener("click", resetFilters);

document.getElementById("exportBtn")
    .addEventListener("click", exportReport);

document.getElementById("refreshBtn")
    .addEventListener("click", () => {
        resetFilters();
        updateTrendPeriod();
        showToast("Report view refreshed.");
    });

document.getElementById("vendorSearch")
    .addEventListener("input", applyFilters);

document.getElementById("trendPeriod")
    .addEventListener("change", updateTrendPeriod);

/* INITIALIZE PAGE */

createRegistrationChart();
createMemberChart();
renderVendorTable(filteredVendors);
</script>

</body>
</html>

@endsection