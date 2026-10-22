<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    private const STATUS_LABELS = [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Suspended',
        3 => 'Review',
    ];

    private const STATUS_VALUES = [
        'Pending' => 0,
        'Active' => 1,
        'Suspended' => 2,
        'Review' => 3,
    ];

    private function nonAdminUsers()
    {
        return User::query()->where(function ($query) {
            $query->whereNull('role')
                ->orWhereRaw('LOWER(role) <> ?', ['admin']);
        });
    }

    public function userindex()
    {
        $usersData = $this->nonAdminUsers()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get()
            ->map(fn(User $user) => $this->memberData($user))
            ->values();

        return view('admin.management', [
            'usersData' => $usersData,
            'counts' => $this->memberCounts(),
        ]);
    }

    public function userProfile(int $id)
    {
        $user = $this->nonAdminUsers()->findOrFail($id);

        $profile = null;
        if (Schema::hasTable('profiles')) {
            $profile = DB::table('profiles')
                ->where('user_id', $user->id)
                ->first();
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'profile' => $profile,
            ]);
        }

        return view('admin.user_profile', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function userstore(Request $request)
    {
        $request->merge(['email' => $this->normalizeEmail($request->input('email'))]);
        $validated = $request->validate($this->memberRules());

        $user = DB::transaction(function () use ($validated) {
            // US0001, US0002 లాగా ఆటోమేటిక్‌గా జనరేట్ అవ్వడానికి లాజిక్
            $latestUser = User::where('member_id', 'like', 'US%')->orderBy('id', 'desc')->first();

            if ($latestUser && preg_match('/US(\d+)/', $latestUser->member_id, $matches)) {
                $nextNumber = intval($matches[1]) + 1;
            } else {
                $nextNumber = 1;
            }

            $memberId = 'US' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            return User::create([
                'member_id' => $memberId,
                'name' => trim($validated['name']),
                'email' => mb_strtolower(trim($validated['email'])),
                'gender' => $validated['gender'],
                'phone' => $validated['phone'] ?? null,
                'age' => $validated['age'],
                'city' => trim($validated['city']),
                'status' => self::STATUS_VALUES[$validated['status']],
                'plan' => $validated['plan'],
                'role' => 'user',
                'password' => Hash::make(Str::random(64)),
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'User saved successfully.',
            'data' => $this->memberData($user),
            'counts' => $this->memberCounts(),
        ], 201);
    }

    public function userupdate(Request $request, int $id)
    {
        $user = $this->nonAdminUsers()->findOrFail($id);
        $request->merge(['email' => $this->normalizeEmail($request->input('email'))]);
        $validated = $request->validate($this->memberRules($user->id));

        $user->update([
            'name' => trim($validated['name']),
            'email' => mb_strtolower(trim($validated['email'])),
            'gender' => $validated['gender'],
            'age' => $validated['age'],
            'phone' => $validated['phone'] ?? null,
            'city' => trim($validated['city']),
            'status' => self::STATUS_VALUES[$validated['status']],
            'plan' => $validated['plan'],
        ]);
        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully.',
            'data' => $this->memberData($user),
            'counts' => $this->memberCounts(),
        ]);
    }

    public function userdestroy(int $id)
    {
        $user = $this->nonAdminUsers()->findOrFail($id);

        if ($this->hasRelatedRecords($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'This member has profile or activity records. Suspend the account instead to preserve its history.',
            ], 409);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
            'counts' => $this->memberCounts(),
        ]);
    }

    public function userexport(Request $request): StreamedResponse
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:191'],
            'gender' => ['nullable', Rule::in(['Male', 'Female'])],
            'status' => ['nullable', Rule::in(array_keys(self::STATUS_VALUES))],
            'plan' => ['nullable', Rule::in(['Free', 'Premium'])],
        ]);

        $query = $this->nonAdminUsers();
        $this->applyFilters($query, $validated);

        $fileName = 'users_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return new StreamedResponse(function () use ($query): void {
            $handle = fopen('php://output', 'w');
            if ($handle === false) {
                throw new \RuntimeException('Unable to open the CSV output stream.');
            }

            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                'Member ID',
                'Name',
                'Email',
                'Phone',
                'Gender',
                'Age',
                'City',
                'Status',
                'Plan',
                'Created At',
            ]);

            $query->orderBy('id')->chunk(500, function ($users) use ($handle): void {
                foreach ($users as $user) {
                    fputcsv($handle, [
                        $this->safeCsvValue($user->member_id ?? ('US' . str_pad($user->id, 4, '0', STR_PAD_LEFT))),
                        $this->safeCsvValue($user->name),
                        $this->safeCsvValue($user->email),
                        $this->safeCsvValue($user->phone ?? 'N/A'),
                        $this->safeCsvValue($user->gender ?? 'N/A'),
                        $this->safeCsvValue($user->age ?? 'N/A'),
                        $this->safeCsvValue($user->city ?? 'N/A'),
                        $this->statusLabel($user->status),
                        $this->safeCsvValue($user->plan ?? 'Free'),
                        $user->created_at?->format('Y-m-d H:i') ?? '',
                    ]);
                }
            });

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    private function memberRules(?int $userId = null): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:191',
                $userId === null
                ? Rule::unique('users', 'email')
                : Rule::unique('users', 'email')->ignore($userId),
            ],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'age' => ['required', 'integer', 'min:18', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', Rule::in(array_keys(self::STATUS_VALUES))],
            'plan' => ['required', Rule::in(['Free', 'Premium'])],
        ];
    }

    private function normalizeEmail(mixed $email): mixed
    {
        return is_string($email) ? mb_strtolower(trim($email)) : $email;
    }

    private function hasRelatedRecords(int $userId): bool
    {
        foreach (['profiles', 'user_subscriptions'] as $table) {
            if (
                Schema::hasTable($table)
                && Schema::hasColumn($table, 'user_id')
                && DB::table($table)->where('user_id', $userId)->exists()
            ) {
                return true;
            }
        }

        if (!Schema::hasTable('interests')) {
            return false;
        }

        $query = DB::table('interests');
        $hasSender = Schema::hasColumn('interests', 'sender_id');
        $hasReceiver = Schema::hasColumn('interests', 'receiver_id');

        if ($hasSender && $hasReceiver) {
            return $query->where('sender_id', $userId)
                ->orWhere('receiver_id', $userId)
                ->exists();
        }

        if ($hasSender || $hasReceiver) {
            return $query->where($hasSender ? 'sender_id' : 'receiver_id', $userId)->exists();
        }

        return false;
    }

    private function applyFilters($query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $search = trim($filters['search']);
            $query->where(function ($builder) use ($search): void {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('member_id', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        if (!empty($filters['status'])) {
            $status = self::STATUS_VALUES[$filters['status']];
            $query->where(function ($builder) use ($status, $filters): void {
                $builder->where('status', $status)
                    ->orWhere('status', $filters['status']);
            });
        }

        if (!empty($filters['plan'])) {
            $query->where('plan', $filters['plan']);
        }
    }

    private function memberData(User $user): array
    {
        $profile = null;
        if (Schema::hasTable('profiles')) {
            $profile = DB::table('profiles')->where('user_id', $user->id)->first();
        }
        $profileImage = $profile->profile_image ?? ($profile->photo ?? ($profile->image ?? ($profile->avatar ?? null)));

        return [
            'db_id' => $user->id,
            'id' => $user->member_id ?: ('US' . str_pad($user->id, 4, '0', STR_PAD_LEFT)),
            'member_id' => $user->member_id ?: ('US' . str_pad($user->id, 4, '0', STR_PAD_LEFT)),
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender ?? '',
            'age' => $user->age ?? '',
            'city' => $user->city ?? '',
            'status' => $this->statusLabel($user->status),
            'plan' => $user->plan ?? 'Free',
            'phone' => $user->phone ?? '',
            'profile_image' => $profileImage,
        ];
    }

    private function statusLabel(mixed $status): string
    {
        if (is_numeric($status)) {
            return self::STATUS_LABELS[(int) $status] ?? 'Unknown';
        }

        return array_key_exists((string) $status, self::STATUS_VALUES)
            ? (string) $status
            : 'Unknown';
    }

    private function memberCounts(): array
    {
        $members = $this->nonAdminUsers();

        return [
            'all' => (clone $members)->count(),
            'active' => $this->countStatus($members, 'Active'),
            'pending' => $this->countStatus($members, 'Pending'),
            'suspended' => $this->countStatus($members, 'Suspended'),
        ];
    }

    private function countStatus(Builder $query, string $status): int
    {
        $statusValue = self::STATUS_VALUES[$status];

        return (clone $query)
            ->where(function ($builder) use ($status, $statusValue): void {
                $builder->where('status', $statusValue)
                    ->orWhere('status', $status);
            })
            ->count();
    }

    private function safeCsvValue(mixed $value): string
    {
        $value = (string) $value;

        return preg_match('/^[\s]*[=+\-@]/u', $value) === 1
            ? "'" . $value
            : $value;
    }
}