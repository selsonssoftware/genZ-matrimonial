<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileVerificationController extends Controller
{
    public function index(Request $request)
    {
        $type = strtolower($request->query('type', 'groom'));

        if (!in_array($type, ['groom', 'bride'], true)) {
            abort(404, 'Invalid profile type.');
        }

        $genderValues = $type === 'groom' ? ['male', 'groom'] : ['female', 'bride'];

        $status = $request->query('status', 'all');
        $search = trim($request->query('search', ''));

        $allowedStatuses = [
            'pending',
            'approved',
            'rejected',
            'update_requested',
            'all',
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            $status = 'all';
        }

        $baseQuery = function () use ($genderValues) {
            return DB::table('profiles as p')
                ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
                ->where(function ($q) use ($genderValues) {
                    foreach ($genderValues as $gender) {
                        $q->orWhereRaw('LOWER(TRIM(p.gender)) = ?', [strtolower($gender)]);
                    }
                });
        };

        $isMysql = DB::connection()->getDriverName() === 'mysql';

        $query = $baseQuery()
            ->select(
                'p.*',
                'u.name as user_name',
                'u.email as user_email',
                'u.phone as user_phone'
            )
            ->addSelect([
                'profile_image' => DB::table('profile_photos as pp')
                    ->select('pp.image')
                    ->when($isMysql, function ($sub) {
                        return $sub->whereRaw('pp.profile_id COLLATE utf8mb4_general_ci = p.profile_id COLLATE utf8mb4_general_ci');
                    }, function ($sub) {
                        return $sub->whereColumn('pp.profile_id', 'p.profile_id');
                    })
                    ->orderByDesc('pp.is_primary')
                    ->orderByDesc('pp.id')
                    ->limit(1),

                'education' => DB::table('education_details as ed')
                    ->select('ed.qualification')
                    ->when($isMysql, function ($sub) {
                        return $sub->whereRaw('ed.profile_id COLLATE utf8mb4_general_ci = p.profile_id COLLATE utf8mb4_general_ci');
                    }, function ($sub) {
                        return $sub->whereColumn('ed.profile_id', 'p.profile_id');
                    })
                    ->orderByDesc('ed.id')
                    ->limit(1),

                'vendor_name' => DB::table('vendor_customer_assignments as vca')
                    ->join('vendor as v', 'v.id', '=', 'vca.vendor_id')
                    ->select('v.agent_name')
                    ->when($isMysql, function ($sub) {
                        return $sub->whereRaw('vca.profile_id COLLATE utf8mb4_general_ci = p.profile_id COLLATE utf8mb4_general_ci');
                    }, function ($sub) {
                        return $sub->whereColumn('vca.profile_id', 'p.profile_id');
                    })
                    ->limit(1),
            ]);

        if ($status !== 'all') {
            $query->where('p.verification_status', $status);
        }

        if ($search !== '') {
    $query->where(function ($q) use ($search) {
        $q->where('p.profile_id', 'like', "%{$search}%")
            ->orWhere('p.profile_name', 'like', "%{$search}%")
            ->orWhere('u.name', 'like', "%{$search}%")
            ->orWhere('u.email', 'like', "%{$search}%")
            ->orWhere('u.phone', 'like', "%{$search}%");
    });
}
        $query
            ->orderByRaw("
                CASE
                    WHEN p.verification_status = 'pending' THEN 0
                    ELSE 1
                END
            ")
            ->orderByDesc('p.id');

        $profiles = $query->paginate(10)->appends($request->query());

        $modalProfile = null;
        $modalEducationList = collect();
        $modalOccupation = null;
        $modalPhotos = collect();

        if ($request->filled('id')) {
            $selectedProfile = $baseQuery()
                ->select(
                    'p.*',
                    'u.name as user_name',
                    'u.email as user_email',
                    'u.phone as user_phone'
                )
                ->where('p.id', $request->query('id'))
                ->first();
        }

        if (!$selectedProfile && $profiles->isNotEmpty()) {
            $firstItem = $profiles->items()[0];
            $selectedProfile = $baseQuery()
                ->select(
                    'p.*',
                    'u.name as user_name',
                    'u.email as user_email',
                    'u.phone as user_phone'
                )
                ->where('p.id', $firstItem->id)
                ->first();
        }

        // Fetching full details for the selected profile safely (Fixed collation error here)
        if ($selectedProfile) {
            $safeProfileId = addslashes($selectedProfile->profile_id);

            $educationList = DB::table('education_details')
                ->when($isMysql, function ($sub) use ($safeProfileId) {
                    return $sub->whereRaw("profile_id COLLATE utf8mb4_general_ci = '{$safeProfileId}' COLLATE utf8mb4_general_ci");
                }, function ($sub) use ($selectedProfile) {
                    return $sub->where('profile_id', $selectedProfile->profile_id);
                })
                ->orderByDesc('id')
                ->get();

                $modalOccupation = DB::table('occupation_details')
                    ->when($isMysql, function ($sub) use ($safeProfileId) {
                        return $sub->whereRaw("profile_id COLLATE utf8mb4_general_ci = '{$safeProfileId}' COLLATE utf8mb4_general_ci");
                    }, function ($sub) use ($modalProfile) {
                        return $sub->where('profile_id', $modalProfile->profile_id);
                    })
                    ->orderByDesc('id')
                    ->first();

                $modalPhotos = DB::table('profile_photos')
                    ->when($isMysql, function ($sub) use ($safeProfileId) {
                        return $sub->whereRaw("profile_id COLLATE utf8mb4_general_ci = '{$safeProfileId}' COLLATE utf8mb4_general_ci");
                    }, function ($sub) use ($modalProfile) {
                        return $sub->where('profile_id', $modalProfile->profile_id);
                    })
                    ->orderByDesc('is_primary')
                    ->orderByDesc('id')
                    ->get();
            }
        }

        $counts = [];
        foreach ([
            'pending',
            'approved',
            'rejected',
            'update_requested',
        ] as $verificationStatus) {
            $counts[$verificationStatus] = $baseQuery()
                ->where('p.verification_status', $verificationStatus)
                ->count();
        }
        $counts['all'] = $baseQuery()->count();

        $vendors = DB::table('vendor')
    ->where('status', 'Active')
    ->orderBy('agent_name')
    ->get(['id', 'agent_name', 'vendor_mobile']);

        return view('admin.profile', compact(
            'profiles',
            'modalProfile',
            'modalEducationList',
            'modalOccupation',
            'modalPhotos',
            'status',
            'search',
            'counts',
            'type',
            'vendors'
        ));
    }

    public function review(Request $request, $id)
    {
        $validated = $request->validate([
            'decision' => [
                'required',
                Rule::in(['approved', 'rejected', 'update_requested']),
            ],
            'review_notes' => ['nullable', 'string', 'max:5000'],
            'type' => ['required', Rule::in(['groom', 'bride'])],
        ]);

        DB::table('profiles')->where('id', $id)->update([
            'verification_status' => $validated['decision'],
            'review_notes' => $validated['review_notes'] ?? null,
            'reviewed_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.profile-verification.index', [
            'type' => $validated['type'],
            'status' => $validated['decision'],
        ])->with('success', 'Profile verification decision saved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'marital_status' => ['required', 'string', 'max:50'],
            'religion' => ['required', 'string', 'max:50'],
            'caste' => ['required', 'string', 'max:50'],
            'type' => ['required', Rule::in(['groom', 'bride'])],
        ]);

        DB::table('profiles')->where('id', $id)->update([
            'city' => $validated['city'],
            'state' => $validated['state'],
            'marital_status' => $validated['marital_status'],
            'religion' => $validated['religion'],
            'caste' => $validated['caste'],
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.profile-verification.index', ['type' => $validated['type'], 'status' => request('status', 'all')])
            ->with('success', 'Profile details updated successfully.');
    }

    public function assignVendor(Request $request)
{
    $validated = $request->validate([
        'vendor_id'  => ['required', 'integer', 'exists:vendor,id'],
        'profile_ids' => ['required', 'string', 'max:10000'],
        'type' => ['required', Rule::in(['groom', 'bride'])],
        'status' => ['nullable', Rule::in([
            'all', 'pending', 'approved', 'rejected', 'update_requested'
        ])],
        'search' => ['nullable', 'string', 'max:255'],
    ]);

    $profileIds = preg_split(
        '/[\s,;]+/',
        trim($validated['profile_ids']),
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    $profileIds = array_values(array_unique($profileIds));

    if (empty($profileIds)) {
        return back()->withInput()->with('error', 'Enter at least one Profile ID.');
    }

    // Verify that every submitted Profile ID exists.
    $existingIds = DB::table('profiles')
        ->whereIn('profile_id', $profileIds)
        ->pluck('profile_id')
        ->map(fn ($id) => (string) $id)
        ->all();

    $invalidIds = array_values(array_diff($profileIds, $existingIds));

    if (!empty($invalidIds)) {
        return back()->withInput()->with(
            'error',
            'Profile ID(s) not found: ' . implode(', ', $invalidIds)
        );
    }

    // A profile already assigned to any vendor must not be assigned again.
    $alreadyAssigned = DB::table('vendor_customer_assignments')
        ->whereIn('profile_id', $profileIds)
        ->pluck('profile_id')
        ->map(fn ($id) => (string) $id)
        ->all();

    if (!empty($alreadyAssigned)) {
        return back()->withInput()->with(
            'error',
            'Already assigned Profile ID(s): ' . implode(', ', $alreadyAssigned)
        );
    }

    DB::transaction(function () use ($profileIds, $validated) {
        foreach ($profileIds as $profileId) {
            DB::table('vendor_customer_assignments')->insert([
                'vendor_id'  => $validated['vendor_id'],
                'profile_id' => $profileId,
                'assigned_at' => now(),
            ]);
        }
    });

    return redirect()
        ->route('admin.profile-verification.index', [
            'type' => $validated['type'],
            'status' => $validated['status'] ?? 'all',
            'search' => $validated['search'] ?? '',
        ])
        ->with(
            'success',
            count($profileIds) . ' profile(s) assigned successfully.'
        );
}

    public function destroy($id)
    {
        $profile = DB::table('profiles')->where('id', $id)->first();

        if ($profile) {
            DB::table('profiles')->where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Profile deleted successfully.');
    }
}