@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

            <!-- Header Section -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Matrimony Master Data</h3>
                    <p class="text-muted mb-0 fs-13">Configure profile options and search filters used across the platform.
                    </p>
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

            <!-- Profile Configuration Outer Wrapper Card -->
            <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4" style="border: 1px solid #F3E5E8 !important;">

                <span class="text-muted fs-12 fw-medium mb-2 d-block">Profile configuration</span>

                <!-- Navigation Tabs Pills -->
                <div class="card border-0 rounded-4 mb-4"
                    style="background-color: #FAF5F5; border: 1px solid #F3E5E8 !important;">
                    <div class="card-body p-2">
                        <ul class="nav nav-pills nav-justified fs-13 fw-semibold flex-nowrap overflow-auto"
                            id="masterDataTabs" role="tablist">
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link active rounded-3 py-2 px-3 fw-bold tab-pill-btn" id="religion-tab"
                                    data-bs-toggle="pill" data-bs-target="#religion-pane" type="button" role="tab">
                                    Religion
                                </button>
                            </li>
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link text-muted rounded-3 py-2 px-3 tab-pill-btn" id="community-tab"
                                    data-bs-toggle="pill" data-bs-target="#community-pane" type="button" role="tab">
                                    Community
                                </button>
                            </li>
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link text-muted rounded-3 py-2 px-3 tab-pill-btn" id="language-tab"
                                    data-bs-toggle="pill" data-bs-target="#language-pane" type="button" role="tab">
                                    Mother Tongue
                                </button>
                            </li>
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link text-muted rounded-3 py-2 px-3 tab-pill-btn" id="education-tab"
                                    data-bs-toggle="pill" data-bs-target="#education-pane" type="button" role="tab">
                                    Education
                                </button>
                            </li>
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link text-muted rounded-3 py-2 px-3 tab-pill-btn" id="occupation-tab"
                                    data-bs-toggle="pill" data-bs-target="#occupation-pane" type="button" role="tab">
                                    Occupation
                                </button>
                            </li>
                            <li class="nav-item text-nowrap" role="presentation">
                                <button class="nav-link text-muted rounded-3 py-2 px-3 tab-pill-btn" id="location-tab"
                                    data-bs-toggle="pill" data-bs-target="#location-pane" type="button" role="tab">
                                    Location
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab Content Area -->
                <div class="tab-content" id="masterDataTabContent">

                    <!-- 1. Religion Tab Pane -->
                    <div class="tab-pane fade show active" id="religion-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Religion Options</h5>
                                <p class="text-muted fs-12 mb-0">Database-backed values used in member profiles and partner
                                    preferences.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">REL-001</td>
                                        <td class="text-dark">Hindu</td>
                                        <td>Active</td>
                                        <td class="text-dark">8,240</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">REL-002</td>
                                        <td class="text-dark">Christian</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,920</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">REL-003</td>
                                        <td class="text-dark">Muslim</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,780</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">REL-004</td>
                                        <td class="text-dark">Jain</td>
                                        <td>Active</td>
                                        <td class="text-dark">420</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">REL-005</td>
                                        <td class="text-dark">Other / Prefer not to say</td>
                                        <td>Active</td>
                                        <td class="text-dark">480</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Admin Tip Box -->
                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                Use configurable lookup tables instead of hard-coding profile choices in templates.
                            </p>
                        </div>
                    </div>

                    <!-- 2. Community Tab Pane -->
                    <div class="tab-pane fade" id="community-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Community & Caste Options</h5>
                                <p class="text-muted fs-12 mb-0">Manage community lists, sub-castes, and gothram lookup
                                    configurations.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">COM-001</td>
                                        <td class="text-dark">Reddy</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,840</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">COM-002</td>
                                        <td class="text-dark">Vanniyar</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,410</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">COM-003</td>
                                        <td class="text-dark">Mudaliar</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,950</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">COM-004</td>
                                        <td class="text-dark">Brahmin</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,120</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">COM-005</td>
                                        <td class="text-dark">Nadar</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,480</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                Community codes can be linked to sub-sect selections to streamline candidate profile
                                registration.
                            </p>
                        </div>
                    </div>

                    <!-- 3. Mother Tongue Tab Pane -->
                    <div class="tab-pane fade" id="language-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Mother Tongue Options</h5>
                                <p class="text-muted fs-12 mb-0">Languages used to match linguistic compatibility and search
                                    filters.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LNG-001</td>
                                        <td class="text-dark">Tamil</td>
                                        <td>Active</td>
                                        <td class="text-dark">7,620</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LNG-002</td>
                                        <td class="text-dark">Telugu</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,310</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LNG-003</td>
                                        <td class="text-dark">Malayalam</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,450</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LNG-004</td>
                                        <td class="text-dark">Kannada</td>
                                        <td>Active</td>
                                        <td class="text-dark">980</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LNG-005</td>
                                        <td class="text-dark">Hindi</td>
                                        <td>Active</td>
                                        <td class="text-dark">480</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                You can configure primary mother tongue alongside secondary spoken languages in the
                                candidate preference engine.
                            </p>
                        </div>
                    </div>

                    <!-- 4. Education Tab Pane -->
                    <div class="tab-pane fade" id="education-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Education Qualifications</h5>
                                <p class="text-muted fs-12 mb-0">Highest degree and qualification levels selectable by
                                    matrimony candidates.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">EDU-001</td>
                                        <td class="text-dark">B.E. / B.Tech (Engineering)</td>
                                        <td>Active</td>
                                        <td class="text-dark">4,520</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">EDU-002</td>
                                        <td class="text-dark">M.S. / M.Tech / Post Graduate</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,890</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">EDU-003</td>
                                        <td class="text-dark">MBBS / MD / Medical</td>
                                        <td>Active</td>
                                        <td class="text-dark">870</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">EDU-004</td>
                                        <td class="text-dark">MBA / PGDM (Management)</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,140</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">EDU-005</td>
                                        <td class="text-dark">B.Com / B.Sc / Arts & Science</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,420</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                Degree streams can be grouped into broad education filters (e.g., Engineering, Medicine,
                                Management) for search efficiency.
                            </p>
                        </div>
                    </div>

                    <!-- 5. Occupation Tab Pane -->
                    <div class="tab-pane fade" id="occupation-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Occupation Options</h5>
                                <p class="text-muted fs-12 mb-0">Professional sectors, roles, and job domain
                                    classifications.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">OCC-001</td>
                                        <td class="text-dark">Software Engineer / IT Professional</td>
                                        <td>Active</td>
                                        <td class="text-dark">5,140</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">OCC-002</td>
                                        <td class="text-dark">Doctor / Healthcare Professional</td>
                                        <td>Active</td>
                                        <td class="text-dark">940</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">OCC-003</td>
                                        <td class="text-dark">Chartered Accountant / Finance</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,260</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">OCC-004</td>
                                        <td class="text-dark">Civil Services / Govt. Officer</td>
                                        <td>Active</td>
                                        <td class="text-dark">680</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">OCC-005</td>
                                        <td class="text-dark">Business / Entrepreneur</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,320</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                Ensure occupation choices align with annual income bracket filtering for accurate matrimony
                                matching.
                            </p>
                        </div>
                    </div>

                    <!-- 6. Location Tab Pane -->
                    <div class="tab-pane fade" id="location-pane" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div>
                                <h5 class="fw-bold mb-1" style="color: #561325;">Location & City Options</h5>
                                <p class="text-muted fs-12 mb-0">Predefined districts, major cities, and international
                                    regional hubs.</p>
                            </div>
                            <button type="button" class="btn btn-sm text-white fw-semibold px-4 py-2 rounded-3 shadow-sm"
                                style="background-color: #6A1B29;" data-bs-toggle="modal" data-bs-target="#addOptionModal">
                                + Add option
                            </button>
                        </div>

                        <div class="table-responsive rounded-3 mb-4" style="border: 1px solid #F3E5E8;">
                            <table class="table align-middle mb-0 table-hover">
                                <thead
                                    style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                    <tr style="color: #561325;">
                                        <th class="ps-4 py-3">CODE</th>
                                        <th class="py-3">DISPLAY LABEL</th>
                                        <th class="py-3">STATUS</th>
                                        <th class="py-3">PROFILES USING</th>
                                        <th class="pe-4 py-3">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-13">
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LOC-001</td>
                                        <td class="text-dark">Chennai, Tamil Nadu</td>
                                        <td>Active</td>
                                        <td class="text-dark">5,620</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LOC-002</td>
                                        <td class="text-dark">Coimbatore, Tamil Nadu</td>
                                        <td>Active</td>
                                        <td class="text-dark">2,840</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LOC-003</td>
                                        <td class="text-dark">Bengaluru, Karnataka</td>
                                        <td>Active</td>
                                        <td class="text-dark">3,120</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LOC-004</td>
                                        <td class="text-dark">Madurai, Tamil Nadu</td>
                                        <td>Active</td>
                                        <td class="text-dark">1,780</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">LOC-005</td>
                                        <td class="text-dark">USA / International NRI</td>
                                        <td>Active</td>
                                        <td class="text-dark">940</td>
                                        <td class="pe-4">
                                            <a href="javascript:void(0);"
                                                class="text-dark fw-medium text-decoration-none me-2">Edit</a>
                                            <span class="text-muted">·</span>
                                            <a href="javascript:void(0);"
                                                class="text-muted text-decoration-none ms-2">Disable</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-3 rounded-3" style="background-color: #FFF9EE; border: 1px solid #F5E6CC;">
                            <h6 class="fw-bold mb-1 fs-12" style="color: #8D6718;">Admin tip</h6>
                            <p class="fs-12 mb-0" style="color: #9C7524;">
                                You can configure NRI/Overseas flags on specific locations to highlight international member
                                profiles.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
            <!-- end card wrapper -->

            <!-- Add Option Modal -->
            <div class="modal fade" id="addOptionModal" tabindex="-1" aria-labelledby="addOptionModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header border-bottom-0 pb-0 px-4 pt-4">
                            <h5 class="modal-title fw-bold" id="addOptionModalLabel" style="color: #561325;">Add Lookup
                                Option</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="addOptionForm">
                            <div class="modal-body px-4">
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Target Category</label>
                                    <select class="form-select fs-13" id="optionCategory" required>
                                        <option value="Religion">Religion</option>
                                        <option value="Community">Community</option>
                                        <option value="Language">Mother Tongue</option>
                                        <option value="Education">Education</option>
                                        <option value="Occupation">Occupation</option>
                                        <option value="Location">Location</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Option Code</label>
                                    <input type="text" class="form-control fs-13" placeholder="e.g. REL-006 or COM-006"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Display Label</label>
                                    <input type="text" class="form-control fs-13"
                                        placeholder="e.g. Sikh or Electronics Engineer" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fs-13 fw-semibold">Status</label>
                                    <select class="form-select fs-13" required>
                                        <option value="Active" selected>Active</option>
                                        <option value="Disabled">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 px-4 pb-4">
                                <button type="button" class="btn btn-light fs-13" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn fs-13 text-white fw-semibold"
                                    style="background-color: #6A1B29;">Save Option</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->

        <!-- Footer -->
        <footer class="footer py-3 bg-white border-top">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start fs-12 text-muted">
                        ©
                        <script>document.write(new Date().getFullYear())</script> Thirumana Admin Console
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex justify-content-end gap-3 fs-12">
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Privacy Policy</a>
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Terms of Service</a>
                            <a href="javascript:void(0);" class="text-muted text-decoration-none">Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Script to handle Tab highlighting style -->
    <style>
        .tab-pill-btn.active {
            background-color: #FCECEE !important;
            color: #561325 !important;
            font-weight: 700 !important;
        }

        .tab-pill-btn:not(.active) {
            background-color: transparent !important;
            color: #6c757d !important;
        }
    </style>
@endsection