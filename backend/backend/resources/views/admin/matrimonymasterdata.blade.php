@extends('layout')

@section('content')
    <style>
        .master-data-page {
            min-height: 100vh;
            background: #fdf9f6;
            color: #34232a;
        }

        .master-data-page .text-maroon {
            color: #581629;
        }

        .master-data-page .btn-maroon {
            background: #581629;
            border-color: #581629;
            color: #fff;
        }

        .master-data-page .btn-maroon:hover {
            background: #42101f;
            border-color: #42101f;
            color: #fff;
        }

        .master-data-page .filter-card,
        .master-data-page .members-card,
        .master-data-page .religion-card {
            border: 1px solid #eee3e5;
            border-radius: 12px;
            background: #fff;
        }

        .master-data-page .filter-card {
            position: sticky;
            top: 1rem;
            max-height: calc(100vh - 2rem);
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: #c9aeb5 transparent;
        }

        .master-data-page .filter-card::-webkit-scrollbar {
            width: 6px;
        }

        .master-data-page .filter-card::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: #c9aeb5;
        }

        .master-data-page .form-label {
            color: #49383d;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .master-data-page .form-control,
        .master-data-page .form-select {
            min-height: 36px;
            border-color: #e9dfe1;
            border-radius: 8px;
            font-size: 12px;
        }

        .master-data-page .form-check-input:checked {
            background-color: #581629;
            border-color: #581629;
        }

        .master-data-page .religion-pill {
            border: 1px solid #e7dadd;
            border-radius: 999px;
            color: #34232a;
            background: #fff;
            font-size: 12px;
            padding: 7px 14px;
            white-space: nowrap;
        }

        .master-data-page .religion-pill.active {
            background: #581629;
            border-color: #581629;
            color: #fff;
        }

        .master-data-page .active-filter {
            border-radius: 999px;
            background: #f8e8ec;
            color: #581629;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 9px;
            font-size: 11px;
        }

        .master-data-page .member-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            object-fit: cover;
            background: #f5e8eb;
            color: #581629;
        }

        .master-data-page .status-pill {
            border-radius: 999px;
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            padding: 4px 8px;
            white-space: nowrap;
        }

        .master-data-page .status-approved {
            background: #e3f3e9;
            color: #277044;
        }

        .master-data-page .status-pending {
            background: #fff3dc;
            color: #8b6415;
        }

        .master-data-page .status-rejected {
            background: #fde8e8;
            color: #a52f35;
        }

        .master-data-page .status-update_requested {
            background: #e7f0fb;
            color: #325c8a;
        }

        @media (max-width: 767.98px) {
            .master-data-page .filter-card {
                position: static;
            }
        }
    </style>

    <div class="content-page master-data-page">
        <div class="container-fluid px-3 px-lg-4 py-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <div>
                    <h3 class="fw-bold text-maroon mb-1">Matrimony Master Data</h3>
                    <p class="text-muted fs-13 mb-0">Browse and filter registered member profiles.</p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">
                    <form method="GET" action="{{ route('admin.matrimonymasterdata') }}" class="d-flex gap-2">
                        @foreach(request()->except(['search', 'page']) as $name => $value)
                            @if(is_array($value))
                                @foreach($value as $item)
                                    <input type="hidden" name="{{ $name }}[]" value="{{ $item }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="Search by ID, name or phone"
                            aria-label="Search members"
                        >
                        <button class="btn btn-outline-secondary btn-sm px-3" type="submit">Search</button>
                    </form>
                    <a class="btn btn-outline-secondary btn-sm px-3"
                       href="{{ route('admin.matrimonymasterdata.export', request()->query()) }}">
                        <i class="ti ti-download me-1"></i>Export
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
            @endif

            <div class="religion-card p-2 mb-3">
                <div class="d-flex flex-wrap gap-2">
                    <a class="religion-pill {{ empty($filters['religion']) ? 'active' : '' }}"
                       href="{{ route('admin.matrimonymasterdata', request()->except(['religion', 'page'])) }}">All</a>
                    @foreach($religions as $religion)
                        <a class="religion-pill {{ ($filters['religion'] ?? '') === $religion ? 'active' : '' }}"
                           href="{{ route('admin.matrimonymasterdata', array_merge(request()->except('page'), ['religion' => $religion])) }}">
                            {{ $religion }}
                        </a>
                    @endforeach
                </div>
            </div>

            @php
                $activeFilters = [];
                foreach ([
                    'religion' => 'Religion',
                    'community' => 'Community',
                    'rasi' => 'Rasi',
                    'nakshatra' => 'Nakshatra',
                    'gothram' => 'Gothram',
                    'education' => 'Education',
                    'city' => 'City',
                    'status' => 'Status',
                    'vendor_id' => 'Vendor',
                ] as $filterKey => $filterLabel) {
                    if (!empty($filters[$filterKey])) {
                        $filterValue = $filters[$filterKey];
                        if ($filterKey === 'vendor_id') {
                            $filterValue = optional($vendors->firstWhere('id', $filterValue))->agent_name ?? $filterValue;
                        }
                        $activeFilters[] = $filterLabel . ': ' . str_replace('_', ' ', ucfirst($filterValue));
                    }
                }
                foreach (['age_from' => 'Age from', 'age_to' => 'Age to', 'height_from' => 'Height from', 'height_to' => 'Height to'] as $filterKey => $filterLabel) {
                    if (!empty($filters[$filterKey])) {
                        $activeFilters[] = $filterLabel . ': ' . $filters[$filterKey];
                    }
                }
                if (!empty($filters['marital_status'])) {
                    $activeFilters[] = 'Marital status: ' . implode(', ', $filters['marital_status']);
                }
                if (!empty($filters['photo_only'])) {
                    $activeFilters[] = 'Photo available';
                }
            @endphp

            @if(count($activeFilters))
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="text-muted fs-12">Active filters:</span>
                    @foreach($activeFilters as $activeFilter)
                        <span class="active-filter">{{ $activeFilter }}</span>
                    @endforeach
                    <a class="text-maroon fs-12 ms-1"
                       href="{{ route('admin.matrimonymasterdata', array_intersect_key(request()->query(), ['search' => true])) }}">Clear all</a>
                </div>
            @endif

            <div class="row g-3 align-items-start">
                <div class="col-xl-3 col-lg-4">
                    <form method="GET" action="{{ route('admin.matrimonymasterdata') }}" class="filter-card p-3">
                        <h6 class="fw-bold text-maroon mb-3">Filters</h6>
                        @if(!empty($filters['search']))
                            <input type="hidden" name="search" value="{{ $filters['search'] }}">
                        @endif
                        @if(!empty($filters['religion']))
                            <input type="hidden" name="religion" value="{{ $filters['religion'] }}">
                        @endif

                        <div class="rounded-3 p-2 mb-3" style="background:#fbf2f4;">
                            <div class="small fw-bold text-uppercase text-maroon mb-2">Details</div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-rasi">Rasi</label>
                                <select class="form-select" id="filter-rasi" name="rasi">
                                    <option value="">Any</option>
                                    @foreach($horoscopeOptions['rasis'] as $rasi)
                                        <option value="{{ $rasi }}" @selected(($filters['rasi'] ?? '') === $rasi)>{{ $rasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-nakshatra">Nakshatra</label>
                                <select class="form-select" id="filter-nakshatra" name="nakshatra">
                                    <option value="">Any</option>
                                    @foreach($horoscopeOptions['nakshatras'] as $nakshatra)
                                        <option value="{{ $nakshatra }}" @selected(($filters['nakshatra'] ?? '') === $nakshatra)>{{ $nakshatra }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label" for="filter-gothram">Gothram</label>
                                <select class="form-select" id="filter-gothram" name="gothram">
                                    <option value="">Any</option>
                                    @foreach($horoscopeOptions['gothrams'] as $gothram)
                                        <option value="{{ $gothram }}" @selected(($filters['gothram'] ?? '') === $gothram)>{{ $gothram }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="filter-community">Community</label>
                                <select class="form-select" id="filter-community" name="community">
                                    <option value="">Any</option>
                                    @foreach($communities as $community)
                                        <option value="{{ $community }}" @selected(($filters['community'] ?? '') === $community)>{{ $community }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <div class="d-flex align-items-center gap-2">
                                <input class="form-control" type="number" min="18" max="100" name="age_from" value="{{ $filters['age_from'] ?? '' }}" placeholder="From">
                                <span class="text-muted">to</span>
                                <input class="form-control" type="number" min="18" max="100" name="age_to" value="{{ $filters['age_to'] ?? '' }}" placeholder="To">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Height (cm)</label>
                            <div class="d-flex align-items-center gap-2">
                                <input class="form-control" type="number" min="50" max="250" step="0.1" name="height_from" value="{{ $filters['height_from'] ?? '' }}" placeholder="From">
                                <span class="text-muted">to</span>
                                <input class="form-control" type="number" min="50" max="250" step="0.1" name="height_to" value="{{ $filters['height_to'] ?? '' }}" placeholder="To">
                            </div>
                        </div>

                        @if($maritalStatuses->isNotEmpty())
                            <div class="mb-3">
                                <label class="form-label d-block">Marital status</label>
                                @foreach($maritalStatuses as $maritalStatus)
                                    <label class="form-check form-check-sm mb-1">
                                        <input class="form-check-input" type="checkbox" name="marital_status[]" value="{{ $maritalStatus }}" @checked(in_array($maritalStatus, $filters['marital_status'] ?? [], true))>
                                        <span class="form-check-label fs-12">{{ $maritalStatus }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label" for="filter-education">Education</label>
                            <select class="form-select" id="filter-education" name="education">
                                <option value="">Any</option>
                                @foreach($educations as $education)
                                    <option value="{{ $education }}" @selected(($filters['education'] ?? '') === $education)>{{ $education }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-city">City</label>
                            <select class="form-select" id="filter-city" name="city">
                                <option value="">Any</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}" @selected(($filters['city'] ?? '') === $city)>{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-vendor">Vendor (agent)</label>
                            <select class="form-select" id="filter-vendor" name="vendor_id">
                                <option value="">All</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" @selected((string) ($filters['vendor_id'] ?? '') === (string) $vendor->id)>{{ $vendor->agent_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="filter-status">Profile status</label>
                            <select class="form-select" id="filter-status" name="status">
                                <option value="">All</option>
                                <option value="pending" @selected(($filters['status'] ?? '') === 'pending')>Pending</option>
                                <option value="approved" @selected(($filters['status'] ?? '') === 'approved')>Verified</option>
                                <option value="rejected" @selected(($filters['status'] ?? '') === 'rejected')>Suspended</option>
                                <option value="update_requested" @selected(($filters['status'] ?? '') === 'update_requested')>Review requested</option>
                            </select>
                        </div>

                        <label class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="photo_only" value="1" @checked(!empty($filters['photo_only']))>
                            <span class="form-check-label fs-12">Photo available only</span>
                        </label>

                        <div class="d-flex gap-2">
                            <a class="btn btn-outline-secondary btn-sm flex-fill"
                               href="{{ route('admin.matrimonymasterdata', array_intersect_key(request()->query(), ['search' => true, 'religion' => true])) }}">Clear</a>
                            <button class="btn btn-maroon btn-sm flex-fill" type="submit">Apply filters</button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="members-card overflow-hidden">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-3 border-bottom">
                            <span class="text-muted fs-12">
                                Showing all {{ number_format($profiles->count()) }} matching members
                            </span>
                            <form method="GET" action="{{ route('admin.matrimonymasterdata') }}" class="d-flex align-items-center gap-2">
                                @foreach(request()->except(['sort', 'page']) as $name => $value)
                                    @if(is_array($value))
                                        @foreach($value as $item)
                                            <input type="hidden" name="{{ $name }}[]" value="{{ $item }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                                <label class="text-muted fs-12 mb-0" for="sort-profiles">Sort by</label>
                                <select class="form-select form-select-sm" id="sort-profiles" name="sort" onchange="this.form.submit()" style="width:auto;">
                                    <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Newest</option>
                                    <option value="oldest" @selected(($filters['sort'] ?? '') === 'oldest')>Oldest</option>
                                    <option value="age_asc" @selected(($filters['sort'] ?? '') === 'age_asc')>Age: low to high</option>
                                    <option value="age_desc" @selected(($filters['sort'] ?? '') === 'age_desc')>Age: high to low</option>
                                </select>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('admin.matrimonymasterdata.bulk-review', request()->query()) }}" id="bulk-review-form">
                            @csrf
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 px-3 py-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="visually-hidden" for="bulk-decision">Bulk action</label>
                                    <select class="form-select form-select-sm" id="bulk-decision" name="decision" required style="width:auto;">
                                        <option value="">Bulk actions</option>
                                        <option value="approved">Mark verified</option>
                                        <option value="pending">Mark pending</option>
                                        <option value="rejected">Suspend</option>
                                        <option value="update_requested">Request review</option>
                                    </select>
                                    <button class="btn btn-maroon btn-sm" type="submit">Apply</button>
                                </div>
                                <label class="d-flex align-items-center gap-2 text-muted fs-12 mb-0">
                                    <input class="form-check-input m-0" type="checkbox" id="select-all-profiles">
                                    Select all matching profiles
                                </label>
                            </div>

                            <div class="table-responsive">
                                <table id="matrimonyMasterProfiles" class="table align-middle table-hover mb-0 js-data-table" data-page-length="10" data-empty-table="No members match the selected filters.">
                                    <thead style="background:#fcf8f8;">
                                        <tr class="text-uppercase text-muted" style="font-size:10px; letter-spacing:.04em;">
                                            <th class="ps-3" style="width:36px;"></th>
                                            <th>Member</th>
                                            <th>Age / Height</th>
                                            <th>Religion / Community</th>
                                            <th>Rasi</th>
                                            <th>City</th>
                                            <th>Status</th>
                                            <th>Vendor</th>
                                            <th class="text-end pe-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($profiles as $profile)
                                            @php
                                                $statusLabel = [
                                                    'approved' => 'Verified',
                                                    'pending' => 'Pending',
                                                    'rejected' => 'Suspended',
                                                    'update_requested' => 'Review',
                                                ][$profile->verification_status] ?? ucfirst($profile->verification_status);
                                            @endphp
                                            <tr>
                                                <td class="ps-3">
                                                    <input class="form-check-input profile-select" type="checkbox" name="ids[]" value="{{ $profile->id }}" aria-label="Select {{ $profile->member_name ?: $profile->profile_id }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @if($profile->profile_image)
                                                            <img class="member-avatar" src="{{ asset('storage/' . ltrim($profile->profile_image, '/')) }}" alt="">
                                                        @else
                                                            <span class="member-avatar d-inline-flex align-items-center justify-content-center fw-bold">{{ strtoupper(substr($profile->member_name ?: 'M', 0, 1)) }}</span>
                                                        @endif
                                                        <div class="lh-sm">
                                                            <div class="fw-semibold text-dark">{{ $profile->member_name ?: 'Member' }}</div>
                                                            <small class="text-muted">{{ $profile->member_id ?: $profile->profile_id ?: ('#' . $profile->id) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <div>{{ $profile->age ? $profile->age . ' yrs' : '—' }}</div>
                                                    <small class="text-muted">{{ $profile->height ? $profile->height . ' cm' : '—' }}</small>
                                                </td>
                                                <td>
                                                    <div>{{ $profile->religion ?: '—' }}</div>
                                                    <small class="text-muted">{{ $profile->community ?: $profile->caste ?: '—' }}</small>
                                                </td>
                                                <td>{{ $profile->rasi ?: '—' }}</td>
                                                <td>{{ $profile->city ?: '—' }}</td>
                                                <td><span class="status-pill status-{{ $profile->verification_status }}">{{ $statusLabel }}</span></td>
                                                <td>{{ $profile->vendor_name ?: 'Direct' }}</td>
                                                <td class="text-end pe-3">
                                                    <a class="text-maroon fw-semibold text-decoration-none"
                                                       href="{{ route('admin.profile-verification.index', ['status' => $profile->verification_status, 'id' => $profile->id]) }}">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-5">
                                                    <i class="ti ti-users fs-3 d-block mb-2"></i>
                                                    No members match the selected filters.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all-profiles');
            const bulkForm = document.getElementById('bulk-review-form');
            const profilesTable = document.getElementById('matrimonyMasterProfiles');
            const getDataTable = function () {
                return window.jQuery
                    && jQuery.fn.DataTable
                    && profilesTable
                    && jQuery.fn.DataTable.isDataTable(profilesTable)
                    ? jQuery(profilesTable).DataTable()
                    : null;
            };

            selectAll?.addEventListener('change', function () {
                const dataTable = getDataTable();
                const checkboxes = dataTable
                    ? dataTable.$('.profile-select').toArray()
                    : Array.from(document.querySelectorAll('.profile-select'));

                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });
            });

            bulkForm?.addEventListener('submit', function (event) {
                bulkForm.querySelectorAll('.datatable-selected-profile').forEach(function (input) {
                    input.remove();
                });

                const dataTable = getDataTable();
                const selectedProfiles = dataTable
                    ? dataTable.$('.profile-select:checked').toArray()
                    : Array.from(bulkForm.querySelectorAll('.profile-select:checked'));

                if (selectedProfiles.length === 0) {
                    event.preventDefault();
                    alert('Select at least one profile before applying a bulk action.');
                    return;
                }

                selectedProfiles.forEach(function (checkbox) {
                    if (!bulkForm.contains(checkbox)) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = checkbox.value;
                        input.className = 'datatable-selected-profile';
                        bulkForm.appendChild(input);
                    }
                });

                if (!confirm('Apply this action to the selected profiles?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
