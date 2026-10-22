@extends('layout')

@section('content')
    <div class="content-page">
        <div class="container-fluid py-4 px-4" style="background-color: #FAF5F5; min-height: 100vh;">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3 class="fw-bold mb-1" style="color: #561325;">Member Profile Details</h3>
                    <p class="text-muted mb-0 fs-13">Viewing full details for {{ $user->name }}
                        ({{ $user->member_id ?? 'TM-' . $user->id }})</p>
                </div>
                <button type="button" onclick="window.close()" class="btn btn-sm btn-secondary">Close Tab</button>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white" style="border: 1px solid #F3E5E8 !important;">
                <div class="row g-4">
                    @php
                        $fields = [
                            'ID' => $user->id,
                            'User ID' => $user->user_id ?? ($user->member_id ?? 'N/A'),
                            'Profile ID' => $profile->profile_id ?? 'N/A',
                            'Gender' => $user->gender,
                            'DOB' => $profile->dob ?? 'N/A',
                            'Age' => $user->age,
                            'Mobile Number' => $user->phone ?? 'N/A',
                            'Mother Name' => $profile->mother_name ?? ($profile->{'mother\'name'} ?? 'N/A'),
                            'Father Name' => $profile->father_name ?? ($profile->{'father\'s name'} ?? 'N/A'),
                            'Mother Occupation' => $profile->mother_occupation ?? 'N/A',
                            'Father Occupation' => $profile->father_occupation ?? 'N/A',
                            'Siblings Count' => $profile->siblings_count ?? 'N/A',
                            'Sibling Name' => $profile->sibling_name ?? 'N/A',
                            'Siblings Status' => $profile->siblings_status ?? 'N/A',
                            'Food Preference' => $profile->food ?? 'N/A',
                            'Height' => $profile->height ?? 'N/A',
                            'Weight' => $profile->weight ?? 'N/A',
                            'Marital Status' => $profile->marital_status ?? 'N/A',
                            'Religion' => $profile->religion ?? 'N/A',
                            'Caste' => $profile->caste ?? 'N/A',
                            'Community' => $profile->community ?? 'N/A',
                            'Mother Tongue' => $profile->mother_tongue ?? 'N/A',
                            'Country' => $profile->country ?? 'N/A',
                            'State' => $profile->state ?? 'N/A',
                            'City' => $user->city,
                            'Address' => $profile->address ?? 'N/A',
                            'About Me' => $profile->about_me ?? 'N/A',
                        ];
                    @endphp

                    @foreach($fields as $label => $value)
                        <div class="col-md-4 col-sm-6 col-12 border-bottom pb-2">
                            <span class="text-muted d-block fs-12 text-uppercase fw-semibold">{{ $label }}</span>
                            <span class="text-dark fw-medium fs-14">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection