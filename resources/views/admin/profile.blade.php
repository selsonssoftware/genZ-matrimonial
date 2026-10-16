@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Profile Verification</h3>
                    <p class="text-muted mb-0 fs-13">Review member documents and approve verified profiles.</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Search Box -->
                    
<form method="GET" action="{{ route('admin.profile-verification.index') }}">
    <div class="input-group shadow-sm" style="width: 170px;">
        <span class="input-group-text bg-white border-end-0 text-muted ps-2 pe-1 py-1">
            <i class="ti ti-search fs-14"></i>
        </span>

        <input
            type="text"
            name="search"
            value="{{ $search ?? request('search') }}"
            class="form-control form-control-sm border-start-0 ps-1 py-1 fs-12 bg-white"
            placeholder="Search"
        />
    </div>
</form>


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

            <!-- Filter Navigation Pills Card -->
            
<div class="card border-0 shadow-sm rounded-4 mb-4"
     style="border: 1px solid #F3E5E8 !important;">
    <div class="card-body p-2">
        <div class="d-flex flex-wrap gap-2 fs-12 fw-semibold">

            <a href="{{ route('admin.profile-verification.index', ['status' => 'all']) }}"
               class="btn btn-sm px-3 py-2 rounded-3 fw-bold {{ ($status ?? 'pending') === 'all' ? 'text-white shadow-sm' : 'btn-light text-muted' }}"
               style="{{ ($status ?? 'pending') === 'all' ? 'background-color: #561325;' : '' }}">
                All profiles
            </a>

            <a href="{{ route('admin.profile-verification.index', ['status' => 'pending']) }}"
               class="btn btn-sm px-3 py-2 rounded-3 {{ ($status ?? 'pending') === 'pending' ? 'text-white' : 'btn-light text-muted' }}"
               style="{{ ($status ?? 'pending') === 'pending' ? 'background-color: #561325;' : '' }}">
                Pending
                <span class="badge bg-white ms-1"
                      style="color: #561325;">
                    {{ $counts['pending'] ?? 0 }}
                </span>
            </a>

            <a href="{{ route('admin.profile-verification.index', ['status' => 'approved']) }}"
               class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3">
                Approved
                <span class="ms-1">{{ $counts['approved'] ?? 0 }}</span>
            </a>

            <a href="{{ route('admin.profile-verification.index', ['status' => 'rejected']) }}"
               class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3">
                Rejected
                <span class="ms-1">{{ $counts['rejected'] ?? 0 }}</span>
            </a>

            <a href="{{ route('admin.profile-verification.index', ['status' => 'update_requested']) }}"
               class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3">
                Update requested
                <span class="ms-1">{{ $counts['update_requested'] ?? 0 }}</span>
            </a>

        </div>
    </div>
</div>


            <!-- Main Profile Review Container Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                <div class="row g-4 align-items-start">

                    <!-- Left Side: Profile Photo Box -->
                    <div class="col-lg-4 col-md-5 text-center">
                        <div class="rounded-4 p-4 d-flex flex-column align-items-center justify-content-center mx-auto"
                            style="background-color: #FDF4F6; border: 1px solid #F5DDE3; max-width: 290px; min-height: 340px;">
                            
@if($selectedProfile && !empty($selectedProfile->profile_image))
    <img
        src="{{ asset('storage/' . ltrim($selectedProfile->profile_image, '/')) }}"
        alt="Profile photo"
        class="rounded-circle mb-3 shadow-sm"
        style="width: 120px; height: 120px; object-fit: cover;"
    >
@else
    <div
        class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-24 mb-3 shadow-sm"
        style="width: 95px; height: 95px; background-color: #F3CAD3; color: #561325;"
    >
        {{ strtoupper(substr($selectedProfile->user_name ?? 'M', 0, 1)) }}
    </div>
@endif

                            <h6 class="fw-bold mb-1 fs-12 text-uppercase tracking-wider" style="color: #561325;">
                                Profile Photo
                            </h6>
                            <span class="text-muted fs-11">Illustrative placeholder</span>
                        </div>
                    </div>

                    <!-- Right Side: Details & Action Inputs -->
                    <div class="col-lg-8 col-md-7">
                        
<!-- Title & User Info -->
<div class="border-bottom pb-3 mb-3">
    @if($selectedProfile)
        <h3 class="fw-bold text-dark mb-1">
            {{ $selectedProfile->user_name ?? 'Member' }}
        </h3>

        <span class="text-muted fs-12">
            Profile ID:
            <strong class="text-dark">
                {{ $selectedProfile->profile_id ?? 'N/A' }}
            </strong>
            · Submitted
            {{ !empty($selectedProfile->created_at)
                ? \Carbon\Carbon::parse($selectedProfile->created_at)->format('d M Y')
                : 'N/A' }}
        </span>
    @else
        <h3 class="fw-bold text-dark mb-1">No profile found</h3>
        <span class="text-muted fs-12">
            No matching profile found.
        </span>
    @endif
</div>


                        
<!-- Profile Key Details -->
@if($selectedProfile)
    <div class="fs-13 mb-4">

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Age / Gender</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $selectedProfile->age ?? 'N/A' }}
                ·
                {{ $selectedProfile->gender ?? 'N/A' }}
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Location</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $selectedProfile->city ?? 'N/A' }},
                {{ $selectedProfile->state ?? 'N/A' }}
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Education</div>
            <div class="col-8 fw-semibold text-dark">
                @forelse($education as $item)
                    <div>
                        {{ $item->qualification ?? 'N/A' }}
                        @if($item->college_name)
                            - {{ $item->college_name }}
                        @endif
                    </div>
                @empty
                    Not provided
                @endforelse
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Occupation</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $occupation->occupation ?? 'Not provided' }}
                @if($occupation && $occupation->company_name)
                    <div class="text-muted">
                        {{ $occupation->company_name }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Mobile</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $selectedProfile->user_phone ?? 'Not provided' }}
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Email</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $selectedProfile->user_email ?? 'Not provided' }}
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Religion / Caste</div>
            <div class="col-8 fw-semibold text-dark">
                {{ $selectedProfile->religion ?? 'N/A' }}
                /
                {{ $selectedProfile->caste ?? 'N/A' }}
            </div>
        </div>

        <div class="row py-2 border-bottom">
            <div class="col-4 text-muted">Verification</div>
            <div class="col-8 fw-semibold">
                @if($selectedProfile->verification_status === 'approved')
                    <span class="text-success">Approved</span>
                @elseif($selectedProfile->verification_status === 'rejected')
                    <span class="text-danger">Rejected</span>
                @elseif($selectedProfile->verification_status === 'update_requested')
                    <span class="text-warning">Update requested</span>
                @else
                    <span class="text-warning">Pending review</span>
                @endif
            </div>
        </div>

        @if($selectedProfile->about_me)
            <div class="row py-2 border-bottom">
                <div class="col-4 text-muted">About</div>
                <div class="col-8 text-dark">
                    {{ $selectedProfile->about_me }}
                </div>
            </div>
        @endif

    </div>
@endif


                        <!-- Checklist Box -->
                        <div class="p-3 rounded-3 mb-4" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-2 fs-12 d-flex align-items-center" style="color: #8D6718;">
                                <i class="ti ti-checkbox me-1 fs-14"></i> Verification checklist
                            </h6>
                            <div class="d-flex flex-wrap gap-3 fs-12" style="color: #9C7524;">
                                <span class="d-flex align-items-center">
                                    <i class="ti ti-check text-success me-1"></i> Profile information complete
                                </span>
                                <span class="d-flex align-items-center">
                                    <i class="ti ti-check text-success me-1"></i> Photo quality acceptable
                                </span>
                                <span class="d-flex align-items-center">
                                    <i class="ti ti-circle text-muted me-1"></i> ID proof pending
                                </span>
                            </div>
                        </div>

                        
<!-- Admin Review & Notes and Actions -->
@if($selectedProfile)
    <form
        method="POST"
        action="{{ route('admin.profile-verification.review', $selectedProfile->id) }}"
    >
        @csrf

        <div class="mb-4">
            <label class="form-label fs-12 fw-bold text-dark"
                   for="review_notes">
                Admin review notes
            </label>

            <textarea
                name="review_notes"
                id="review_notes"
                class="form-control fs-12 py-2 rounded-3"
                rows="3"
                maxlength="5000"
                placeholder="Add a reason or note for your decision..."
                style="background-color: #FAF7F7; border: 1px solid #ECD9DF;"
            >{{ old('review_notes', $selectedProfile->review_notes) }}</textarea>

            @error('review_notes')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex flex-wrap justify-content-end gap-2 pt-2 border-top">
            <button
                type="submit"
                name="decision"
                value="rejected"
                class="btn btn-sm btn-danger-subtle text-danger fw-semibold px-3 py-2 border border-danger-subtle rounded-3"
                onclick="return confirm('Reject this profile?');"
            >
                Reject with reason
            </button>

            <button
                type="submit"
                name="decision"
                value="update_requested"
                class="btn btn-sm btn-warning-subtle text-warning-emphasis fw-semibold px-3 py-2 border border-warning-subtle rounded-3"
                onclick="return confirm('Request an update for this profile?');"
            >
                Request update
            </button>

            <button
                type="submit"
                name="decision"
                value="approved"
                class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                style="background-color: #561325;"
                onclick="return confirm('Approve this profile?');"
            >
                Approve profile
            </button>
        </div>
    </form>
@endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection