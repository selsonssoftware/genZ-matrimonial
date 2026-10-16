@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Matches &amp; Interests</h3>
                    <p class="text-muted mb-0 fs-13">Monitor interest requests, matches and member safety.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search Box -->
                    <div class="input-group shadow-sm" style="width: 170px;">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                            <i class="ti ti-search fs-14"></i>
                        </span>
                        <input type="text" class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                            placeholder="Search" />
                    </div>

                    <!-- Bell/Notification Icon -->
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

            <!-- Metric KPI Cards -->
            <div class="row g-3 mb-4">
                <!-- Interest requests -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+11.2%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Interest requests</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricInterests">2,486</h3>
                        </div>
                    </div>
                </div>

                <!-- Awaiting response -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">⏱</span>
                                <span class="text-muted fs-11">Awaiting</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Awaiting response</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricAwaiting">318</h3>
                        </div>
                    </div>
                </div>

                <!-- Mutual interests -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #E8F8F0; color: #0E9F6E; font-size: 13px;">✓</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+5.8%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Mutual interests</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricMutual">746</h3>
                        </div>
                    </div>
                </div>

                <!-- Reported profiles -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FDE8E8; color: #E02424; font-size: 13px;">!</span>
                                <span class="text-danger fs-11 fw-semibold">Requires review</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Reported profiles</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricReported">14</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search Bar -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center justify-content-between">
                        <div class="col-xl-4 col-md-5 col-sm-12">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                    <i class="ti ti-search fs-14"></i>
                                </span>
                                <input type="text" id="interestSearchInput" class="form-control border-start-0 ps-1 fs-13"
                                    placeholder="Search Request ID or Member ID">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <select id="interestStatusFilter" class="form-select fs-13 text-secondary border">
                                <option value="">All statuses</option>
                                <option value="Awaiting">Awaiting</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Rejected">Rejected</option>
                                <option value="Reported">Reported</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-md-3 col-sm-6 text-sm-end text-start">
                            <button class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                                style="background-color: #561325;">
                                Export Logs <i class="ti ti-download ms-1 fs-12"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interest Activity Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">Interest Activity</h5>
                    <p class="text-muted fs-12 mb-0">Track request status and investigate reports with appropriate privacy
                        controls.</p>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0 table-hover">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">REQUEST ID</th>
                                <th class="py-3">MEMBER PAIR</th>
                                <th class="py-3">DATE</th>
                                <th class="py-3">STATUS</th>
                                <th class="text-center pe-4 py-3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="activityTableBody" class="fs-13">
                            <!-- Populated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Privacy Note Footer Box -->
                <div class="p-3 m-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                    <p class="fs-12 mb-0 d-flex align-items-center" style="color: #8D6718;">
                        <i class="ti ti-lock me-2 fs-15"></i>
                        <span><strong>Privacy note:</strong> Restrict admin access to sensitive messages; log all profile
                            and report actions.</span>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const activityData = [
                { id: "IN-00842", pair: "TM-10482 → TM-10210", date: "13 Oct 2026", status: "Awaiting", actionText: "View", actionType: "view" },
                { id: "IN-00841", pair: "TM-10332 → TM-10194", date: "13 Oct 2026", status: "Accepted", actionText: "View", actionType: "view" },
                { id: "IN-00840", pair: "TM-10421 → TM-10083", date: "12 Oct 2026", status: "Rejected", actionText: "View", actionType: "view" },
                { id: "IN-00839", pair: "TM-10209 → TM-10121", date: "12 Oct 2026", status: "Reported", actionText: "Investigate", actionType: "danger" },
                { id: "IN-00838", pair: "TM-10398 → TM-10074", date: "11 Oct 2026", status: "Accepted", actionText: "View", actionType: "view" }
            ];

            const statusBadges = {
                'Awaiting': 'bg-warning-subtle text-warning border border-warning-subtle',
                'Accepted': 'bg-success-subtle text-success border border-success-subtle',
                'Rejected': 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                'Reported': 'bg-danger-subtle text-danger border border-danger-subtle'
            };

            const tbody = document.getElementById('activityTableBody');
            const searchInput = document.getElementById('interestSearchInput');
            const statusFilter = document.getElementById('interestStatusFilter');

            function renderActivities(list) {
                tbody.innerHTML = '';
                if (list.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-muted">No activity records match your criteria.</td></tr>`;
                    return;
                }

                list.forEach(item => {
                    const tr = document.createElement('tr');
                    const actionButton = item.actionType === 'danger'
                        ? `<button class="btn btn-sm btn-link text-danger fw-semibold p-0 text-decoration-none">Investigate</button>`
                        : `<button class="btn btn-sm btn-link text-dark fw-medium p-0 text-decoration-none">View</button>`;

                    tr.innerHTML = `
                        <td class="ps-4 fw-semibold text-dark">${item.id}</td>
                        <td class="fw-medium text-dark">${item.pair}</td>
                        <td class="text-muted">${item.date}</td>
                        <td>
                            <span class="badge rounded-pill px-2 py-1 fs-11 ${statusBadges[item.status]}">
                                ${item.status}
                            </span>
                        </td>
                        <td class="text-center pe-4">
                            ${actionButton}
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }

            function filterList() {
                const query = searchInput.value.toLowerCase().trim();
                const status = statusFilter.value;

                const filtered = activityData.filter(item => {
                    const matchesQuery = item.id.toLowerCase().includes(query) ||
                        item.pair.toLowerCase().includes(query);
                    const matchesStatus = !status || item.status === status;
                    return matchesQuery && matchesStatus;
                });

                renderActivities(filtered);
            }

            searchInput.addEventListener('input', filterList);
            statusFilter.addEventListener('change', filterList);

            // Initial render
            renderActivities(activityData);
        });
    </script>
@endsection