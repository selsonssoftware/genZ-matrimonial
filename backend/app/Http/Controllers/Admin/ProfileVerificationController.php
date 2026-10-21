<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProfileVerificationController extends Controller
{
    /**
     * Profile Verification page.
     * Groom and Bride profiles are filtered separately.
     */
    public function index(Request $request)
    {
        // Profile type: groom or bride
        $type = strtolower($request->query('type', 'groom'));

        if (!in_array($type, ['groom', 'bride'], true)) {
            abort(404, 'Invalid profile type.');
        }

        // Support multiple database gender formats ('male'/'female' or 'groom'/'bride')
        $genderValues = $type === 'groom' ? ['male', 'groom'] : ['female', 'bride'];

        $status = $request->query('status', 'pending');
        $search = trim($request->query('search', ''));

        $allowedStatuses = [
            'pending',
            'approved',
            'rejected',
            'update_requested',
            'all',
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            $status = 'pending';
        }

        /*
         * Reusable profile query with robust gender filtering.
         */
        $baseQuery = function () use ($genderValues) {
            return DB::table('profiles as p')
                ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
                ->where(function ($q) use ($genderValues) {
                    foreach ($genderValues as $gender) {
                        $q->orWhereRaw('LOWER(TRIM(p.gender)) = ?', [strtolower($gender)]);
                    }
                });
        };

        /*
         * Profile list query for the current status tab.
         */
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
                    ->whereColumn('pp.profile_id', 'p.profile_id')
                    ->orderByDesc('pp.is_primary')
                    ->orderByDesc('pp.id')
                    ->limit(1),
            ]);

        if ($status !== 'all') {
            $query->where('p.verification_status', $status);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('p.profile_id', 'like', "%{$search}%")
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

        // Fetch paginated profiles for all tabs so the table always displays!
        $profiles = $query->paginate(10)->appends($request->query());

        /*
         * Selected profile and related details.
         */
        $selectedProfile = null;
        $education = collect();
        $occupation = null;
        $photos = collect();

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

        /*
         * If no profile was explicitly selected, default to the first profile in the list.
         */
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

        /*
         * Education, occupation and photos for the selected profile.
         */
        if ($selectedProfile) {
            $education = DB::table('education_details')
                ->where('profile_id', $selectedProfile->profile_id)
                ->orderByDesc('id')
                ->get();

            $occupation = DB::table('occupation_details')
                ->where('profile_id', $selectedProfile->profile_id)
                ->orderByDesc('id')
                ->first();

            $photos = DB::table('profile_photos')
                ->where('profile_id', $selectedProfile->profile_id)
                ->orderByDesc('is_primary')
                ->orderByDesc('id')
                ->get();
        }

        /*
         * Verification counts for the current gender/type only.
         */
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

        return view('admin.profile', compact(
            'profiles',
            'selectedProfile',
            'education',
            'occupation',
            'photos',
            'status',
            'search',
            'counts',
            'type'
        ));
    }

    /**
     * Approve, reject, or request profile updates.
     */
    public function review(Request $request, $id)
    {
        $validated = $request->validate([
            'decision' => [
                'required',
                Rule::in([
                    'approved',
                    'rejected',
                    'update_requested',
                ]),
            ],

            'review_notes' => [
                Rule::requiredIf(
                    in_array(
                        $request->input('decision'),
                        ['rejected', 'update_requested'],
                        true
                    )
                ),
                'nullable',
                'string',
                'max:5000',
            ],

            'type' => [
                'required',
                Rule::in(['groom', 'bride']),
            ],
        ]);

        $type = $validated['type'];
        $genderValues = $type === 'groom' ? ['male', 'groom'] : ['female', 'bride'];

        $profileQuery = DB::table('profiles')
            ->where('id', $id)
            ->where(function ($q) use ($genderValues) {
                foreach ($genderValues as $gender) {
                    $q->orWhereRaw('LOWER(TRIM(gender)) = ?', [strtolower($gender)]);
                }
            });

        $profile = $profileQuery->first();

        if (!$profile) {
            return redirect()
                ->route('admin.profile-verification.index', [
                    'type' => $type,
                ])
                ->with('error', 'Profile not found in this section.');
        }

        $profileQuery->update([
            'verification_status' => $validated['decision'],
            'review_notes' => $validated['review_notes'] ?? null,
            'reviewed_by' => session('admin_id'),
            'reviewed_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.profile-verification.index', [
                'type' => $type,
                'status' => $validated['decision'],
                'id' => $id,
            ])
            ->with(
                'success',
                'Profile verification decision saved successfully.'
            );
    }
}