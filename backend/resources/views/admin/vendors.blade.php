@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Vendor Management</h3>
                    <p class="text-muted mb-0 fs-13">Manage brokers, agents, assigned customers and commissions.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button
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

            <!-- Search Bar, Filters & Action Button Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('admin.vendors.index') }}">
                        <div class="row g-2 align-items-center justify-content-between">
                            <div class="col-xl-4 col-md-5 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                        <i class="ti ti-search fs-14"></i>
                                    </span>
                                    <input type="text" name="search" value="{{ $search ?? '' }}"
                                        class="form-control border-start-0 ps-1 fs-13"
                                        placeholder="Search vendor, ID or city">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-4 col-sm-6">
                                <select name="status" class="form-select fs-13 text-secondary border">
                                    <option value="">All statuses</option>
                                    <option value="Active" {{ ($status ?? '') === 'Active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="Pending" {{ ($status ?? '') === 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Suspended" {{ ($status ?? '') === 'Suspended' ? 'selected' : '' }}>
                                        Suspended</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-md-4 col-sm-5 text-sm-end text-start">
                                <div class="d-flex justify-content-end align-items-center gap-2 flex-nowrap">
                                    <button type="submit"
                                        class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm"
                                        style="background-color: #561325;">
                                        <i class="ti ti-search me-1"></i> Search
                                    </button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#addVendorModal"
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
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="text-muted fs-12 mb-1">Total vendors</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;">{{ number_format($totalVendors) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="text-muted fs-12 mb-1">Pending approval</div>
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($pendingVendors) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="text-muted fs-12 mb-1">Active agents</div>
                            <h3 class="fw-bold mb-0 text-dark">{{ number_format($activeVendors) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-white"
                        style="border: 1px solid #F3E5E8 !important;">
                        <div class="card-body p-3">
                            <div class="text-muted fs-12 mb-1">Commission due</div>
                            <h3 class="fw-bold mb-0" style="color: #561325;">₹{{ number_format($totalCommission, 2) }}</h3>
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
                    <table id="vendorDirectoryTable" class="table align-middle mb-0 table-hover js-data-table"
                        data-page-length="10" data-empty-table="No vendors found.">
                        <thead style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase;">
                            <tr style="color: #561325;">
                                <th class="ps-4 py-3">VENDOR ID</th>
                                <th class="py-3">AGENT NAME</th>
                                <th class="py-3">MOBILE NUMBER</th>
                                <th class="py-3">CITY</th>
                                <th class="py-3">PROFILES</th>
                                <th class="py-3">STATUS</th>
                                <th class="py-3">COMMISSION</th>
                                <th class="text-center pe-4 py-3">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody class="fs-13">
                            @forelse($vendors as $vendor)
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">
                                        VN-{{ str_pad($vendor->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="fw-medium text-dark">{{ $vendor->agent_name }}</td>
                                    <td class="fw-medium text-dark">{{ $vendor->vendor_mobile }}</td>
                                    <td class="text-muted">{{ $vendor->city }}</td>
                                    <td class="fw-medium text-dark">{{ $vendor->customers_count }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($vendor->status) {
                                                'Active' => 'text-success',
                                                'Pending' => 'text-warning',
                                                'Suspended' => 'text-danger',
                                                default => 'text-secondary'
                                            };
                                        @endphp
                                        <span class="fw-semibold {{ $statusClass }}">{{ $vendor->status }}</span>
                                    </td>
                                    <td class="fw-medium text-dark">₹{{ number_format((float) $vendor->commission, 2) }}</td>
                                    <td class="text-center pe-4">
                                        <div class="d-inline-flex gap-1">
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#editVendorModal{{ $vendor->id }}" title="Edit vendor">
                                                <i class="ti ti-edit"></i> Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this vendor?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Delete vendor">
                                                    <i class="ti ti-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">No vendors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="p-3">
                    {{ $vendors->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Add Vendor Modal -->
    <div class="modal fade" id="addVendorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header px-4 pt-4 pb-3" style="border-bottom: 1px solid #f0e3e7;">
                    <h5 class="modal-title fw-bold" style="color: #561325;">Add New Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin.vendors.store') }}">
                    @csrf
                    <div class="modal-body px-4 py-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Agent Name <span class="text-danger">*</span></label>
                                <input type="text" name="agent_name" class="form-control" value="{{ old('agent_name') }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mobile Number <span
                                        class="text-danger">*</span></label>
                                <input type="tel" name="vendor_mobile" class="form-control"
                                    value="{{ old('vendor_mobile') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Vendor Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-select" required>
                                    <option value="Active">Active</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Commission <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="commission" class="form-control"
                                    value="{{ old('commission') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-4 py-3">
                        <button type="button" class="btn btn-light border rounded-3 px-4"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn text-white fw-semibold rounded-3 px-4"
                            style="background-color: #561325;">Add Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Vendor Modals Loop -->
    @foreach($vendors as $vendor)
        <div class="modal fade" id="editVendorModal{{ $vendor->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 shadow">
                    <div class="modal-header px-4 pt-4 pb-3" style="border-bottom: 1px solid #f0e3e7;">
                        <h5 class="modal-title fw-bold" style="color: #561325;">Edit Vendor:
                            VN-{{ str_pad($vendor->id, 5, '0', STR_PAD_LEFT) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.vendors.update', $vendor->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body px-4 py-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Agent Name <span class="text-danger">*</span></label>
                                    <input type="text" name="agent_name" class="form-control"
                                        value="{{ old('agent_name', $vendor->agent_name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile Number <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="vendor_mobile" class="form-control"
                                        value="{{ old('vendor_mobile', $vendor->vendor_mobile) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city', $vendor->city) }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $vendor->email) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Vendor Status <span
                                            class="text-danger">*</span></label>
                                    <select name="status" class="form-select" required>
                                        <option value="Active" {{ $vendor->status === 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Pending" {{ $vendor->status === 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Suspended" {{ $vendor->status === 'Suspended' ? 'selected' : '' }}>
                                            Suspended</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Commission <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="commission" class="form-control"
                                        value="{{ old('commission', $vendor->commission) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password <small class="text-muted">(Leave blank to
                                            keep current)</small></label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer px-4 py-3">
                            <button type="button" class="btn btn-light border rounded-3 px-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white fw-semibold rounded-3 px-4"
                                style="background-color: #561325;">Update Vendor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection