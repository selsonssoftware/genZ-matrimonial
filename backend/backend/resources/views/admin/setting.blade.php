@extends('layout')

@section('content')
    @php
        $sections = [
            'admin-users-roles' => 'Admin Users & Roles',
            'permissions' => 'Permissions',
            'security-login' => 'Security & Login',
            'notifications' => 'Notifications',
            'audit-log' => 'Audit Log',
            'privacy-retention' => 'Privacy & Retention',
        ];
        $activeSection = request('section', 'admin-users-roles');
        if (!array_key_exists($activeSection, $sections)) {
            $activeSection = 'admin-users-roles';
        }
        $selectedRole = request('role', array_key_first($roles));
        if (!array_key_exists($selectedRole, $roles)) {
            $selectedRole = array_key_first($roles);
        }
    @endphp

    <style>
        .settings-shell { background: #f7f8fb; min-height: 100vh; padding: 26px; color: #30323a; }
        .settings-title { color: #561325; font-weight: 750; }
        .settings-subtitle { color: #85838b; font-size: 13px; }
        .settings-card { border: 1px solid #ececf1; border-radius: 12px; box-shadow: 0 3px 14px rgba(28, 20, 30, .04); }
        .settings-nav { border: 1px solid #ececf1; border-radius: 11px; padding: 10px; background: #fff; }
        .settings-nav .nav-link { color: #777680; font-size: 13px; padding: 11px 13px; border-radius: 7px; margin-bottom: 3px; }
        .settings-nav .nav-link.active { background: #f7eaf0; color: #561325; font-weight: 650; }
        .settings-section-heading { font-size: 15px; color: #561325; font-weight: 700; }
        .settings-table thead th { background: #faf9fb; color: #777680; font-size: 11px; text-transform: uppercase; letter-spacing: .04em; white-space: nowrap; }
        .settings-table td { vertical-align: middle; font-size: 13px; }
        .settings-save { background: #561325; border-color: #561325; color: #fff; }
        .settings-save:hover { background: #42101d; border-color: #42101d; color: #fff; }
        .settings-icon { width: 31px; height: 31px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; background: #f7eaf0; color: #561325; margin-right: 8px; }
        .settings-inline-label { font-size: 13px; font-weight: 600; }
        .settings-page .form-label { font-size: 12px; color: #65636e; font-weight: 600; }
        .settings-page .form-select, .settings-page .form-control { font-size: 13px; }
        .settings-page .form-check-input:checked { background-color: #561325; border-color: #561325; }
        .settings-page .pagination { margin-bottom: 0; }
        @media (max-width: 767px) { .settings-shell { padding: 15px; } }
    </style>
        :root {
            --th-primary: #7b1128;
            --th-primary-hover: #630c1f;
            --th-light-bg: #fff5f6;
            --th-soft-pink: #fdebed;
        }

        .btn-thirumana {
            background-color: var(--th-primary);
            border-color: var(--th-primary);
            color: #fff;
        }

        .btn-thirumana:hover {
            background-color: var(--th-primary-hover);
            border-color: var(--th-primary-hover);
            color: #fff;
        }

        .settings-nav .nav-link {
            color: #555;
            font-weight: 500;
            border-radius: 8px;
            padding: 10px 16px;
            margin-bottom: 6px;
            transition: all 0.2s ease-in-out;
        }

        .settings-nav .nav-link:hover {
            background-color: var(--th-light-bg);
            color: var(--th-primary);
        }

        .settings-nav .nav-link.active {
            background-color: var(--th-soft-pink) !important;
            color: var(--th-primary) !important;
            font-weight: 600;
        }

        .form-check-input:checked {
            background-color: var(--th-primary);
            border-color: var(--th-primary);
        }

        .badge-super-admin {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .badge-admin {
            background-color: #e0e7ff;
            color: #4f46e5;
        }

        .badge-manager {
            background-color: #fef3c7;
            color: #d97706;
        }

        .badge-active {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .badge-inactive {
            background-color: #fee2e2;
            color: #ef4444;
        }
    </style>

    <div class="content-page">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-title-head d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h4 class="page-main-title m-0 fw-bold">Settings</h4>
                    <p class="text-muted fs-13 m-0" id="section-subheading">Manage admin users, roles, and security
                        policies.</p>
                </div>
            </div>

            <div class="row">
                <!-- Left Side Settings Tabs -->
                <div class="col-md-3 col-xl-2 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-2">
                            <ul class="nav flex-column settings-nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#tabAdminUsers" role="tab">Admin
                                        Users & Roles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabPermissions"
                                        role="tab">Permissions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabSecurityLogin" role="tab">Security &
                                        Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabNotifications"
                                        role="tab">Notifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabAuditLog" role="tab">Audit Log</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#tabPrivacyRetention" role="tab">Privacy
                                        & Retention</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right Side Settings Content -->
                <div class="col-md-9 col-xl-10">
                    <div class="tab-content">

                        <!-- TAB 1: USERS & ROLES -->
                        <div class="tab-pane fade show active" id="tabAdminUsers" role="tabpanel">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                        <div>
                                            <h5 class="fw-bold mb-0">Vendors & Users</h5>
                                            <small class="text-muted">Registered vendors and members list</small>
                                        </div>
                                    </div>

                                    <!-- Filters -->
                                    <form method="GET" action="{{ route('admin.settings.index') }}" class="row g-2 mb-3">
                                        <input type="hidden" name="active_tab" value="#tabAdminUsers">
                                        <div class="col-md-6">
                                            <input type="text" name="search" class="form-control form-control-sm"
                                                placeholder="Search by name or email..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="role" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                                <option value="All Roles" {{ request('role') == 'All Roles' ? 'selected' : '' }}>All Accounts</option>
                                                <option value="Vendor" {{ request('role') == 'Vendor' ? 'selected' : '' }}>
                                                    Vendors Only</option>
                                                <option value="User" {{ request('role') == 'User' ? 'selected' : '' }}>Users
                                                    Only</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                                <option value="All Status" {{ request('status') == 'All Status' ? 'selected' : '' }}>All Status</option>
                                                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Suspended" {{ request('status') == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                            </select>
                                        </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle fs-13 mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Name / Agent</th>
                                                    <th>Email Address</th>
                                                    <th>Role / Type</th>
                                                    <th>Status</th>
                                                    <th class="text-end">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($adminUsers as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="fw-semibold">
                                                            {{ $user->name ?? 'N/A' }}
                                                            @if($user->user_type == 'vendor')
                                                                <i class="ti ti-building-store text-warning ms-1"
                                                                    title="Vendor"></i>
                                                            @else
                                                                <i class="ti ti-user text-primary ms-1" title="Member User"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-muted">{{ $user->email ?? 'N/A' }}</td>
                                                        <td>
                                                            @if($user->role == 'Vendor')
                                                                <span
                                                                    class="badge bg-warning-subtle text-warning px-2 py-1 border border-warning">Vendor</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-primary-subtle text-primary px-2 py-1 border border-primary">User</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php $userStatus = $user->status ?? 'Active'; @endphp
                                                            <span
                                                                class="badge {{ strtolower($userStatus) == 'active' ? 'badge-active' : 'badge-inactive' }} px-2 py-1">
                                                                {{ ucfirst($userStatus) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            @if($user->user_type == 'vendor')
                                                                <a href="{{ route('admin.vendors.index') }}?search={{ urlencode($user->email ?? '') }}"
                                                                    class="btn btn-sm btn-light py-0 px-2 text-warning">
                                                                    <i class="ti ti-external-link me-1"></i>View Vendor
                                                                </a>
                                                            @else
                                                                <a href="{{ route('users.index') }}?search={{ urlencode($user->email ?? '') }}"
                                                                    class="btn btn-sm btn-light py-0 px-2 text-primary">
                                                                    <i class="ti ti-external-link me-1"></i>View User
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center py-4 text-muted">No vendors or users
                                                            found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Pagination -->
                                    <div class="mt-3">
                                        {{ $adminUsers->appends(request()->all())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: PERMISSIONS -->
                        <div class="tab-pane fade" id="tabPermissions" role="tabpanel">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <form action="{{ route('admin.settings.permissions.update') }}" method="POST">
                                        @csrf
                                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="form-label fw-semibold m-0 fs-13">Select Role</label>
                                                <select name="role" class="form-select form-select-sm"
                                                    style="width: 180px;">
                                                    <option {{ $selectedRole == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                    <option {{ $selectedRole == 'Super Admin' ? 'selected' : '' }}>Super Admin
                                                    </option>
                                                    <option {{ $selectedRole == 'Manager' ? 'selected' : '' }}>Manager
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-thirumana">Save Permissions</button>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table align-middle fs-13 mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Module</th>
                                                        <th class="text-center" style="width: 100px;">View</th>
                                                        <th class="text-center" style="width: 100px;">Create</th>
                                                        <th class="text-center" style="width: 100px;">Edit</th>
                                                        <th class="text-center" style="width: 100px;">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($modules as $mod)
                                                        @php $p = $savedPermissions[$mod] ?? []; @endphp
                                                        <tr>
                                                            <td class="fw-semibold"><i
                                                                    class="ti ti-check text-muted me-2"></i>{{ $mod }}</td>
                                                            <td class="text-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="perms[{{ $mod }}][view]" value="1" {{ !empty($p['view']) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="perms[{{ $mod }}][create]" value="1" {{ !empty($p['create']) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="perms[{{ $mod }}][edit]" value="1" {{ !empty($p['edit']) ? 'checked' : '' }}>
                                                            </td>
                                                            <td class="text-center">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="perms[{{ $mod }}][delete]" value="1" {{ !empty($p['delete']) ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: SECURITY & LOGIN -->
                        <div class="tab-pane fade" id="tabSecurityLogin" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="active_tab" value="#tabSecurityLogin">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Password Policy</h6>
                                                <div class="mb-3">
                                                    <label class="form-label fs-13">Minimum password length</label>
                                                    <select name="min_password_length" class="form-select form-select-sm">
                                                        <option value="8" {{ ($rawSettings['min_password_length'] ?? '8') == '8' ? 'selected' : '' }}>8</option>
                                                        <option value="10" {{ ($rawSettings['min_password_length'] ?? '') == '10' ? 'selected' : '' }}>10</option>
                                                        <option value="12" {{ ($rawSettings['min_password_length'] ?? '') == '12' ? 'selected' : '' }}>12</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fs-13">Require uppercase letter</label>
                                                    <select name="req_uppercase" class="form-select form-select-sm">
                                                        <option value="Yes" {{ ($rawSettings['req_uppercase'] ?? 'Yes') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ ($rawSettings['req_uppercase'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fs-13">Require lowercase letter</label>
                                                    <select name="req_lowercase" class="form-select form-select-sm">
                                                        <option value="Yes" {{ ($rawSettings['req_lowercase'] ?? 'Yes') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ ($rawSettings['req_lowercase'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fs-13">Require number</label>
                                                    <select name="req_number" class="form-select form-select-sm">
                                                        <option value="Yes" {{ ($rawSettings['req_number'] ?? 'Yes') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ ($rawSettings['req_number'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="form-label fs-13">Require special character</label>
                                                    <select name="req_special" class="form-select form-select-sm">
                                                        <option value="Yes" {{ ($rawSettings['req_special'] ?? 'Yes') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                        <option value="No" {{ ($rawSettings['req_special'] ?? '') == 'No' ? 'selected' : '' }}>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="fw-bold mb-0">Two-Factor Authentication (2FA)</h6>
                                                    <div class="form-check form-switch m-0">
                                                        <input class="form-check-input" type="checkbox" name="enable_2fa"
                                                            value="1" {{ !empty($rawSettings['enable_2fa']) ? 'checked' : '' }} />
                                                    </div>
                                                </div>
                                                <p class="text-muted fs-12 mb-2">Enable 2FA for all admins</p>
                                                <label class="form-label fs-13 fw-semibold">Allowed Methods</label>
                                                <div class="form-check mb-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="two_factor_auth_app" value="1" id="authApp" {{ !empty($rawSettings['two_factor_auth_app']) ? 'checked' : '' }}>
                                                    <label class="form-check-label fs-13" for="authApp">Authenticator
                                                        App</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="two_factor_sms_otp" value="1" id="smsOtp" {{ !empty($rawSettings['two_factor_sms_otp']) ? 'checked' : '' }}>
                                                    <label class="form-check-label fs-13" for="smsOtp">SMS OTP</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Login Attempt Limits</h6>
                                                <div class="mb-3">
                                                    <label class="form-label fs-13">Max failed attempts</label>
                                                    <select name="max_failed_attempts" class="form-select form-select-sm">
                                                        <option value="5" {{ ($rawSettings['max_failed_attempts'] ?? '5') == '5' ? 'selected' : '' }}>5</option>
                                                        <option value="3" {{ ($rawSettings['max_failed_attempts'] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                                        <option value="10" {{ ($rawSettings['max_failed_attempts'] ?? '') == '10' ? 'selected' : '' }}>10</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="form-label fs-13">Lockout duration (minutes)</label>
                                                    <select name="lockout_duration" class="form-select form-select-sm">
                                                        <option value="15" {{ ($rawSettings['lockout_duration'] ?? '15') == '15' ? 'selected' : '' }}>15</option>
                                                        <option value="30" {{ ($rawSettings['lockout_duration'] ?? '') == '30' ? 'selected' : '' }}>30</option>
                                                        <option value="60" {{ ($rawSettings['lockout_duration'] ?? '') == '60' ? 'selected' : '' }}>60</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <label class="form-label fs-13 mb-1">Inactivity timeout
                                                        (minutes)</label>
                                                    <select name="session_timeout" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="60" {{ ($rawSettings['session_timeout'] ?? '60') == '60' ? 'selected' : '' }}>60</option>
                                                        <option value="30" {{ ($rawSettings['session_timeout'] ?? '') == '30' ? 'selected' : '' }}>30</option>
                                                        <option value="120" {{ ($rawSettings['session_timeout'] ?? '') == '120' ? 'selected' : '' }}>120</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-thirumana">Save
                                                    Settings</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 4: NOTIFICATIONS -->
                        <div class="tab-pane fade" id="tabNotifications" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="active_tab" value="#tabNotifications">
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Notification Channels</h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="border rounded p-3 text-center">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="fs-13 fw-semibold"><i class="ti ti-mail me-1"></i>
                                                            Email</span>
                                                        <div class="form-check form-switch m-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="notify_email" value="1" {{ !empty($rawSettings['notify_email']) ? 'checked' : '' }} />
                                                        </div>
                                                    </div>
                                                    <p class="text-muted fs-12 mb-0">Configure email templates</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="border rounded p-3 text-center">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="fs-13 fw-semibold"><i
                                                                class="ti ti-device-mobile me-1"></i> SMS</span>
                                                        <div class="form-check form-switch m-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="notify_sms" value="1" {{ !empty($rawSettings['notify_sms']) ? 'checked' : '' }} />
                                                        </div>
                                                    </div>
                                                    <p class="text-muted fs-12 mb-0">Configure SMS templates</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="border rounded p-3 text-center">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="fs-13 fw-semibold"><i class="ti ti-bell me-1"></i>
                                                            Push</span>
                                                        <div class="form-check form-switch m-0">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="notify_push" value="1" {{ !empty($rawSettings['notify_push']) ? 'checked' : '' }} />
                                                        </div>
                                                    </div>
                                                    <p class="text-muted fs-12 mb-0">Configure push templates</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Event Notifications</h6>
                                        <div class="table-responsive">
                                            <table class="table align-middle fs-13 mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Event</th>
                                                        <th class="text-center" style="width: 120px;">Email</th>
                                                        <th class="text-center" style="width: 120px;">SMS</th>
                                                        <th class="text-center" style="width: 120px;">Push</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $notificationEvents = [
                                                            'event_user_reg' => 'New User Registration',
                                                            'event_profile_ver' => 'Profile Verification',
                                                            'event_payment' => 'Payment Received',
                                                            'event_expiry' => 'Membership Expiry',
                                                            'event_match' => 'New Match Found'
                                                        ];
                                                    @endphp
                                                    @foreach($notificationEvents as $key => $label)
                                                        <tr>
                                                            <td class="fw-semibold">{{ $label }}</td>
                                                            <td class="text-center">
                                                                <div class="form-check form-switch d-inline-block m-0">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="{{ $key }}_email" value="1" {{ !empty($rawSettings[$key . '_email']) ? 'checked' : '' }}>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="form-check form-switch d-inline-block m-0">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="{{ $key }}_sms" value="1" {{ !empty($rawSettings[$key . '_sms']) ? 'checked' : '' }}>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="form-check form-switch d-inline-block m-0">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="{{ $key }}_push" value="1" {{ !empty($rawSettings[$key . '_push']) ? 'checked' : '' }}>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-sm btn-thirumana">Save Settings</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 5: AUDIT LOG -->
                        <div class="tab-pane fade" id="tabAuditLog" role="tabpanel">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('admin.settings.index') }}"
                                        class="row g-2 mb-3 align-items-end">
                                        <input type="hidden" name="active_tab" value="#tabAuditLog">
                                        <div class="col-md-2">
                                            <label class="form-label fs-12 mb-0">From Date</label>
                                            <input type="date" name="from_date" class="form-control form-control-sm"
                                                value="{{ request('from_date') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label fs-12 mb-0">To Date</label>
                                            <input type="date" name="to_date" class="form-control form-control-sm"
                                                value="{{ request('to_date') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fs-12 mb-0">User</label>
                                            <select name="log_user" class="form-select form-select-sm">
                                                <option>All Users</option>
                                                @foreach($adminUsers as $adm)
                                                    <option value="{{ $adm->name }}" {{ request('log_user') == $adm->name ? 'selected' : '' }}>{{ $adm->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fs-12 mb-0">Action</label>
                                            <select name="log_action" class="form-select form-select-sm">
                                                <option>All Actions</option>
                                                <option {{ request('log_action') == 'Logged in' ? 'selected' : '' }}>Logged in
                                                </option>
                                                <option {{ request('log_action') == 'Added user' ? 'selected' : '' }}>Added
                                                    user</option>
                                                <option {{ request('log_action') == 'Updated profile' ? 'selected' : '' }}>
                                                    Updated profile</option>
                                                <option {{ request('log_action') == 'Deleted vendor' ? 'selected' : '' }}>
                                                    Deleted vendor</option>
                                                <option {{ request('log_action') == 'Changed settings' ? 'selected' : '' }}>
                                                    Changed settings</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-sm btn-thirumana w-100">Search</button>
                                        </div>
                                    </form>

                                    <h6 class="fw-bold mb-3">Activity Logs</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle fs-13 mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Admin User</th>
                                                    <th>Action</th>
                                                    <th>Module</th>
                                                    <th>IP Address</th>
                                                    <th>Date & Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($auditLogs as $log)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="fw-semibold">{{ $log->admin_user }}</td>
                                                        <td>{{ $log->action }}</td>
                                                        <td>{{ $log->module }}</td>
                                                        <td class="text-muted">{{ $log->ip_address }}</td>
                                                        <td class="text-muted">
                                                            {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y h:i A') }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center py-3 text-muted">No activity logs
                                                            recorded.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        {{ $auditLogs->appends(request()->all())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 6: PRIVACY & RETENTION -->
                        <div class="tab-pane fade" id="tabPrivacyRetention" role="tabpanel">
                            <form action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="active_tab" value="#tabPrivacyRetention">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Data Retention Period</h6>
                                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                                    <label class="form-label fs-13 mb-0">User Data</label>
                                                    <select name="retention_user_data" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="2 Years" {{ ($rawSettings['retention_user_data'] ?? '2 Years') == '2 Years' ? 'selected' : '' }}>2 Years</option>
                                                        <option value="1 Year" {{ ($rawSettings['retention_user_data'] ?? '') == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                                        <option value="5 Years" {{ ($rawSettings['retention_user_data'] ?? '') == '5 Years' ? 'selected' : '' }}>5 Years</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                                    <label class="form-label fs-13 mb-0">Messages & Chats</label>
                                                    <select name="retention_chats" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="1 Year" {{ ($rawSettings['retention_chats'] ?? '1 Year') == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                                        <option value="6 Months" {{ ($rawSettings['retention_chats'] ?? '') == '6 Months' ? 'selected' : '' }}>6 Months</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                                    <label class="form-label fs-13 mb-0">Logs & Audit Data</label>
                                                    <select name="retention_logs" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="1 Year" {{ ($rawSettings['retention_logs'] ?? '1 Year') == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                                        <option value="90 Days" {{ ($rawSettings['retention_logs'] ?? '') == '90 Days' ? 'selected' : '' }}>90 Days</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label fs-13 mb-0">Deleted Records</label>
                                                    <select name="retention_deleted" class="form-select form-select-sm"
                                                        style="width: 140px;">
                                                        <option value="6 Months" {{ ($rawSettings['retention_deleted'] ?? '6 Months') == '6 Months' ? 'selected' : '' }}>6 Months</option>
                                                        <option value="30 Days" {{ ($rawSettings['retention_deleted'] ?? '') == '30 Days' ? 'selected' : '' }}>30 Days</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h6 class="fw-bold mb-0">Data Export</h6>
                                                    <div class="form-check form-switch m-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="data_export_enabled" value="1" {{ !empty($rawSettings['data_export_enabled']) ? 'checked' : '' }} />
                                                    </div>
                                                </div>
                                                <p class="text-muted fs-12 mb-3">Allow users to request data export</p>
                                                <label class="form-label fs-13 fw-semibold">Export Format</label>
                                                <div class="d-flex gap-3 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="export_fmt_csv" value="1" id="fmtCsv" {{ !empty($rawSettings['export_fmt_csv']) ? 'checked' : '' }}>
                                                        <label class="form-check-label fs-13" for="fmtCsv">CSV</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="export_fmt_pdf" value="1" id="fmtPdf" {{ !empty($rawSettings['export_fmt_pdf']) ? 'checked' : '' }}>
                                                        <label class="form-check-label fs-13" for="fmtPdf">PDF</label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="form-label fs-13">Validity period (days)</label>
                                                    <input type="number" name="export_validity_days"
                                                        class="form-control form-control-sm"
                                                        value="{{ $rawSettings['export_validity_days'] ?? 7 }}"
                                                        style="max-width: 120px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Account Deletion / Deactivation</h6>
                                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                                    <label class="form-label fs-13 mb-0">Auto delete inactive accounts
                                                        after</label>
                                                    <select name="auto_delete_inactive" class="form-select form-select-sm"
                                                        style="width: 130px;">
                                                        <option value="180 Days" {{ ($rawSettings['auto_delete_inactive'] ?? '180 Days') == '180 Days' ? 'selected' : '' }}>180 Days</option>
                                                        <option value="90 Days" {{ ($rawSettings['auto_delete_inactive'] ?? '') == '90 Days' ? 'selected' : '' }}>90 Days</option>
                                                    </select>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fs-13">Allow user self-deletion</span>
                                                    <div class="form-check form-switch m-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="allow_user_self_delete" value="1" {{ !empty($rawSettings['allow_user_self_delete']) ? 'checked' : '' }} />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Privacy Consent</h6>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="fs-13">Enable privacy consent for new users</span>
                                                    <div class="form-check form-switch m-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="enable_privacy_consent" value="1" {{ !empty($rawSettings['enable_privacy_consent']) ? 'checked' : '' }} />
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="fs-13">Show privacy policy link</span>
                                                    <div class="form-check form-switch m-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="show_privacy_policy" value="1" {{ !empty($rawSettings['show_privacy_policy']) ? 'checked' : '' }} />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-sm btn-thirumana">Save Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add Admin User -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('admin.settings.users.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Admin User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select form-select-sm">
                            <option>Super Admin</option>
                            <option selected>Admin</option>
                            <option>Manager</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-thirumana">Create User</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tab memory on refresh or update
        document.addEventListener("DOMContentLoaded", function () {
            const activeTab = "{{ session('active_tab') ?? request('active_tab') }}";
            if (activeTab) {
                const tabBtn = document.querySelector(`.settings-nav a[href="${activeTab}"]`);
                if (tabBtn) {
                    new bootstrap.Tab(tabBtn).show();
                }
            }
        });
    </script>

    <div class="content-page settings-page">
        <div class="settings-shell">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="settings-title mb-1">Settings</h3>
                    <p class="settings-subtitle mb-0">Manage administrators, access, security, notifications and privacy.</p>
                </div>
                <div class="d-flex align-items-center gap-2 text-muted small">
                    <i class="ti ti-shield-check text-success"></i> Settings saved to database
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="status">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <div class="fw-semibold mb-1">Please review the settings form:</div>
                    <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="row g-4">
                <aside class="col-xl-2 col-lg-3">
                    <nav class="nav flex-column settings-nav" role="tablist" aria-label="Settings sections">
                        @foreach($sections as $key => $label)
                            <a class="nav-link {{ $activeSection === $key ? 'active' : '' }}"
                                href="#settings-{{ $key }}" data-bs-toggle="tab" role="tab"
                                aria-selected="{{ $activeSection === $key ? 'true' : 'false' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>
                </aside>

                <main class="col-xl-10 col-lg-9">
                    <div class="tab-content">
                        <section class="tab-pane fade {{ $activeSection === 'admin-users-roles' ? 'show active' : '' }}" id="settings-admin-users-roles">
                            <div class="card settings-card">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                                        <div>
                                            <h5 class="settings-section-heading mb-1">Admin Users</h5>
                                            <div class="settings-subtitle">Manage administrator accounts and assigned roles.</div>
                                        </div>
                                        <button class="btn btn-sm settings-save" type="button" data-bs-toggle="modal" data-bs-target="#createAdminModal">
                                            <i class="ti ti-plus me-1"></i> Add Admin User
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table settings-table align-middle js-data-table" data-empty-table="No admin accounts found.">
                                            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th class="text-end">Actions</th></tr></thead>
                                            <tbody>
                                                @forelse($admins as $admin)
                                                    <tr>
                                                        <td class="fw-semibold">{{ $admin->name }}</td>
                                                        <td>{{ $admin->email }}</td>
                                                        <td><span class="badge bg-light text-dark border">{{ $roles[strtolower($admin->role ?? '')] ?? ucfirst($admin->role ?? 'Admin') }}</span></td>
                                                        <td class="text-end text-nowrap">
                                                            <button type="button" class="btn btn-sm btn-light border js-edit-admin"
                                                                data-id="{{ $admin->id }}" data-name="{{ $admin->name }}"
                                                                data-email="{{ $admin->email }}" data-role="{{ strtolower($admin->role ?? 'admin') }}">
                                                                <i class="ti ti-edit"></i>
                                                            </button>
                                                            <form class="d-inline" method="POST" action="{{ route('admin.setting.admins.destroy', $admin->id) }}"
                                                                onsubmit="return confirm('Delete this admin account?');">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light border text-danger"><i class="ti ti-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr><td colspan="4" class="text-center text-muted py-4">No admin accounts found.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane fade {{ $activeSection === 'permissions' ? 'show active' : '' }}" id="settings-permissions">
                            <div class="card settings-card">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                                        <div>
                                            <h5 class="settings-section-heading mb-1">Permissions</h5>
                                            <div class="settings-subtitle">Choose which modules and actions are available to each role.</div>
                                        </div>
                                        <form method="GET" action="{{ route('admin.setting') }}" class="d-flex align-items-center gap-2">
                                            <input type="hidden" name="section" value="permissions">
                                            <label class="form-label mb-0" for="permissionRole">Select Role</label>
                                            <select class="form-select form-select-sm" id="permissionRole" name="role" onchange="this.form.submit()">
                                                @foreach($roles as $roleKey => $roleLabel)
                                                    <option value="{{ $roleKey }}" @selected($selectedRole === $roleKey)>{{ $roleLabel }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                    <form method="POST" action="{{ route('admin.setting.update', ['section' => 'permissions', 'role' => $selectedRole]) }}">
                                        @csrf
                                        <input type="hidden" name="section" value="permissions">
                                        <input type="hidden" name="role" value="{{ $selectedRole }}">
                                        <div class="table-responsive">
                                            <table class="table table-bordered settings-table align-middle">
                                                <thead><tr><th>Module</th>@foreach($permissionActions as $actionLabel)<th class="text-center">{{ $actionLabel }}</th>@endforeach</tr></thead>
                                                <tbody>
                                                    @foreach($modules as $moduleKey => $moduleLabel)
                                                        <tr>
                                                            <td><span class="settings-icon"><i class="ti ti-layout-grid"></i></span>{{ $moduleLabel }}</td>
                                                            @foreach($permissionActions as $actionKey => $actionLabel)
                                                                @php $permissionName = "settings[role_permissions][{$selectedRole}][{$moduleKey}][{$actionKey}]"; @endphp
                                                                <td class="text-center">
                                                                    <input type="hidden" name="{{ $permissionName }}" value="0">
                                                                    <input class="form-check-input" type="checkbox" name="{{ $permissionName }}" value="1"
                                                                        aria-label="{{ $actionLabel }} {{ $moduleLabel }}"
                                                                        @checked($settings['role_permissions'][$selectedRole][$moduleKey][$actionKey] ?? false)>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-end mt-3">
                                            <button class="btn settings-save btn-sm px-4" type="submit">Save Permissions</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane fade {{ $activeSection === 'security-login' ? 'show active' : '' }}" id="settings-security-login">
                            <form method="POST" action="{{ route('admin.setting.update', ['section' => 'security-login']) }}">
                                @csrf
                                <input type="hidden" name="section" value="security-login">
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="card settings-card h-100"><div class="card-body p-4">
                                            <h5 class="settings-section-heading mb-3">Password Policy</h5>
                                            <label class="form-label" for="minimumPasswordLength">Minimum password length</label>
                                            <select id="minimumPasswordLength" name="settings[minimum_password_length]" class="form-select mb-3">
                                                @foreach([8, 10, 12, 14, 16] as $length)<option value="{{ $length }}" @selected((int) old('settings.minimum_password_length', $settings['minimum_password_length']) === $length)>{{ $length }} characters</option>@endforeach
                                            </select>
                                            @foreach(['require_uppercase' => 'Require uppercase letter', 'require_lowercase' => 'Require lowercase letter', 'require_number' => 'Require number', 'require_special_character' => 'Require special character'] as $key => $label)
                                                <div class="form-check form-switch mb-2">
                                                    <input type="hidden" name="settings[{{ $key }}]" value="0">
                                                    <input class="form-check-input" type="checkbox" id="{{ $key }}" name="settings[{{ $key }}]" value="1" @checked(old('settings.'.$key, $settings[$key]))>
                                                    <label class="form-check-label settings-inline-label" for="{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                        </div></div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card settings-card mb-3"><div class="card-body p-4">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div><h5 class="settings-section-heading mb-1">Two-Factor Authentication (2FA)</h5><div class="settings-subtitle">Configure available admin verification methods.</div></div>
                                                <div class="form-check form-switch"><input type="hidden" name="settings[two_factor_enabled]" value="0"><input class="form-check-input" id="twoFactorEnabled" type="checkbox" name="settings[two_factor_enabled]" value="1" @checked(old('settings.two_factor_enabled', $settings['two_factor_enabled']))></div>
                                            </div>
                                            @foreach(['two_factor_authenticator' => 'Authenticator App', 'two_factor_sms' => 'SMS OTP'] as $key => $label)
                                                <div class="form-check mb-2">
                                                    <input type="hidden" name="settings[{{ $key }}]" value="0">
                                                    <input class="form-check-input" type="checkbox" id="{{ $key }}" name="settings[{{ $key }}]" value="1" @checked(old('settings.'.$key, $settings[$key]))>
                                                    <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                        </div></div>
                                        <div class="card settings-card"><div class="card-body p-4">
                                            <h5 class="settings-section-heading mb-3">Login Attempt Limits</h5>
                                            <div class="row g-3">
                                                <div class="col-6"><label class="form-label">Maximum failed attempts</label><select name="settings[max_login_attempts]" class="form-select">@foreach([3,5,7,10] as $value)<option value="{{ $value }}" @selected((int) old('settings.max_login_attempts', $settings['max_login_attempts']) === $value)>{{ $value }}</option>@endforeach</select></div>
                                                <div class="col-6"><label class="form-label">Lockout duration (minutes)</label><select name="settings[lockout_duration_minutes]" class="form-select">@foreach([5,10,15,30,60] as $value)<option value="{{ $value }}" @selected((int) old('settings.lockout_duration_minutes', $settings['lockout_duration_minutes']) === $value)>{{ $value }}</option>@endforeach</select></div>
                                                <div class="col-12"><label class="form-label">Session timeout (minutes)</label><select name="settings[session_timeout_minutes]" class="form-select">@foreach([15,30,60,120,240] as $value)<option value="{{ $value }}" @selected((int) old('settings.session_timeout_minutes', $settings['session_timeout_minutes']) === $value)>{{ $value }}</option>@endforeach</select></div>
                                            </div>
                                        </div></div>
                                    </div>
                                </div>
                                <div class="text-end mt-3"><button type="submit" class="btn settings-save btn-sm px-4">Save Settings</button></div>
                            </form>
                        </section>

                        <section class="tab-pane fade {{ $activeSection === 'notifications' ? 'show active' : '' }}" id="settings-notifications">
                            <form method="POST" action="{{ route('admin.setting.update', ['section' => 'notifications']) }}">
                                @csrf
                                <input type="hidden" name="section" value="notifications">
                                <div class="card settings-card mb-3">
                                    <div class="card-body p-4">
                                        <h5 class="settings-section-heading mb-3">Notification Channels</h5>
                                        <div class="row g-3">
                                            @foreach(['email' => 'Email Notifications', 'sms' => 'SMS Notifications', 'push' => 'Push Notifications'] as $channel => $label)
                                                <div class="col-md-4"><div class="border rounded p-3 d-flex align-items-center justify-content-between">
                                                    <span><i class="ti ti-{{ $channel === 'email' ? 'mail' : ($channel === 'sms' ? 'device-mobile' : 'bell') }} me-2 text-danger"></i>{{ $label }}</span>
                                                    <span class="form-check form-switch mb-0"><input type="hidden" name="settings[notification_channels][{{ $channel }}]" value="0"><input class="form-check-input" type="checkbox" name="settings[notification_channels][{{ $channel }}]" value="1" @checked(old('settings.notification_channels.'.$channel, $settings['notification_channels'][$channel] ?? false))></span>
                                                </div></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card settings-card">
                                    <div class="card-body p-4">
                                        <h5 class="settings-section-heading mb-3">Event Notifications</h5>
                                        <div class="table-responsive">
                                            <table class="table settings-table align-middle mb-0">
                                                <thead><tr><th>Event</th><th class="text-center">Email</th><th class="text-center">SMS</th><th class="text-center">Push</th></tr></thead>
                                                <tbody>
                                                    @foreach($notificationEvents as $event => $label)
                                                        <tr><td>{{ $label }}</td>
                                                            @foreach(['email', 'sms', 'push'] as $channel)
                                                                @php $eventValue = $settings['notification_events'][$event][$channel] ?? ($channel === 'email'); @endphp
                                                                <td class="text-center">
                                                                    <input type="hidden" name="settings[notification_events][{{ $event }}][{{ $channel }}]" value="0">
                                                                    <input class="form-check-input" type="checkbox" name="settings[notification_events][{{ $event }}][{{ $channel }}]" value="1" aria-label="{{ $label }} via {{ $channel }}" @checked(old('settings.notification_events.'.$event.'.'.$channel, $eventValue))>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-end mt-3"><button class="btn settings-save btn-sm px-4" type="submit">Save Settings</button></div>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <section class="tab-pane fade {{ $activeSection === 'audit-log' ? 'show active' : '' }}" id="settings-audit-log">
                            <div class="card settings-card">
                                <div class="card-body p-4">
                                    <div class="mb-3"><h5 class="settings-section-heading mb-1">Audit Log</h5><div class="settings-subtitle">Review recorded admin account and settings changes.</div></div>
                                    <form method="GET" action="{{ route('admin.setting') }}" class="row g-2 align-items-end mb-4">
                                        <input type="hidden" name="section" value="audit-log">
                                        <div class="col-md-2"><label class="form-label">From Date</label><input class="form-control" type="date" name="from" value="{{ $auditFilters['from'] ?? '' }}"></div>
                                        <div class="col-md-2"><label class="form-label">To Date</label><input class="form-control" type="date" name="to" value="{{ $auditFilters['to'] ?? '' }}"></div>
                                        <div class="col-md-3"><label class="form-label">Admin email</label><input class="form-control" type="search" name="admin" placeholder="Search admin" value="{{ $auditFilters['admin'] ?? '' }}"></div>
                                        <div class="col-md-3"><label class="form-label">Action</label><select class="form-select" name="action"><option value="">All actions</option>@foreach(['settings_updated' => 'Changed settings', 'admin_created' => 'Added admin', 'admin_updated' => 'Updated admin', 'admin_deleted' => 'Deleted admin'] as $action => $label)<option value="{{ $action }}" @selected(($auditFilters['action'] ?? '') === $action)>{{ $label }}</option>@endforeach</select></div>
                                        <div class="col-md-2 d-grid"><button class="btn settings-save btn-sm" type="submit">Search</button></div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table settings-table align-middle js-data-table" data-empty-table="No audit activity found.">
                                            <thead><tr><th>Admin User</th><th>Action</th><th>Module</th><th>IP Address</th><th>Date & Time</th></tr></thead>
                                            <tbody>
                                                @forelse($auditLogs as $log)
                                                    <tr><td><span class="fw-semibold">{{ $log->admin_name }}</span><small class="d-block text-muted">{{ $log->admin_email }}</small></td>
                                                        <td>{{ str($log->action)->replace('_', ' ')->title() }}<small class="d-block text-muted">{{ $log->description }}</small></td>
                                                        <td>{{ str($log->module)->replace('_', ' ')->title() }}</td><td>{{ $log->ip_address ?: '—' }}</td><td>{{ \Illuminate\Support\Carbon::parse($log->created_at)->format('d M Y, h:i A') }}</td></tr>
                                                @empty
                                                    <tr><td colspan="5" class="text-center text-muted py-4">No activity recorded for these filters.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($auditLogs instanceof \Illuminate\Contracts\Pagination\Paginator)
                                        <div class="mt-3">{{ $auditLogs->links() }}</div>
                                    @endif
                                </div>
                            </div>
                        </section>

                        <section class="tab-pane fade {{ $activeSection === 'privacy-retention' ? 'show active' : '' }}" id="settings-privacy-retention">
                            <form method="POST" action="{{ route('admin.setting.update', ['section' => 'privacy-retention']) }}">
                                @csrf
                                <input type="hidden" name="section" value="privacy-retention">
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="card settings-card h-100"><div class="card-body p-4">
                                            <h5 class="settings-section-heading mb-3">Data Retention Period</h5>
                                            <div class="mb-3"><label class="form-label">User Data</label><select name="settings[user_data_retention_years]" class="form-select">@foreach([1,2,3,5,10] as $value)<option value="{{ $value }}" @selected((int) old('settings.user_data_retention_years', $settings['user_data_retention_years']) === $value)>{{ $value }} {{ $value === 1 ? 'Year' : 'Years' }}</option>@endforeach</select></div>
                                            <div class="mb-3"><label class="form-label">Messages & Chats</label><select name="settings[message_data_retention_years]" class="form-select">@foreach([1,2,3,5,10] as $value)<option value="{{ $value }}" @selected((int) old('settings.message_data_retention_years', $settings['message_data_retention_years']) === $value)>{{ $value }} {{ $value === 1 ? 'Year' : 'Years' }}</option>@endforeach</select></div>
                                            <div class="mb-3"><label class="form-label">Logs & Audit Data</label><select name="settings[audit_log_retention_years]" class="form-select">@foreach([1,2,3,5,10] as $value)<option value="{{ $value }}" @selected((int) old('settings.audit_log_retention_years', $settings['audit_log_retention_years']) === $value)>{{ $value }} {{ $value === 1 ? 'Year' : 'Years' }}</option>@endforeach</select></div>
                                            <div><label class="form-label">Deleted Records</label><select name="settings[deleted_record_retention_months]" class="form-select">@foreach([3,6,12,24,36] as $value)<option value="{{ $value }}" @selected((int) old('settings.deleted_record_retention_months', $settings['deleted_record_retention_months']) === $value)>{{ $value }} Months</option>@endforeach</select></div>
                                        </div></div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card settings-card mb-3"><div class="card-body p-4">
                                            <h5 class="settings-section-heading mb-3">Data Export</h5>
                                            @foreach(['data_export_enabled' => 'Allow users to request data export', 'data_export_csv' => 'CSV format', 'data_export_pdf' => 'PDF format'] as $key => $label)
                                                <div class="form-check {{ $key === 'data_export_enabled' ? 'form-switch' : '' }} mb-2">
                                                    <input type="hidden" name="settings[{{ $key }}]" value="0">
                                                    <input class="form-check-input" type="checkbox" id="{{ $key }}" name="settings[{{ $key }}]" value="1" @checked(old('settings.'.$key, $settings[$key]))>
                                                    <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                        </div></div>
                                        <div class="card settings-card"><div class="card-body p-4">
                                            <h5 class="settings-section-heading mb-3">Privacy Controls</h5>
                                            <div class="mb-3"><label class="form-label">Inactive account review after</label><select name="settings[inactive_account_days]" class="form-select">@foreach([90,180,365,730] as $value)<option value="{{ $value }}" @selected((int) old('settings.inactive_account_days', $settings['inactive_account_days']) === $value)>{{ $value }} Days</option>@endforeach</select></div>
                                            @foreach(['user_deletion_enabled' => 'Allow user self-deletion', 'privacy_consent_required' => 'Require privacy consent', 'privacy_policy_visible' => 'Show privacy policy link'] as $key => $label)
                                                <div class="form-check form-switch mb-2">
                                                    <input type="hidden" name="settings[{{ $key }}]" value="0">
                                                    <input class="form-check-input" type="checkbox" id="{{ $key }}" name="settings[{{ $key }}]" value="1" @checked(old('settings.'.$key, $settings[$key]))>
                                                    <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                                </div>
                                            @endforeach
                                        </div></div>
                                    </div>
                                </div>
                                <div class="text-end mt-3"><button type="submit" class="btn settings-save btn-sm px-4">Save Settings</button></div>
                            </form>
                            <div class="d-flex gap-2 mt-3">
                                <form method="POST" action="{{ route('admin.setting.backup') }}">@csrf<button type="submit" class="btn btn-outline-secondary btn-sm"><i class="ti ti-download me-1"></i>Export Settings</button></form>
                                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#restoreSettingsModal"><i class="ti ti-upload me-1"></i>Restore Settings</button>
                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <form method="POST" action="{{ route('admin.setting.admins.store') }}">
                @csrf
                <div class="modal-header"><h5 class="modal-title" id="createAdminModalLabel">Add Admin User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <label class="form-label">Full name</label><input class="form-control mb-3" name="name" maxlength="255" required>
                    <label class="form-label">Email</label><input class="form-control mb-3" type="email" name="email" maxlength="191" required>
                    <label class="form-label">Role</label><select class="form-select mb-3" name="role" required>@foreach($roles as $roleKey => $roleLabel)<option value="{{ $roleKey }}">{{ $roleLabel }}</option>@endforeach</select>
                    <label class="form-label">Password</label><input class="form-control mb-3" type="password" name="password" minlength="{{ $settings['minimum_password_length'] }}" autocomplete="new-password" required>
                    <label class="form-label">Confirm password</label><input class="form-control" type="password" name="password_confirmation" minlength="{{ $settings['minimum_password_length'] }}" autocomplete="new-password" required>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn settings-save" type="submit">Create Admin</button></div>
            </form>
        </div></div>
    </div>

    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <form id="editAdminForm" method="POST" action="">
                @csrf @method('PUT')
                <div class="modal-header"><h5 class="modal-title" id="editAdminModalLabel">Edit Admin User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <label class="form-label">Full name</label><input class="form-control mb-3" name="name" id="editAdminName" maxlength="255" required>
                    <label class="form-label">Email</label><input class="form-control mb-3" type="email" name="email" id="editAdminEmail" maxlength="191" required>
                    <label class="form-label">Role</label><select class="form-select mb-3" name="role" id="editAdminRole" required>@foreach($roles as $roleKey => $roleLabel)<option value="{{ $roleKey }}">{{ $roleLabel }}</option>@endforeach</select>
                    <label class="form-label">New password (optional)</label><input class="form-control mb-3" type="password" name="password" minlength="{{ $settings['minimum_password_length'] }}" autocomplete="new-password">
                    <label class="form-label">Confirm new password</label><input class="form-control" type="password" name="password_confirmation" minlength="{{ $settings['minimum_password_length'] }}" autocomplete="new-password">
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button class="btn settings-save" type="submit">Save Admin</button></div>
            </form>
        </div></div>
    </div>

    <div class="modal fade" id="restoreSettingsModal" tabindex="-1" aria-labelledby="restoreSettingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <form method="POST" action="{{ route('admin.setting.restore') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header"><h5 class="modal-title" id="restoreSettingsModalLabel">Restore Settings</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body"><label class="form-label">Settings backup (JSON)</label><input class="form-control" type="file" name="backup_file" accept=".json,application/json" required><small class="text-muted d-block mt-2">API credentials are excluded from backups and remain unchanged on restore.</small></div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn settings-save">Restore</button></div>
            </form>
        </div></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.js-edit-admin').forEach(function (button) {
                button.addEventListener('click', function () {
                    const form = document.getElementById('editAdminForm');
                    form.action = @json(route('admin.setting.admins.update', ['id' => '__ID__'])).replace('__ID__', encodeURIComponent(button.dataset.id));
                    document.getElementById('editAdminName').value = button.dataset.name;
                    document.getElementById('editAdminEmail').value = button.dataset.email;
                    document.getElementById('editAdminRole').value = button.dataset.role;
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('editAdminModal')).show();
                });
            });
        });
    </script>
@endsection
