<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MatchesInterestsController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $status = trim($request->query('status', ''));

        // KPI counts - actual database values
        $totalInterests = DB::table('interests')->count();

        $awaitingCount = DB::table('interests')
            ->where('status', 'Pending')
            ->count();

        $mutualCount = DB::table('interests')
            ->where('status', 'Accepted')
            ->count();

        // Reported count (set to 0 or query from your reports table if available)
        $reportedCount = DB::table('interests')->where('status', 'Reported')->count();

        // Interest activity query with joins
        $query = DB::table('interests')
            ->leftJoin('users as sender', 'interests.sender_id', '=', 'sender.id')
            ->leftJoin('users as receiver', 'interests.receiver_id', '=', 'receiver.id')
            ->leftJoin('profiles as sender_profile', 'sender.id', '=', 'sender_profile.user_id')
            ->leftJoin('profiles as receiver_profile', 'receiver.id', '=', 'receiver_profile.user_id')
            ->select(
                'interests.id',
                'interests.user_id',
                'interests.profile_id',
                'interests.sender_id',
                'interests.receiver_id',
                'sender.name as sender_name',
                'receiver.name as receiver_name',
                'sender_profile.profile_id as sender_profile_id',
                'receiver_profile.profile_id as receiver_profile_id',
                'interests.status',
                'interests.created_at'
            );

        // Search by request ID, profile ID, sender ID, receiver ID, or names
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('interests.profile_id', 'like', "%{$search}%")
                    ->orWhere('interests.sender_id', 'like', "%{$search}%")
                    ->orWhere('interests.receiver_id', 'like', "%{$search}%")
                    ->orWhere('sender.name', 'like', "%{$search}%")
                    ->orWhere('receiver.name', 'like', "%{$search}%");

                // IN-00001 format request ID search
                $requestId = preg_replace('/^IN-0*/i', '', $search);
                if ($requestId !== '' && ctype_digit($requestId)) {
                    $q->orWhere('interests.id', (int) $requestId);
                }
            });
        }

        // Status filters
        if ($status === 'Awaiting') {
            $query->where('interests.status', 'Pending');
        } elseif (in_array($status, ['Accepted', 'Rejected', 'Reported'], true)) {
            $query->where('interests.status', $status);
        }

        $activities = $query
            ->orderByDesc('interests.created_at')
            ->get();

        return view('admin.matches-interests', compact(
            'activities',
            'totalInterests',
            'awaitingCount',
            'mutualCount',
            'reportedCount',
            'search',
            'status'
        ));
    }

    // Update interest request status
    public function update(Request $request, $id)
    {
        $interest = DB::table('interests')->where('id', $id)->first();
        if (!$interest) {
            return redirect()->route('admin.matches-interests')->withErrors(['error' => 'Interest request not found.']);
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['Pending', 'Accepted', 'Rejected', 'Reported'])],
        ]);

        DB::table('interests')->where('id', $id)->update([
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.matches-interests')
            ->with('success', 'Interest request status updated successfully.');
    }

    // Delete interest request
    public function destroy($id)
    {
        $interest = DB::table('interests')->where('id', $id)->first();
        if (!$interest) {
            return redirect()->route('admin.matches-interests')->withErrors(['error' => 'Interest request not found.']);
        }

        DB::table('interests')->where('id', $id)->delete();

        return redirect()
            ->route('admin.matches-interests')
            ->with('success', 'Interest request deleted successfully.');
    }
}