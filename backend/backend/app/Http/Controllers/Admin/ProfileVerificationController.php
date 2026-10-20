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
     */
    public function index(Request $request)
    {
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

        $query = DB::table('profiles as p')
            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
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

        $profiles = $status === 'all'
            ? $query->get()
            : $query->paginate(10)->appends($request->query());

        $selectedProfile = null;
        $education = collect();
        $occupation = null;
        $photos = collect();

        if ($status !== 'all' && $request->filled('id')) {
            $selectedProfile = DB::table('profiles as p')
                ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
                ->select(
                    'p.*',
                    'u.name as user_name',
                    'u.email as user_email',
                    'u.phone as user_phone'
                )
                ->where('p.id', $request->query('id'))
                ->first();
        }

        if (!$selectedProfile && $status !== 'all') {
            $selectedProfile = DB::table('profiles as p')
                ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
                ->select(
                    'p.*',
                    'u.name as user_name',
                    'u.email as user_email',
                    'u.phone as user_phone'
                )
                ->when($status !== 'all', function ($q) use ($status) {
                    $q->where('p.verification_status', $status);
                })
                ->orderByRaw("
                    CASE
                        WHEN p.verification_status = 'pending' THEN 0
                        ELSE 1
                    END
                ")
                ->orderByDesc('p.id')
                ->first();
        }

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

        $counts = [
            'pending' => DB::table('profiles')
                ->where('verification_status', 'pending')
                ->count(),

            'approved' => DB::table('profiles')
                ->where('verification_status', 'approved')
                ->count(),

            'rejected' => DB::table('profiles')
                ->where('verification_status', 'rejected')
                ->count(),

            'update_requested' => DB::table('profiles')
                ->where('verification_status', 'update_requested')
                ->count(),
        ];

        return view('admin.profile', compact(
            'profiles',
            'selectedProfile',
            'education',
            'occupation',
            'photos',
            'status',
            'search',
            'counts'
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
                    in_array($request->input('decision'), [
                        'rejected',
                        'update_requested',
                    ], true)
                ),
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $profile = DB::table('profiles')
            ->where('id', $id)
            ->first();

        if (!$profile) {
            return redirect()
                ->route('admin.profile-verification.index')
                ->with('error', 'Profile not found.');
        }

        DB::table('profiles')
            ->where('id', $id)
            ->update([
                'verification_status' => $validated['decision'],
                'review_notes' => $validated['review_notes'] ?? null,

                // Set this only if your admin login stores the admin ID
                // in the session under "admin_id".
                'reviewed_by' => session('admin_id'),

                'reviewed_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.profile-verification.index', [
                'status' => $validated['decision'],
                'id' => $id,
            ])
            ->with('success', 'Profile verification decision saved successfully.');
    }
}
