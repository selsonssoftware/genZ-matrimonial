@extends('layout')

@section('content')
    <div class="content-page">
        <div id="managementPage" class="container-fluid py-4 px-4"
            data-members="{{ json_encode($usersData ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}"
            style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">User Management</h3>
                    <p class="text-muted mb-0 fs-13">Search, review and manage member accounts.</p>
                </div>

                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <button type="button"
                        class="btn btn-sm btn-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                        style="width: 34px; height: 34px; background-color: #fff;">
                        <i class="ti ti-bell fs-16 text-muted"></i>
                    </button>

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

            <!-- Filter & Actions Bar Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center">

                        <!-- Search -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                    <i class="ti ti-search fs-14"></i>
                                </span>
                                <input type="text" id="userSearchInput" class="form-control border-start-0 ps-1 fs-13"
                                    placeholder="Search name, email, ID or city">
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                            <select id="filterGender" class="form-select fs-13 text-secondary border">
                                <option value="">All genders</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                            <select id="filterStatus" class="form-select fs-13 text-secondary border">
                                <option value="">All statuses</option>
                                <option value="Active">Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Review">Review</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>

                        <!-- Membership -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-12">
                            <select id="filterPlan" class="form-select fs-13 text-secondary border">
                                <option value="">Membership</option>
                                <option value="Free">Free</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                            <div class="d-flex gap-2 justify-content-xl-end justify-content-start flex-wrap">

                                <button type="button" data-bs-toggle="modal" data-bs-target="#addUserModal"
                                    class="btn btn-sm text-nowrap fw-semibold px-3 py-2 rounded-3"
                                    style="background-color: #FCECEE; color: #561325; border: 1px solid #F5D3D8;">
                                    + Add User
                                </button>

                                <a href="{{ route('users.export') }}" id="exportBtn"
                                    class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm text-decoration-none d-flex align-items-center"
                                    style="background-color: #561325;">
                                    Export <i class="ti ti-download ms-1 fs-12"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Metric / Stats Cards -->
            <div class="row g-3 mb-4">

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">All members</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="countAll">
                                {{ number_format($counts['all'] ?? 0) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Active</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countActive">
                                {{ number_format($counts['active'] ?? 0) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Pending</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countPending">
                                {{ number_format($counts['pending'] ?? 0) }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2"
                                style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                            <div class="text-muted fs-12 mb-1">Suspended</div>
                            <h3 class="fw-bold mb-0 text-dark" id="countSuspended">
                                {{ number_format($counts['suspended'] ?? 0) }}
                            </h3>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Members Table Section Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">

                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">All Members</h5>
                    <p class="text-muted fs-12 mb-0">Manage member profiles, membership and account status.</p>
                </div>

                <div class="table-responsive">
                    <table id="usersTable" class="table align-middle mb-0 table-hover js-data-table" data-empty-table="No members found in database.">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">USER ID</th>
                                <th class="py-3">MEMBER</th>
                                <th class="py-3">GENDER · AGE</th>
                                <th class="py-3">CITY</th>
                                <th class="py-3">STATUS</th>
                                <th class="py-3">PLAN</th>
                                <th class="text-center pe-4 py-3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="fs-13">
                            @if ($usersData->isEmpty())
                                <tr>
                                    <td colspan="7" class="py-4 text-center text-muted">
                                        No members found in database.
                                    </td>
                                </tr>
                            @else
                                @foreach ($usersData as $member)
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">{{ $member['id'] }}</td>
                                        <td class="text-dark fw-medium">
                                            {{ $member['name'] }}
                                            <small class="d-block text-muted fw-normal">{{ $member['email'] ?? '' }}</small>
                                        </td>
                                        <td class="text-muted">
                                            {{ $member['gender'] ?? '-' }} · {{ $member['age'] ?? '-' }}
                                        </td>
                                        <td class="text-dark">{{ $member['city'] ?? '-' }}</td>
                                        <td>
                                            <span class="fw-semibold {{ ['Active' => 'text-success', 'Suspended' => 'text-danger', 'Pending' => 'text-warning'][$member['status'] ?? ''] ?? 'text-muted' }}">
                                                {{ $member['status'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{ ($member['plan'] ?? '') === 'Premium' ? 'fw-bold text-dark' : 'text-muted' }}">
                                                {{ $member['plan'] ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-center pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light border-0 text-muted px-2 py-1"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    •••
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 fs-13">
                                                    <li>
                                                        <a class="dropdown-item py-2 text-dark js-edit-member"
                                                            href="javascript:void(0)" data-member-id="{{ $member['db_id'] }}">
                                                            <i class="ti ti-edit me-2 text-primary"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item py-2 text-danger js-delete-member"
                                                            href="javascript:void(0)" data-member-id="{{ $member['db_id'] }}">
                                                            <i class="ti ti-trash me-2"></i> Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div
                    class="card-footer bg-white border-0 py-3 px-4 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <span class="text-muted fs-12" id="paginationLabel">Showing 0 members</span>
                </div>

            </div>

        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">

                <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold" id="addUserModalLabel" style="color: #561325;">Add New Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="modal-body px-4">
                        <div id="addUserErrors" class="alert alert-danger d-none" role="alert"></div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control fs-13" id="newUserName"
                                placeholder="e.g. Priyan S." required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control fs-13" id="newUserEmail"
                                placeholder="e.g. priyan@example.com" maxlength="191" required />
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Gender</label>
                                <select name="gender" class="form-select fs-13" id="newUserGender" required>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Age</label>
                                <input type="number" name="age" class="form-control fs-13" id="newUserAge" placeholder="26"
                                    min="18" max="100" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">City</label>
                            <input type="text" name="city" class="form-control fs-13" id="newUserCity"
                                placeholder="e.g. Chennai" required />
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Status</label>
                                <select name="status" class="form-select fs-13" id="newUserStatus" required>
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Review">Review</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Plan</label>
                                <select name="plan" class="form-select fs-13" id="newUserPlan" required>
                                    <option value="Free">Free</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-top-0 px-4 pb-4">
                        <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveUserBtn" class="btn fs-13 text-white fw-semibold"
                            style="background-color: #561325;">Create User</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">

                <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold" id="editUserModalLabel" style="color: #561325;">Edit Member Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editUserForm">
                    @csrf
                    <input type="hidden" id="editDbId">

                    <div class="modal-body px-4">
                        <div id="editUserErrors" class="alert alert-danger d-none" role="alert"></div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control fs-13" id="editUserName" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control fs-13" id="editUserEmail"
                                maxlength="191" required />
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Gender</label>
                                <select name="gender" class="form-select fs-13" id="editUserGender" required>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Age</label>
                                <input type="number" name="age" class="form-control fs-13" id="editUserAge" min="18"
                                    max="100" required />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fs-13 fw-semibold">City</label>
                            <input type="text" name="city" class="form-control fs-13" id="editUserCity" required />
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Status</label>
                                <select name="status" class="form-select fs-13" id="editUserStatus" required>
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Review">Review</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fs-13 fw-semibold">Plan</label>
                                <select name="plan" class="form-select fs-13" id="editUserPlan" required>
                                    <option value="Free">Free</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-top-0 px-4 pb-4">
                        <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="updateUserBtn" class="btn fs-13 text-white fw-semibold"
                            style="background-color: #561325;">Update Member</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function initializeManagementPage() {

            let membersData = JSON.parse(document.getElementById('managementPage').dataset.members);

            const statusColorMap = {
                'Active': 'color: #28a745;',
                'Pending': 'color: #d39e00;',
                'Review': 'color: #e07e34;',
                'Suspended': 'color: #dc3545;'
            };

            const tbody = document.getElementById('usersTableBody');
            const searchInput = document.getElementById('userSearchInput');
            const filterGender = document.getElementById('filterGender');
            const filterStatus = document.getElementById('filterStatus');
            const filterPlan = document.getElementById('filterPlan');
            const paginationLabel = document.getElementById('paginationLabel');
            const exportBtn = document.getElementById('exportBtn');
            const updateUrlTemplate = "{{ route('users.update', ['id' => '__USER_ID__']) }}";
            const deleteUrlTemplate = "{{ route('users.destroy', ['id' => '__USER_ID__']) }}";

            function safeText(value) {
                return String(value ?? '');
            }

            function escapeHtml(value) {
                return safeText(value).replace(/[&<>"']/g, function (char) {
                    return {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    }[char];
                });
            }

            function clearErrors(containerId) {
                const container = document.getElementById(containerId);
                container.replaceChildren();
                container.classList.add('d-none');
            }

            function showErrors(containerId, result, status) {
                const container = document.getElementById(containerId);
                const messages = Object.values(result.errors || {}).flat();
                container.replaceChildren();

                if (messages.length > 0) {
                    const list = document.createElement('ul');
                    list.className = 'mb-0 ps-3';
                    messages.forEach(message => {
                        const item = document.createElement('li');
                        item.textContent = message;
                        list.appendChild(item);
                    });
                    container.appendChild(list);
                } else {
                    container.textContent = result.message || `Request failed (${status}). Please try again.`;
                }

                container.classList.remove('d-none');
            }

            function updateCounts(counts) {
                if (!counts) return;

                Object.entries({
                    all: 'countAll',
                    active: 'countActive',
                    pending: 'countPending',
                    suspended: 'countSuspended'
                }).forEach(([key, elementId]) => {
                    const element = document.getElementById(elementId);
                    if (element && counts[key] !== undefined) {
                        element.innerText = Number(counts[key]).toLocaleString();
                    }
                });
            }

            async function responseJson(response) {
                try {
                    return await response.json();
                } catch (error) {
                    return {};
                }
            }

            function renderRows(list) {
                const dataTable = window.jQuery
                    && jQuery.fn.DataTable
                    && jQuery.fn.DataTable.isDataTable('#usersTable')
                    ? jQuery('#usersTable').DataTable()
                    : null;

                if (dataTable) {
                    dataTable.clear();
                } else {
                    tbody.innerHTML = '';
                }

                if (!list || list.length === 0) {
                    if (dataTable) {
                        dataTable.draw();
                    }
                    paginationLabel.innerText = 'Showing 0 members';
                    return;
                }

                list.forEach(item => {
                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                            <td class="ps-4 fw-semibold text-dark">
                                ${escapeHtml(item.id)}
                            </td>

                            <td class="text-dark fw-medium">
                                ${escapeHtml(item.name)}
                                <small class="d-block text-muted fw-normal">${escapeHtml(item.email || '')}</small>
                            </td>

                            <td class="text-muted">
                                ${escapeHtml(item.gender || '-')} · ${escapeHtml(item.age || '-')}
                            </td>

                            <td class="text-dark">
                                ${escapeHtml(item.city || '-')}
                            </td>

                            <td>
                                <span class="fw-semibold" style="${statusColorMap[item.status] || ''}">
                                    ${escapeHtml(item.status || '-')}
                                </span>
                            </td>

                            <td>
                                <span class="${item.plan === 'Premium' ? 'fw-bold text-dark' : 'text-muted'}">
                                    ${escapeHtml(item.plan || '-')}
                                </span>
                            </td>

                            <td class="text-center pe-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border-0 text-muted px-2 py-1"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        •••
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 fs-13">
                                        <li>
                                            <a class="dropdown-item py-2 text-dark"
                                                href="javascript:void(0)"
                                                onclick="openEditModal(${Number(item.db_id)})">
                                                <i class="ti ti-edit me-2 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 text-danger"
                                                href="javascript:void(0)"
                                                onclick="deleteUser(${Number(item.db_id)})">
                                                <i class="ti ti-trash me-2"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        `;

                    if (dataTable) {
                        dataTable.row.add(tr);
                    } else {
                        tbody.appendChild(tr);
                    }
                });

                if (dataTable) {
                    dataTable.draw();
                }

                paginationLabel.innerText = `Showing ${list.length} member(s)`;
            }

            function filterList() {
                const query = searchInput.value.toLowerCase().trim();
                const gender = filterGender.value;
                const status = filterStatus.value;
                const plan = filterPlan.value;

                const filtered = membersData.filter(item => {
                    const matchesQuery =
                        safeText(item.name).toLowerCase().includes(query) ||
                        safeText(item.id).toLowerCase().includes(query) ||
                        safeText(item.email).toLowerCase().includes(query) ||
                        safeText(item.city).toLowerCase().includes(query);

                    const matchesGender = !gender || item.gender === gender;
                    const matchesStatus = !status || item.status === status;
                    const matchesPlan = !plan || item.plan === plan;

                    return matchesQuery && matchesGender && matchesStatus && matchesPlan;
                });

                renderRows(filtered);
                updateExportUrl();
            }

            function updateExportUrl() {
                const params = new URLSearchParams({
                    search: searchInput.value.trim(),
                    gender: filterGender.value,
                    status: filterStatus.value,
                    plan: filterPlan.value
                });

                exportBtn.href = `{{ route('users.export') }}?${params.toString()}`;
            }

            searchInput.addEventListener('input', filterList);
            filterGender.addEventListener('change', filterList);
            filterStatus.addEventListener('change', filterList);
            filterPlan.addEventListener('change', filterList);
            filterList();

            // Create User via AJAX
            document.getElementById('addUserForm').addEventListener('submit', async function (e) {
                e.preventDefault();

                const saveBtn = document.getElementById('saveUserBtn');
                clearErrors('addUserErrors');
                saveBtn.disabled = true;
                saveBtn.innerText = 'Saving...';

                const formData = new FormData(this);

                try {
                    const response = await fetch("{{ route('users.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const result = await responseJson(response);

                    if (response.ok && result.success) {
                        const newMember = {
                            db_id: result.data.db_id,
                            id: result.data.member_id,
                            name: result.data.name,
                            email: result.data.email,
                            gender: result.data.gender,
                            age: result.data.age,
                            city: result.data.city,
                            status: result.data.status,
                            plan: result.data.plan
                        };

                        membersData.unshift(newMember);
                        filterList();
                        updateCounts(result.counts);

                        const modalEl = document.getElementById('addUserModal');
                        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modal.hide();

                        this.reset();
                        clearErrors('addUserErrors');
                    } else {
                        showErrors('addUserErrors', result, response.status);
                    }

                } catch (error) {
                    console.error('Save failed:', error);
                    showErrors('addUserErrors', { message: 'Unable to save the member. Check your connection and try again.' }, 0);
                } finally {
                    saveBtn.disabled = false;
                    saveBtn.innerText = 'Create User';
                }
            });

            // Open Edit Modal & Populate
            window.openEditModal = function (dbId) {
                const user = membersData.find(u => u.db_id == dbId);

                if (!user) return;

                document.getElementById('editDbId').value = user.db_id;
                document.getElementById('editUserName').value = user.name || '';
                document.getElementById('editUserEmail').value = user.email || '';
                document.getElementById('editUserGender').value = user.gender || 'Female';
                document.getElementById('editUserAge').value = user.age || '';
                document.getElementById('editUserCity').value = user.city || '';
                document.getElementById('editUserStatus').value = user.status || 'Active';
                document.getElementById('editUserPlan').value = user.plan || 'Free';
                clearErrors('editUserErrors');

                const editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                editModal.show();
            };

            // Update User Form Submit
            document.getElementById('editUserForm').addEventListener('submit', async function (e) {
                e.preventDefault();

                const updateBtn = document.getElementById('updateUserBtn');
                const dbId = document.getElementById('editDbId').value;

                clearErrors('editUserErrors');
                updateBtn.disabled = true;
                updateBtn.innerText = 'Updating...';

                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(updateUrlTemplate.replace('__USER_ID__', encodeURIComponent(dbId)), {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const result = await responseJson(response);

                    if (response.ok && result.success) {
                        const idx = membersData.findIndex(u => u.db_id == dbId);

                        if (idx !== -1) {
                            membersData[idx].name = result.data.name;
                            membersData[idx].email = result.data.email;
                            membersData[idx].gender = result.data.gender;
                            membersData[idx].age = result.data.age;
                            membersData[idx].city = result.data.city;
                            membersData[idx].status = result.data.status;
                            membersData[idx].plan = result.data.plan;
                        }

                        filterList();
                        updateCounts(result.counts);

                        const editModalEl = document.getElementById('editUserModal');
                        const modal = bootstrap.Modal.getInstance(editModalEl);

                        if (modal) {
                            modal.hide();
                        }
                    } else {
                        showErrors('editUserErrors', result, response.status);
                    }

                } catch (error) {
                    console.error('Update error:', error);
                    showErrors('editUserErrors', { message: 'Unable to update the member. Check your connection and try again.' }, 0);
                } finally {
                    updateBtn.disabled = false;
                    updateBtn.innerText = 'Update Member';
                }
            });

            // Delete User
            window.deleteUser = async function (dbId) {
                if (!confirm('Are you sure you want to delete this user?')) return;

                try {
                    const response = await fetch(deleteUrlTemplate.replace('__USER_ID__', encodeURIComponent(dbId)), {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const result = await responseJson(response);

                    if (response.ok && result.success) {
                        membersData = membersData.filter(u => u.db_id != dbId);
                        filterList();
                        updateCounts(result.counts);
                    } else {
                        alert(result.message || 'Failed to delete user.');
                    }

                } catch (error) {
                    console.error('Delete error:', error);
                    alert('Error deleting user.');
                }
            };

            tbody.addEventListener('click', function (event) {
                const action = event.target.closest('[data-member-id]');
                if (!action) return;

                const dbId = Number(action.dataset.memberId);
                if (!Number.isInteger(dbId) || dbId < 1) return;

                if (action.classList.contains('js-edit-member')) {
                    window.openEditModal(dbId);
                } else if (action.classList.contains('js-delete-member')) {
                    window.deleteUser(dbId);
                }
            });

        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeManagementPage);
        } else {
            initializeManagementPage();
        }
    </script>
@endsection