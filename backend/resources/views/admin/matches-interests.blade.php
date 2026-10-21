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
                        <h3 class="fw-bold mb-1" style="color: #561325;">Matches &amp; Interests</h3>
                        <p class="text-muted mb-0 fs-13">Monitor interest requests, matches and member safety.</p>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-sm btn-white border rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px; background-color: #fff;">
                            <i class="ti ti-bell fs-16 text-muted"></i>
                        </button>
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold fs-12 shadow-sm" style="background-color: #561325; width: 34px; height: 34px;">
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
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-3">
                                <div class="text-muted fs-12 mb-1">Interest requests</div>
                                <h3 class="fw-bold mb-0" style="color: #561325;">{{ number_format($totalInterests) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-3">
                                <div class="text-muted fs-12 mb-1">Awaiting response</div>
                                <h3 class="fw-bold mb-0 text-dark">{{ number_format($awaitingCount) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-3">
                                <div class="text-muted fs-12 mb-1">Mutual interests</div>
                                <h3 class="fw-bold mb-0 text-dark">{{ number_format($mutualCount) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="border: 1px solid #F3E5E8 !important;">
                            <div class="card-body p-3">
                                <div class="text-muted fs-12 mb-1">Reported profiles</div>
                                <h3 class="fw-bold mb-0 text-dark">{{ number_format($reportedCount) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter & Search Bar -->
                <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                    <div class="card-body p-3">
                        <form method="GET" action="{{ route('admin.matches-interests') }}">
                            <div class="row g-2 align-items-center justify-content-between">
                                <div class="col-xl-4 col-md-5 col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                            <i class="ti ti-search fs-14"></i>
                                        </span>
                                        <input type="text" name="search" value="{{ $search }}" class="form-control border-start-0 ps-1 fs-13" placeholder="Search Request ID or Member ID">
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <select name="status" class="form-select fs-13 text-secondary border" onchange="this.form.submit()">
                                        <option value="" {{ $status === '' ? 'selected' : '' }}>All statuses</option>
                                        <option value="Awaiting" {{ $status === 'Awaiting' ? 'selected' : '' }}>Awaiting</option>
                                        <option value="Accepted" {{ $status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="Reported" {{ $status === 'Reported' ? 'selected' : '' }}>Reported</option>
                                    </select>
                                </div>

                                <div class="col-xl-3 col-md-3 col-sm-6 text-sm-end text-start">
                                    <button type="submit" class="btn btn-sm text-nowrap text-white fw-semibold px-3 py-2 rounded-3 shadow-sm" style="background-color: #561325;">
                                        Search <i class="ti ti-search ms-1 fs-12"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Interest Activity Table Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4" style="border: 1px solid #F3E5E8 !important;">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                        <h5 class="fw-bold mb-1" style="color: #561325;">Interest Activity</h5>
                        <p class="text-muted fs-12 mb-0">Track request status and investigate reports with appropriate privacy controls.</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover">
                            <thead style="background-color: #FCF7F8; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">
                                <tr style="color: #561325;">
                                    <th class="ps-4 py-3">REQUEST ID</th>
                                    <th class="py-3">MEMBER PAIR</th>
                                    <th class="py-3">DATE</th>
                                    <th class="py-3">STATUS</th>
                                    <th class="text-center pe-4 py-3">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="fs-13">
                                @forelse($activities as $item)
                                    @php
                                        $displayStatus = $item->status === 'Pending' ? 'Awaiting' : $item->status;
                                        $badgeClass = match ($displayStatus) {
                                            'Awaiting' => 'bg-warning-subtle text-warning border border-warning-subtle',
                                            'Accepted' => 'bg-success-subtle text-success border border-success-subtle',
                                            'Rejected' => 'bg-secondary-subtle text-secondary border border-secondary-subtle',
                                            default => 'bg-danger-subtle text-danger border border-danger-subtle',
                                        };
                                    @endphp

                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark">
                                            IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">
                                                {{ $item->sender_name ?? 'Unknown Member' }}
                                                <span class="text-muted mx-1">&rarr;</span>
                                                {{ $item->receiver_name ?? 'Unknown Member' }}
                                            </div>
                                            <div class="small text-muted mt-1">
                                                Member IDs: {{ $item->sender_id ?? '-' }} &rarr; {{ $item->receiver_id ?? '-' }}
                                            </div>
                                            <div class="small text-secondary mt-1">
                                                Sender Profile: {{ $item->sender_profile_id ?? 'Not linked' }}
                                            </div>
                                            <div class="small text-secondary">
                                                Receiver Profile: {{ $item->receiver_profile_id ?? 'Not linked' }}
                                            </div>
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : '-' }}
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill px-2 py-1 fs-11 {{ $badgeClass }}">
                                                {{ $displayStatus }}
                                            </span>
                                        </td>
                                        <td class="text-center pe-4">
                                            <div class="d-inline-flex gap-1">
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}" title="View details">
                                                    <i class="ti ti-eye"></i> View
                                                </button>

                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit status">
                                                    <i class="ti ti-edit"></i> Edit
                                                </button>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.matches-interests.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this interest request?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete request">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">No activity records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="p-3">
                        {{ $activities->links() }}
                    </div>
                </div>

            </div>
        </div>

        <!-- Modals for View and Edit -->
        @foreach($activities as $item)
            @php
                $displayStatus = $item->status === 'Pending' ? 'Awaiting' : $item->status;
            @endphp

            <!-- View Modal -->
            <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header px-4 pt-4 pb-3" style="border-bottom: 1px solid #f0e3e7;">
                            <h5 class="modal-title fw-bold" style="color: #561325;">Interest Details: IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-4 py-4 fs-13">
                            <p><strong>Request ID:</strong> IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</p>
                            <p><strong>Sender:</strong> {{ $item->sender_name ?? 'Unknown' }} (ID: {{ $item->sender_id }})</p>
                            <p><strong>Sender Profile ID:</strong> {{ $item->sender_profile_id ?? 'Not linked' }}</p>
                            <p><strong>Receiver:</strong> {{ $item->receiver_name ?? 'Unknown' }} (ID: {{ $item->receiver_id }})</p>
                            <p><strong>Receiver Profile ID:</strong> {{ $item->receiver_profile_id ?? 'Not linked' }}</p>
                            <p><strong>Status:</strong> {{ $displayStatus }}</p>
                            <p><strong>Date Submitted:</strong> {{ $item->created_at }}</p>
                        </div>
                        <div class="modal-footer px-4 py-3">
                            <button type="button" class="btn btn-secondary btn-sm px-4 rounded-3" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 rounded-4 shadow">
                        <div class="modal-header px-4 pt-4 pb-3" style="border-bottom: 1px solid #f0e3e7;">
                            <h5 class="modal-title fw-bold" style="color: #561325;">Edit Status: IN-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.matches-interests.update', $item->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-body px-4 py-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Interest Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="Pending" {{ $item->status === 'Pending' ? 'selected' : '' }}>Awaiting (Pending)</option>
                                        <option value="Accepted" {{ $item->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Rejected" {{ $item->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        <option value="Reported" {{ $item->status === 'Reported' ? 'selected' : '' }}>Reported</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer px-4 py-3">
                                <button type="button" class="btn btn-light border rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn text-white fw-semibold rounded-3 px-4" style="background-color: #561325;">Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
@endsection