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
            @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close"
                data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">
                        Profile Verification — {{ ucfirst($type) }}
                    </h3>
                    <p class="text-muted mb-0 fs-13">Review member documents and approve verified profiles.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <form method="GET" action="{{ route('admin.profile-verification.index', ['type' => $type]) }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <div class="input-group shadow-sm" style="width: 170px;">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
                                <i class="ti ti-search fs-14"></i>
                            </span>
                            <input type="text" name="search" value="{{ $search ?? request('search') }}"
                                class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
                                placeholder="Search" />
                        </div>
                    </form>
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-12 shadow-sm"
                            style="background-color: #561325; width: 34px; height: 34px;">AJ</div>
                        <div class="d-none d-sm-block text-start lh-1">
                            <span class="fw-bold d-block text-dark fs-13">Admin</span>
                            <small class="text-muted fs-11">Super Admin</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Navigation Pills -->
            @php
                $currentStatus = $status ?? 'all';
                $verificationTabs = [
                    'all' => ['label' => 'All profiles', 'count' => $counts['all'] ?? 0],
                    'pending' => ['label' => 'Pending', 'count' => $counts['pending'] ?? 0],
                    'approved' => ['label' => 'Approved', 'count' => $counts['approved'] ?? 0],
                    'rejected' => ['label' => 'Rejected', 'count' => $counts['rejected'] ?? 0],
                    'update_requested' => ['label' => 'Update requested', 'count' => $counts['update_requested'] ?? 0],
                ];
            @endphp
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-2">
                    <div class="d-flex flex-wrap gap-2 fs-12 fw-semibold">
                        @foreach($verificationTabs as $tabStatus => $tab)
                            <a href="{{ route('admin.profile-verification.index', array_filter(['type' => $type, 'status' => $tabStatus, 'search' => $search])) }}"
                                class="btn btn-sm px-3 py-2 rounded-3 {{ $currentStatus === $tabStatus ? 'text-white shadow-sm' : 'btn-light text-muted' }}"
                                @if($currentStatus === $tabStatus) style="background-color: #561325; border-color: #561325;"
                                @endif>
                                {{ $tab['label'] }}
                                @isset($tab['count'])
                                    <span class="badge bg-white ms-1" style="color: #561325;">{{ $tab['count'] }}</span>
                                @endisset
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Profiles Table -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white"
                style="border: 1px solid #F3E5E8 !important; overflow: visible !important;">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold mb-1" style="color: #561325;">Profiles List ({{ ucfirst($status) }})</h5>
                    <p class="text-muted fs-12 mb-0">Click any Profile Image or Profile ID below to view their full details.
                    </p>
                </div>
                <div class="table-responsive px-3 pb-3" style="overflow-x: visible !important;">
                    <table class="table align-middle table-hover mb-0">
                        <thead style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase;">
                            <tr style="color: #561325;">
                                <th>S.No</th>
                                <th>Profile Img</th>
                                <th>Profile ID</th>
                                <th>Mobile Number</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Education</th>
                                <th>Plan</th>
                                <th>Vendor Name</th>
                                <th>Submitted Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($profiles as $index => $profile)
                                <tr>
                                    <td class="text-muted fw-semibold">{{ $profiles->firstItem() + $index }}</td>

                                    <!-- Profile Image Clickable -->
                                    <td>
                                        <a href="{{ route('admin.profile-verification.index', array_filter(['type' => $type, 'status' => $status, 'search' => $search, 'modal_id' => $profile->id])) }}"
                                            class="text-decoration-none">
                                            @if(!empty($profile->profile_image))
                                                <img src="{{ asset('storage/' . ltrim($profile->profile_image, '/')) }}" alt="img"
                                                    class="rounded-circle shadow-sm border"
                                                    style="width: 35px; height: 35px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white fs-11 shadow-sm"
                                                    style="width: 35px; height: 35px; background-color: #561325;">
                                                    {{ strtoupper(substr($profile->user_name ?? 'M', 0, 1)) }}
                                                </div>
                                            @endif
                                        </a>
                                    </td>

                                    <!-- Profile ID Clickable -->
                                    <td>
                                        <a class="fw-semibold text-dark text-decoration-none"
                                            href="{{ route('admin.profile-verification.index', array_filter(['type' => $type, 'status' => $status, 'search' => $search, 'modal_id' => $profile->id])) }}">
                                            {{ $profile->profile_id ?: ('#' . $profile->id) }}
                                            <div class="small text-muted">{{ $profile->user_name ?? 'Member' }}</div>
                                        </a>
                                    </td>

                                    <td>{{ $profile->user_phone ?? 'N/A' }}</td>
                                    <td>{{ $profile->city ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $profileStatusLabel = [
                                                'approved' => 'Approved',
                                                'rejected' => 'Rejected',
                                                'update_requested' => 'Update requested',
                                                'pending' => 'Pending review',
                                            ][$profile->verification_status] ?? ucfirst($profile->verification_status);
                                        @endphp
                                        <span
                                            class="badge rounded-pill bg-secondary-subtle text-secondary-emphasis">{{ $profileStatusLabel }}</span>
                                    </td>
                                    <td>{{ $profile->education ?? 'N/A' }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $profile->plan ?? 'Free' }}</span></td>
                                    <td>{{ $profile->vendor_name ?? 'Direct' }}</td>
                                    <td>{{ $profile->created_at ? \Carbon\Carbon::parse($profile->created_at)->format('d M Y') : 'N/A' }}
                                    </td>

                                    <!-- Action Column -->
                                    <td class="text-center">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <a href="{{ route('admin.profile-verification.index', array_filter(['type' => $type, 'status' => $status, 'search' => $search, 'modal_id' => $profile->id])) }}"
                                                class="btn btn-sm btn-outline-info px-2 py-1 fs-11" title="View Details">
                                                <i class="ti ti-eye"></i> View
                                            </a>

                                            <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1 fs-11"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $profile->id }}"
                                                title="Edit">
                                                <i class="ti ti-edit"></i> Edit
                                            </button>

                                            <form action="{{ route('admin.profile-verification.destroy', $profile->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this profile?');"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1 fs-11"
                                                    title="Delete">
                                                    <i class="ti ti-trash"></i> Delete
                                                </button>
                                            </form>

                                            <td class="text-center">
    <div class="dropdown">
        <button type="button"
                class="btn btn-sm btn-light border rounded-circle"
                style="width: 32px; height: 32px;"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Assign Profile">
            <i class="ti ti-dots-vertical"></i>
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li>
                <button type="button"
        class="dropdown-item"
        data-bs-toggle="modal"
        data-bs-target="#assignProfileModal"
        data-profile-id="{{ $profile->profile_id }}">
    <i class="ti ti-user-plus me-2"></i>
    Assign Profile
</button>
            </li>
        </ul>
    </div>
</td>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted py-4">No profiles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(method_exists($profiles, 'links'))
                        <div class="mt-3">
                            {{ $profiles->appends(['type' => $type, 'status' => $status, 'search' => $search])->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Full Details Modal Popup (Auto-opens when modal_id is present) -->
            <div class="modal fade" id="fullProfileModal" tabindex="-1" aria-labelledby="fullProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold" id="fullProfileModalLabel" style="color: #561325;">Member
                                Complete Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="closeProfileModal()"></button>
=======
            <!-- Assign Profile Modal -->
<div class="modal fade" id="assignProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" style="color: #561325;">
                    Assign Profiles to Vendor
                </h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('admin.profile-verification.assign-vendor') }}">
                @csrf
<input type="hidden" name="profile_ids" id="assign_profile_ids">

                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="hidden" name="search" value="{{ $search }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="assign_vendor_id" class="form-label fw-semibold">
                            Vendor ID
                        </label>

                        <select name="vendor_id" id="assign_vendor_id"
                                class="form-select" required>
                            <option value="">Select Vendor</option>

                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}"
                                    @selected(old('vendor_id') == $vendor->id)>
                                    VN-{{ str_pad($vendor->id, 5, '0', STR_PAD_LEFT) }}
                                    — {{ $vendor->agent_name }}
                                    ({{ $vendor->vendor_mobile }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="mb-3">
                        <label for="assign_profile_ids" class="form-label fw-semibold">
                            Profile IDs
                        </label>

                        <textarea name="profile_ids" id="assign_profile_ids"
                                  class="form-control" rows="5"
                                  placeholder="Example:&#10;PR10001&#10;PR10002&#10;PR10003"
                                  required>{{ old('profile_ids') }}</textarea>

                        <small class="text-muted">
                            Multiple Profile IDs enter pannalaam. Comma, space, or new line use pannunga.
                        </small>
                    </div> -->

                    <div class="alert alert-info py-2 small mb-0">
                        Each Profile ID can be assigned to only one vendor.
                        Already-assigned profiles cannot be assigned again.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light border"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white"
                            style="background-color: #561325;">
                        Assign Profiles
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

            <!-- Selected Profile Full Details Card -->
            @if($selectedProfile)
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                    <div class="row g-4 align-items-start">
                        <!-- Left Side: Profile Photo Box -->
                        <div class="col-lg-4 col-md-5 text-center">
                            <div class="rounded-4 p-4 d-flex flex-column align-items-center justify-content-center mx-auto"
                                style="background-color: #FDF4F6; border: 1px solid #F5DDE3; max-width: 290px; min-height: 340px;">
                                @if(isset($photos) && $photos->isNotEmpty() && !empty($photos[0]->image))
                                    <img src="{{ asset('storage/' . ltrim($photos[0]->image, '/')) }}" alt="Profile photo"
                                        class="rounded-circle mb-3 shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                @elseif(!empty($selectedProfile->profile_image))
                                    <img src="{{ asset('storage/' . ltrim($selectedProfile->profile_image, '/')) }}"
                                        alt="Profile photo" class="rounded-circle mb-3 shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-24 mb-3 shadow-sm"
                                        style="width: 95px; height: 95px; background-color: #F3CAD3; color: #561325;">
                                        {{ strtoupper(substr($selectedProfile->user_name ?? 'M', 0, 1)) }}
                                    </div>
                                @endif
                                <h6 class="fw-bold mb-1 fs-12 text-uppercase tracking-wider" style="color: #561325;">
                                    Profile Photo
                                </h6>
                                <span class="text-muted fs-11">Primary Photo</span>
                            </div>
>>>>>>> 134cb8036f1618545045805ac0a9485b16cbf9d0
                        </div>
                        <div class="modal-body px-4 py-3">
                            @if(isset($modalProfile))
                                <div class="row g-4 align-items-start">
                                    <div class="col-lg-4 text-center">
                                        <div class="rounded-4 p-3 d-flex flex-column align-items-center justify-content-center mx-auto"
                                            style="background-color: #FDF4F6; border: 1px solid #F5DDE3; max-width: 220px;">
                                            @if(isset($modalPhotos) && $modalPhotos->isNotEmpty() && !empty($modalPhotos[0]->image))
                                                <img src="{{ asset('storage/' . ltrim($modalPhotos[0]->image, '/')) }}"
                                                    alt="Profile photo" class="rounded-circle mb-2 shadow-sm"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @elseif(!empty($modalProfile->profile_image))
                                                <img src="{{ asset('storage/' . ltrim($modalProfile->profile_image, '/')) }}"
                                                    alt="Profile photo" class="rounded-circle mb-2 shadow-sm"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-24 mb-2 shadow-sm text-white"
                                                    style="width: 90px; height: 90px; background-color: #561325;">
                                                    {{ strtoupper(substr($modalProfile->user_name ?? 'M', 0, 1)) }}
                                                </div>
                                            @endif
                                            <h6 class="fw-bold mb-0 fs-12 text-uppercase" style="color: #561325;">
                                                {{ $modalProfile->user_name ?? 'Member' }}</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="row g-2 fs-13">
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Profile
                                                    ID</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ $modalProfile->profile_id ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Age /
                                                    Gender</span>
                                                <span class="text-dark fw-medium fs-13">{{ $modalProfile->age ?? 'N/A' }} /
                                                    {{ $modalProfile->gender ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span
                                                    class="text-muted d-block fs-11 text-uppercase fw-semibold">Location</span>
                                                <span class="text-dark fw-medium fs-13">{{ $modalProfile->city ?? 'N/A' }},
                                                    {{ $modalProfile->state ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Marital
                                                    Status</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ $modalProfile->marital_status ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Religion /
                                                    Caste</span>
                                                <span class="text-dark fw-medium fs-13">{{ $modalProfile->religion ?? 'N/A' }} /
                                                    {{ $modalProfile->caste ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span
                                                    class="text-muted d-block fs-11 text-uppercase fw-semibold">Education</span>
                                                <span class="text-dark fw-medium fs-13">
                                                    @forelse($modalEducationList ?? [] as $edu)
                                                        {{ $edu->qualification ?? '' }}
                                                    @empty
                                                        Not provided
                                                    @endforelse
                                                </span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span
                                                    class="text-muted d-block fs-11 text-uppercase fw-semibold">Occupation</span>
                                                <span class="text-dark fw-medium fs-13">
                                                    {{ $modalOccupation->occupation ?? 'Not provided' }}
                                                </span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Mobile</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ $modalProfile->user_phone ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">Email</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ $modalProfile->user_email ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-md-6 border-bottom pb-2">
                                                <span
                                                    class="text-muted d-block fs-11 text-uppercase fw-semibold">Verification</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ ucfirst($modalProfile->verification_status) }}</span>
                                            </div>
                                            <div class="col-12 border-bottom pb-2">
                                                <span class="text-muted d-block fs-11 text-uppercase fw-semibold">About
                                                    Me</span>
                                                <span
                                                    class="text-dark fw-medium fs-13">{{ $modalProfile->about_me ?? 'Not provided' }}</span>
                                            </div>
                                        </div>

                                        <!-- Review Section inside Modal -->
                                        @if($modalProfile->verification_status === 'pending')
                                            <div class="mt-4 pt-3 border-top">
                                                <form method="POST"
                                                    action="{{ route('admin.profile-verification.review', $modalProfile->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="type" value="{{ $type }}">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-12 fw-bold text-dark" for="review_notes">Admin
                                                            review notes</label>
                                                        <textarea name="review_notes" id="review_notes"
                                                            class="form-control fs-12 py-2 rounded-3" rows="2" maxlength="5000"
                                                            placeholder="Add a reason or note for your decision...">{{ old('review_notes', $modalProfile->review_notes) }}</textarea>
                                                    </div>
                                                    <div class="d-flex flex-wrap justify-content-end gap-2">
                                                        <button type="submit" name="decision" value="rejected"
                                                            class="btn btn-sm btn-danger-subtle text-danger fw-semibold px-3 py-1 border rounded-3"
                                                            onclick="return confirm('Reject this profile?');">
                                                            Reject
                                                        </button>
                                                        <button type="submit" name="decision" value="update_requested"
                                                            class="btn btn-sm btn-warning-subtle text-warning-emphasis fw-semibold px-3 py-1 border rounded-3"
                                                            onclick="return confirm('Request update?');">
                                                            Request Update
                                                        </button>
                                                        <button type="submit" name="decision" value="approved"
                                                            class="btn btn-sm text-white fw-semibold px-3 py-1 rounded-3 shadow-sm"
                                                            style="background-color: #561325;"
                                                            onclick="return confirm('Approve this profile?');">
                                                            Approve
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer border-top-0 px-4 pb-4">
                            <button type="button" class="btn btn-secondary fs-13" data-bs-dismiss="modal"
                                onclick="closeProfileModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modals Loop for each profile -->
            @foreach($profiles as $profile)
                <div class="modal fade" id="editModal{{ $profile->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-header px-4 pt-4 pb-3" style="border-bottom: 1px solid #f0e3e7;">
                                <h5 class="modal-title fw-bold" style="color: #561325;">Edit Profile: {{ $profile->profile_id }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('admin.profile-verification.update', $profile->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="type" value="{{ $type }}">
                                <div class="modal-body px-4 py-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-12">City</label>
                                        <input type="text" name="city" class="form-control form-control-sm"
                                            value="{{ $profile->city }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-12">State</label>
                                        <input type="text" name="state" class="form-control form-control-sm"
                                            value="{{ $profile->state }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-12">Marital Status</label>
                                        <input type="text" name="marital_status" class="form-control form-control-sm"
                                            value="{{ $profile->marital_status }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-12">Religion</label>
                                        <input type="text" name="religion" class="form-control form-control-sm"
                                            value="{{ $profile->religion }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold fs-12">Caste</label>
                                        <input type="text" name="caste" class="form-control form-control-sm"
                                            value="{{ $profile->caste }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer px-4 py-3">
                                    <button type="button" class="btn btn-light border btn-sm px-3 rounded-3"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn text-white btn-sm px-3 rounded-3 fw-semibold"
                                        style="background-color: #561325;">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Auto-open Modal Script if modal_id exists -->
    @if(isset($modalProfile))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('fullProfileModal'));
                myModal.show();
            });

            function closeProfileModal() {
                const url = new URL(window.location.href);
                url.searchParams.delete('modal_id');
                window.location.href = url.toString();
            }
        </script>
    @endif

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const assignModal = document.getElementById('assignProfileModal');

    if (!assignModal) return;

    assignModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const profileId = button?.getAttribute('data-profile-id');

        document.getElementById('assign_profile_ids').value = profileId || '';
    });
});
</script>
@endsection