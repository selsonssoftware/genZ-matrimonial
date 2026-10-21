@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

      
{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Vendor Management</h3>
                    <p class="text-muted mb-0 fs-13">Manage brokers, agents, assigned customers and commissions.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                   

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

            
<!-- Search Bar, Filters & Action Button Card -->
<div class="card border-0 shadow-sm rounded-4 mb-4 bg-white"
     style="border: 1px solid #F3E5E8 !important;">
    <div class="card-body p-3">

        <form method="GET" action="{{ route('admin.vendors.index') }}">
            <div class="row g-2 align-items-center justify-content-between">

                <!-- Search -->
                <div class="col-xl-4 col-md-5 col-sm-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                            <i class="ti ti-search fs-14"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            class="form-control border-start-0 ps-1 fs-13"
                            placeholder="Search vendor, ID or city">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-xl-3 col-md-4 col-sm-6">
                    <select name="status"
                            class="form-select fs-13 text-secondary border">
                        <option value="">All statuses</option>

                        <option value="Active"
                            {{ ($status ?? '') === 'Active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="Pending"
                            {{ ($status ?? '') === 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Suspended"
                            {{ ($status ?? '') === 'Suspended' ? 'selected' : '' }}>
                            Suspended
                        </option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-xl-3 col-md-4 col-sm-5 text-sm-end text-start">
                  <div class="d-flex justify-content-end align-items-center gap-2 flex-nowrap">
                    <button type="submit"
                            class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                            style="background-color: #561325;">
                        <i class="ti ti-search me-1"></i> Search
                    </button>

                    <button type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#addVendorModal"
                            class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                            style="background-color: #561325;">
                        <i class="ti ti-plus me-1"></i> Add Vendor
                    </button>
                  </div>
                </div>
            </div>
        </form>

    </div>
</div>


            <!-- Metric KPI Cards -->
            <div class="row g-3 mb-4">
                <!-- Total vendors -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">+</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">+8.4%</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Total vendors</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricTotal">{{ number_format($totalVendors) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Pending approval -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FFF4E5; color: #B76E00; font-size: 13px;">!</span>
                                <span class="text-muted fs-11">Review needed</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Pending approval</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricPending">{{ number_format($pendingVendors) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Active agents -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #E8F8F0; color: #0E9F6E; font-size: 13px;">✓</span>
                                <span
                                    class="badge rounded-pill bg-success-subtle text-success fs-10 border border-success-subtle">Active</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Active agents</div>
                            <h3 class="fw-bold mb-0 text-dark" id="metricActive">{{ number_format($activeVendors) }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Commission due -->
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 24px; height: 24px; background-color: #FCECEE; color: #561325; font-size: 13px;">₹</span>
                                <span class="text-muted fs-11">Current period</span>
                            </div>
                            <div class="text-muted fs-12 mb-1">Commission due</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;" id="metricCommission">₹{{ number_format($totalCommission, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vendor Directory Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4"
                style="border: 1px solid #F3E5E8 !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">Vendor Directory</h5>
                    <p class="text-muted fs-12 mb-0">Each agent has a separate login and scoped customer access.</p>
                </div>

                <div class="table-responsive">
                    <table id="vendorDirectoryTable" class="table align-middle mb-0 table-hover js-data-table" data-page-length="10" data-empty-table="No vendors found.">
                        <thead
                            style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">VENDOR ID</th>
                                <th class="py-3">AGENT NAME</th>
                                <th class="py-3">MOBILE NUMBER</th>
                                <th class="py-3">CITY</th>
                                <th class="py-3">PROFILES</th>
                                <th class="py-3">STATUS</th>
                                <th class="py-3">COMMISSION</th>
                                <th class="text-center pe-4 py-3">ACTION</th>
                            </tr>
                        </thead>
                       
<tbody class="fs-13">
    @forelse($vendors as $vendor)
        <tr>
            <td class="ps-4 fw-semibold text-dark">
                VN-{{ str_pad($vendor->id, 5, '0', STR_PAD_LEFT) }}
            </td>

            <td class="fw-medium text-dark">
                {{ $vendor->agent_name }}
            </td>

            <td class="fw-medium text-dark">
    {{ $vendor->vendor_mobile }}
</td>

            <td class="text-muted">
                {{ $vendor->city }}
            </td>

            <td class="fw-medium text-dark">
                {{ $vendor->customers_count }}
            </td>

            
<td>
    @php
        $statusClass = 'text-secondary';

        if ($vendor->status === 'Active') {
            $statusClass = 'text-success';
        } elseif ($vendor->status === 'Pending') {
            $statusClass = 'text-warning';
        } elseif ($vendor->status === 'Suspended') {
            $statusClass = 'text-danger';
        }
    @endphp

    <span class="fw-semibold {{ $statusClass }}">
        {{ $vendor->status }}
    </span>
</td>

           

            <td class="fw-medium text-dark">
                ₹{{ number_format((float) $vendor->commission, 2) }}
            </td>

            <td class="text-center pe-4">
                <button type="button"
                        class="btn btn-sm btn-outline-secondary js-toggle-vendor-assignment"
                        data-template="assignVendor{{ $vendor->id }}"
                        aria-expanded="false">
                    Assign Profile
                </button>
                <template id="assignVendor{{ $vendor->id }}">
                    <form method="POST"
                          action="{{ route('admin.vendors.assign-profile', $vendor->id) }}"
                          class="d-flex flex-wrap gap-2 p-3">
                        @csrf

                        <input type="text"
                               name="profile_id"
                               class="form-control form-control-sm"
                               placeholder="Member Profile ID"
                               required
                               style="max-width:300px;">

                        <button type="submit"
                                class="btn btn-sm text-white"
                                style="background-color:#561325;">
                            Assign Profile
                        </button>
                    </form>
                </template>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center py-4 text-muted">
                No vendors found.
            </td>
        </tr>
    @endforelse
</tbody>

                    </table>
                </div>
                <!-- Access Rule Notice Bar (Bottom of Table) -->
                <div class="p-3 m-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                    <p class="fs-12 mb-0 d-flex align-items-center" style="color: #8D6718;">
                        <i class="ti ti-info-circle me-2 fs-15"></i>
                        <span><strong>Access rule:</strong> Vendors can only view and manage customers assigned to their own
                            vendor account.</span>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Add Vendor Modal -->

<div class="modal fade" id="addVendorModal" tabindex="-1"
     aria-labelledby="addVendorModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">

            {{-- Modal Header --}}
            <div class="modal-header px-4 pt-4 pb-3"
                 style="border-bottom: 1px solid #f0e3e7;">

                <div>
                    <h5 class="modal-title fw-bold"
                        id="addVendorModalLabel"
                        style="color: #561325;">
                        Add New Vendor
                    </h5>

                    <p class="text-muted small mb-0 mt-1">
                        Enter the vendor details below.
                    </p>
                </div>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            {{-- Form --}}
            <form method="POST"
                  action="{{ route('admin.vendors.store') }}">
                @csrf

                <div class="modal-body px-4 py-4">

                    <div class="row g-3">

                        {{-- Agent Name --}}
                        <div class="col-md-6">
                            <label for="agent_name"
                                   class="form-label fw-semibold">
                                Agent Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   id="agent_name"
                                   name="agent_name"
                                   class="form-control"
                                   placeholder="Enter agent name"
                                   value="{{ old('agent_name') }}"
                                   required>
                        </div>

                        {{-- Vendor Mobile Number --}}
                        <div class="col-md-6">
                            <label for="vendor_mobile" class="form-label fw-semibold">
                                Mobile Number <span class="text-danger">*</span>
                            </label>

                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light border-end-0 text-muted">
                                    <i class="ti ti-phone fs-15"></i>
                                </span>
                                <input
                                    type="tel"
                                    id="vendor_mobile"
                                    name="vendor_mobile"
                                    class="form-control border-start-0 @error('vendor_mobile') is-invalid @enderror"
                                    placeholder="e.g. 9876543210"
                                    value="{{ old('vendor_mobile') }}"
                                    maxlength="14"
                                    pattern="^(\+91[\-\s]?|0)?[6-9]\d{9}$"
                                    title="Please enter a valid 10-digit mobile number (e.g. 9876543210 or +91 9876543210)"
                                    required
                                    autocomplete="tel">
                                @error('vendor_mobile')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback" id="vendorMobileJsError" style="display: none;">
                                    Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.
                                </div>
                            </div>
                            <small class="text-muted fs-11 mt-1 d-block">10-digit mobile number (e.g. 9876543210 or +91 9876543210)</small>
                        </div>

                        {{-- City --}}
                        <div class="col-md-6">
                            <label for="city"
                                   class="form-label fw-semibold">
                                City <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   id="city"
                                   name="city"
                                   class="form-control"
                                   placeholder="Enter city"
                                   value="{{ old('city') }}"
                                   required>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label for="email"
                                   class="form-label fw-semibold">
                                Email Address <span class="text-danger">*</span>
                            </label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="vendor@example.com"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label for="status"
                                   class="form-label fw-semibold">
                                Vendor Status <span class="text-danger">*</span>
                            </label>

                          <select id="vendor_status"
        name="status"
        class="form-select"
        style="display: block !important;
               width: 100%;
               min-height: 42px;
               background-color: #fff;
               color: #333;
               border: 1px solid #ced4da;
               appearance: auto;
               -webkit-appearance: auto;"
        required>
    <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>
        Active
    </option>
    <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>
        Pending
    </option>
    <option value="Suspended" {{ old('status') === 'Suspended' ? 'selected' : '' }}>
        Suspended
    </option>
</select>
                        </div>

                        {{-- Commission --}}
                        <div class="col-md-6">
                            <label for="commission"
                                   class="form-label fw-semibold">
                                Commission (%) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   id="commission"
                                   name="commission"
                                   class="form-control"
                                   placeholder="Enter commission"
                                   min="0"
                                   step="0.01"
                                   value="{{ old('commission') }}"
                                   required>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6">
                            <label for="password"
                                   class="form-label fw-semibold">
                                Password <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Create password"
                                   required>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6">
                            <label for="password_confirmation"
                                   class="form-label fw-semibold">
                                Confirm Password <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm password"
                                   required>
                        </div>

                    </div>
                </div>

                {{-- Footer Buttons --}}
                <div class="modal-footer px-4 py-3"
                     style="border-top: 1px solid #f0e3e7;">

                    <button type="button"
                            class="btn btn-light border rounded-3 px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn text-white fw-semibold rounded-3 px-4"
                            style="background-color: #561325;">
                        <i class="ti ti-plus me-1"></i>
                        Add Vendor
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileInput = document.getElementById('vendor_mobile');
        const mobileError = document.getElementById('vendorMobileJsError');
        const addVendorModalEl = document.getElementById('addVendorModal');
        const addVendorForm = addVendorModalEl ? addVendorModalEl.querySelector('form') : null;

        // Auto reopen modal if validation failed on submission
        const reopenAddVendorModal = @json($errors->any());
        if (reopenAddVendorModal && addVendorModalEl) {
            const modalInstance = new bootstrap.Modal(addVendorModalEl);
            modalInstance.show();
        }

        if (mobileInput) {
            // Regex for Indian mobile number: optional +91 or 0 prefix, then 10 digits starting with 6-9
            const mobileRegex = /^(\+91[\-\s]?|0)?[6-9]\d{9}$/;

            // Restrict input characters to numbers, +, -, and spaces
            mobileInput.addEventListener('keypress', function (e) {
                const char = String.fromCharCode(e.which || e.keyCode);
                if (!/[\d\+\-\s]/.test(char)) {
                    e.preventDefault();
                }
            });

            function validateMobile() {
                const rawVal = mobileInput.value.trim();
                if (!rawVal) {
                    mobileInput.classList.remove('is-valid', 'is-invalid');
                    if (mobileError) mobileError.style.display = 'none';
                    return false;
                }

                if (mobileRegex.test(rawVal)) {
                    mobileInput.classList.remove('is-invalid');
                    mobileInput.classList.add('is-valid');
                    if (mobileError) mobileError.style.display = 'none';
                    return true;
                } else {
                    mobileInput.classList.remove('is-valid');
                    mobileInput.classList.add('is-invalid');
                    if (mobileError) {
                        mobileError.style.display = 'block';
                        mobileError.textContent = 'Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9 (e.g. 9876543210).';
                    }
                    return false;
                }
            }

            mobileInput.addEventListener('input', validateMobile);
            mobileInput.addEventListener('blur', validateMobile);

            if (addVendorForm) {
                addVendorForm.addEventListener('submit', function (e) {
                    if (!validateMobile()) {
                        e.preventDefault();
                        e.stopPropagation();
                        mobileInput.focus();
                    }
                });
            }
        }
    });
    </script>
@endsection