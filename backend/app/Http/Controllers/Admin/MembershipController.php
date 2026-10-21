<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MembershipController extends Controller
{
    private array $paidStatuses = [
        'paid',
        'success',
        'successful',
        'completed',
    ];

    public function index(Request $request)
    {
        // Membership plans
        $plans = DB::table('subscriptions')
            ->orderBy('amount')
            ->orderBy('id')
            ->get();
        $users = DB::table('users')
            ->select('id', 'name', 'email')
            ->orderBy('name')
            ->orderBy('id')
            ->get();

        // Active paid profiles
        $activePremiumProfiles = DB::table('user_subscriptions')
            ->whereIn(
                DB::raw('LOWER(payment_status)'),
                $this->paidStatuses
            )
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', Carbon::today());
            })
            ->distinct()
            ->count('profile_id');

        // Current month revenue
        $monthlyRevenue = DB::table('user_subscriptions as us')
            ->join(
                'subscriptions as s',
                's.id',
                '=',
                'us.subscription_id'
            )
            ->whereIn(
                DB::raw('LOWER(us.payment_status)'),
                $this->paidStatuses
            )
            ->whereMonth('us.created_at', now()->month)
            ->whereYear('us.created_at', now()->year)
            ->sum('s.amount');

        // Pending payments
        $pendingApprovals = DB::table('user_subscriptions')
            ->whereIn(
                DB::raw('LOWER(payment_status)'),
                ['pending', 'initiated', 'processing']
            )
            ->count();

        // Transaction history
        $query = DB::table('user_subscriptions as us')
            ->leftJoin('users as u', 'u.id', '=', 'us.user_id')
            ->leftJoin(
                'subscriptions as s',
                's.id',
                '=',
                'us.subscription_id'
            )
            ->select([
                'us.id',
                'us.user_id',
                'us.profile_id',
                'us.transaction_id',
                'us.payment_status',
                'us.status',
                'us.created_at',
                'us.start_date',
                'us.end_date',
                's.plan_name',
                's.amount',
                'u.name as member_name',
            ]);

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where(
                    'us.profile_id',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'us.transaction_id',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.email',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.phone',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $transactions = $query
            ->orderByDesc('us.id')
            ->get();

        // Refund table is not present in the supplied schema.
        $refundRequests = null;

        return view('admin.membership', compact(
            'plans',
            'users',
            'activePremiumProfiles',
            'monthlyRevenue',
            'pendingApprovals',
            'refundRequests',
            'transactions'
        ));
    }

    // Add membership plan
    public function storePlan(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
            'plan_name' => [
                'required',
                'string',
                'max:100',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'validity_days' => [
                'required',
                'integer',
                'min:1',
                'max:36500',
            ],
            'features' => [
                'nullable',
                'string',
                'max:60000',
            ],
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => $validated['user_id'],
            'plan_name' => $validated['plan_name'],
            'amount' => $validated['amount'],
            'validity_days' => $validated['validity_days'],
            'features' => $validated['features'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.membership')
            ->with('success', 'Membership plan created successfully.');
    }

    // Edit membership plan
    public function updatePlan(Request $request, int $id)
    {
        $validated = $request->validate([
            'plan_name' => [
                'required',
                'string',
                'max:100',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],
            'validity_days' => [
                'required',
                'integer',
                'min:1',
                'max:36500',
            ],
            'features' => [
                'nullable',
                'string',
                'max:60000',
            ],
        ]);

        $exists = DB::table('subscriptions')
            ->where('id', $id)
            ->exists();

        if (!$exists) {
            return redirect()
                ->route('admin.membership')
                ->withErrors([
                    'plan' => 'Membership plan not found.',
                ]);
        }

        DB::table('subscriptions')
            ->where('id', $id)
            ->update([
                'plan_name' => $validated['plan_name'],
                'amount' => $validated['amount'],
                'validity_days' => $validated['validity_days'],
                'features' => $validated['features'] ?? null,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('admin.membership')
            ->with('success', 'Membership plan updated successfully.');
    }

    // Export transaction history to CSV
    public function export(Request $request)
    {
        $query = DB::table('user_subscriptions as us')
            ->leftJoin('users as u', 'u.id', '=', 'us.user_id')
            ->leftJoin(
                'subscriptions as s',
                's.id',
                '=',
                'us.subscription_id'
            )
            ->select([
                'us.transaction_id',
                'us.profile_id',
                'u.name as member_name',
                'u.email',
                'u.phone',
                's.plan_name',
                's.amount',
                'us.payment_status',
                'us.status',
                'us.created_at',
                'us.start_date',
                'us.end_date',
            ]);

        // Export respects the current search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where(
                    'us.profile_id',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'us.transaction_id',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.email',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'u.phone',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $rows = $query->orderByDesc('us.id')->get();

        $filename = 'membership-transactions-'
            . now()->format('Ymd-His')
            . '.csv';

        return response()->streamDownload(
            function () use ($rows) {
                $output = fopen('php://output', 'w');

                fputcsv($output, [
                    'Transaction ID',
                    'Profile ID',
                    'Member Name',
                    'Email',
                    'Phone',
                    'Plan',
                    'Amount',
                    'Payment Status',
                    'Status',
                    'Created At',
                    'Start Date',
                    'End Date',
                ]);

                foreach ($rows as $row) {
                    fputcsv($output, [
                        $row->transaction_id,
                        $row->profile_id,
                        $row->member_name,
                        $row->email,
                        $row->phone,
                        $row->plan_name,
                        $row->amount,
                        $row->payment_status,
                        $row->status,
                        $row->created_at,
                        $row->start_date,
                        $row->end_date,
                    ]);
                }

                fclose($output);
            },
            $filename,
            ['Content-Type' => 'text/csv; charset=UTF-8']
        );
    }
}