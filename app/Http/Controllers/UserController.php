<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    private $statusToString = [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Suspended',
        3 => 'Review',
    ];

    private $stringToStatus = [
        'Pending' => 0,
        'Active' => 1,
        'Suspended' => 2,
        'Review' => 3,
    ];

    public function userindex(Request $request)
    {
        $usersData = User::latest()->get()->map(function ($u) {
            $statusLabel = is_numeric($u->status)
                ? ($this->statusToString[(int) $u->status] ?? 'Active')
                : ($u->status ?? 'Active');

            return [
                'db_id' => $u->id,
                'id' => $u->member_id ?? ('TM-' . $u->id),
                'name' => $u->name,
                'gender' => $u->gender ?? '',
                'age' => $u->age ?? '',
                'city' => $u->city ?? '',
                'status' => $statusLabel,
                'plan' => $u->plan ?? 'Free',
            ];
        });

        $counts = [
            'all' => User::count(),
            'active' => User::where('status', 1)->orWhere('status', 'Active')->count(),
            'pending' => User::where('status', 0)->orWhere('status', 'Pending')->count(),
            'suspended' => User::where('status', 2)->orWhere('status', 'Suspended')->count(),
        ];

        return view('management', compact('usersData', 'counts'));
    }

    public function userstore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'age' => 'required|integer|min:18|max:100',
            'city' => 'required|string|max:100',
            'status' => 'required|in:Active,Pending,Review,Suspended',
            'plan' => 'required|in:Free,Premium',
        ]);

        do {
            $memberId = 'TM-' . mt_rand(10000, 99999);
        } while (User::where('member_id', $memberId)->exists());

        $statusInt = $this->stringToStatus[$validated['status']] ?? 1;

        $user = User::create([
            'member_id' => $memberId,
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'city' => $validated['city'],
            'status' => $statusInt,
            'plan' => $validated['plan'],
            'role' => 'user',
            'email' => Str::slug($validated['name']) . rand(100, 999) . '@example.com',
            'password' => Hash::make('12345678'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User saved successfully!',
            'data' => [
                'db_id' => $user->id,
                'member_id' => $user->member_id,
                'name' => $user->name,
                'gender' => $user->gender,
                'age' => $user->age,
                'city' => $user->city,
                'status' => $validated['status'],
                'plan' => $user->plan,
            ],
        ]);
    }

    public function userupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'age' => 'required|integer|min:18|max:100',
            'city' => 'required|string|max:100',
            'status' => 'required|in:Active,Pending,Review,Suspended',
            'plan' => 'required|in:Free,Premium',
        ]);

        $user = User::findOrFail($id);
        $statusInt = $this->stringToStatus[$validated['status']] ?? 1;

        $user->update([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'city' => $validated['city'],
            'status' => $statusInt,
            'plan' => $validated['plan'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully!',
            'data' => [
                'db_id' => $user->id,
                'member_id' => $user->member_id ?? ('TM-' . $user->id),
                'name' => $user->name,
                'gender' => $user->gender,
                'age' => $user->age,
                'city' => $user->city,
                'status' => $validated['status'],
                'plan' => $user->plan,
            ],
        ]);
    }

    public function userdestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully!',
        ]);
    }

    public function userexport(Request $request)
    {
        $query = User::query();

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('status')) {
            $statusVal = $this->stringToStatus[$request->status] ?? $request->status;
            $query->where('status', $statusVal);
        }
        if ($request->filled('plan')) {
            $query->where('plan', $request->plan);
        }

        $fileName = 'users_' . date('Y-m-d_H-i-s') . '.csv';

        return new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Member ID', 'Name', 'Gender', 'Age', 'City', 'Status', 'Plan', 'Created At']);

            $query->chunk(500, function ($users) use ($handle) {
                foreach ($users as $user) {
                    $statusLabel = is_numeric($user->status)
                        ? ($this->statusToString[(int) $user->status] ?? 'Active')
                        : ($user->status ?? 'Active');

                    fputcsv($handle, [
                        $user->member_id ?? ('TM-' . $user->id),
                        $user->name,
                        $user->gender ?? 'N/A',
                        $user->age ?? 'N/A',
                        $user->city ?? 'N/A',
                        $statusLabel,
                        $user->plan,
                        $user->created_at ? $user->created_at->format('Y-m-d H:i') : '',
                    ]);
                }
            });

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ]);
    }
}