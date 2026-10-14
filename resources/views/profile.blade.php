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

            <!-- Filter Navigation Pills Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4" style="border: 1px solid #F3E5E8 !important;">
                <div class="card-body p-2">
                    <div class="d-flex flex-wrap gap-2 fs-12 fw-semibold">
                        <button class="btn btn-sm px-3 py-2 rounded-3 fw-bold text-white shadow-sm"
                            style="background-color: #561325;">
                            All queue <span class="badge bg-white ms-1 rounded-pill px-2" style="color: #561325;">186</span>
                        </button>
                        <button class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3 fw-semibold">
                            Photos <span class="text-muted ms-1">82</span>
                        </button>
                        <button class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3 fw-semibold">
                            Identity documents <span class="text-muted ms-1">64</span>
                        </button>
                        <button class="btn btn-sm btn-light border-0 text-muted px-3 py-2 rounded-3 fw-semibold">
                            Vendor applications <span class="text-muted ms-1">40</span>
                        </button>
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
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-24 mb-3 shadow-sm"
                                style="width: 95px; height: 95px; background-color: #F3CAD3; color: #561325;">
                                PS
                            </div>
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
                            <h3 class="fw-bold text-dark mb-1">Priya S.</h3>
                            <span class="text-muted fs-12">User ID: <strong class="text-dark">TM-10482</strong> · Submitted
                                13 Oct 2026</span>
                        </div>

                        <!-- Profile Key Details -->
                        <div class="fs-13 mb-4">
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Age / Gender</div>
                                <div class="col-8 fw-semibold text-dark">27 · Female</div>
                            </div>
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Location</div>
                                <div class="col-8 fw-semibold text-dark">Chennai, Tamil Nadu</div>
                            </div>
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Education</div>
                                <div class="col-8 fw-semibold text-dark">B.Com</div>
                            </div>
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Occupation</div>
                                <div class="col-8 fw-semibold text-dark">Software Professional</div>
                            </div>
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Mobile</div>
                                <div class="col-8 fw-semibold text-dark">
                                    <span class="text-success fw-bold">Verified</span> · +91 ••••• 4821
                                </div>
                            </div>
                            <div class="row py-2 border-bottom">
                                <div class="col-4 text-muted">Profile photo</div>
                                <div class="col-8 fw-semibold text-warning">Awaiting review</div>
                            </div>
                        </div>

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

                        <!-- Admin Review & Notes -->
                        <div class="mb-4">
                            <label class="form-label fs-12 fw-bold text-dark">Admin review notes</label>
                            <input type="text" class="form-control fs-12 py-2 rounded-3"
                                placeholder="Add a reason or note for your decision..."
                                style="background-color: #FAF7F7; border: 1px solid #ECD9DF;">
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap justify-content-end gap-2 pt-2 border-top">
                            <button type="button"
                                class="btn btn-sm btn-danger-subtle text-danger fw-semibold px-3 py-2 border border-danger-subtle rounded-3">
                                Reject with reason
                            </button>
                            <button type="button"
                                class="btn btn-sm btn-warning-subtle text-warning-emphasis fw-semibold px-3 py-2 border border-warning-subtle rounded-3">
                                Request update
                            </button>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #561325;">
                                Approve profile
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection