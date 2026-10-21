@extends('layout')

@section('content')

<div class="content-page">
    <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Vendor Assignment Report</h3>
            <p class="text-muted mb-0">
                Check which profiles are assigned to each vendor.
            </p>
        </div>

        <a href="{{ route('admin.vendors.index') }}"
           class="btn btn-outline-secondary">
            Back to Vendors
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle js-data-table" data-paging="false">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Vendor ID</th>
                            <th>Vendor Name</th>
                            <th>Vendor City</th>
                            <th>Profile ID</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Profile City</th>
                            <th>Assigned Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td>{{ $assignments->firstItem() + $loop->index }}</td>

                                <td>{{ $assignment->vendor_id }}</td>

                                <td>
                                    {{ $assignment->agent_name }}
                                </td>

                                <td>
                                    {{ $assignment->vendor_city ?? '-' }}
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $assignment->profile_id }}
                                    </span>
                                </td>

                                <td>
                                    {{ $assignment->gender ?? '-' }}
                                </td>

                                <td>
                                    {{ $assignment->age ?? '-' }}
                                </td>

                                <td>
                                    {{ $assignment->profile_city ?? '-' }}
                                </td>

                                <td>
                                    {{ $assignment->assigned_at
                                        ? \Carbon\Carbon::parse($assignment->assigned_at)->format('d-m-Y h:i A')
                                        : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <h6 class="text-muted mb-1">
                                        No profile assignments found
                                    </h6>
                                    <p class="text-muted mb-3">
                                        Assigned profiles will appear here.
                                    </p>
                                    <a href="{{ route('admin.vendors.index') }}"
                                       class="btn btn-primary btn-sm">
                                        Go to Vendor Management
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $assignments->links() }}
            </div>

        </div>
    </div>

    </div>
</div>

@endsection
