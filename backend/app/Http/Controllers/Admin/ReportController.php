<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private const PAID_STATUSES = ['paid', 'success', 'successful', 'completed'];

    private const PERIODS = [
        'all' => 'All Time',
        'today' => 'Today',
        'last_7_days' => 'Last 7 Days',
        'last_30_days' => 'Last 30 Days',
        'last_90_days' => 'Last 90 Days',
        'this_month' => 'This Month',
        'last_month' => 'Last Month',
    ];

    public function index(Request $request)
    {
        $vendorFilters = $request->validate([
            'vendor_search' => ['nullable', 'string', 'max:100'],
            'vendor_city' => ['nullable', 'string', 'max:255'],
            'vendor_start_date' => ['nullable', 'date'],
            'vendor_end_date' => ['nullable', 'date', 'after_or_equal:vendor_start_date'],
        ]);

        $period = $request->query('period', 'last_90_days');
        if (!array_key_exists($period, self::PERIODS)) {
            $period = 'last_90_days';
        }

        $search = trim($request->query('search', ''));
        [$start, $end] = $this->periodBounds($period);

        $registrationQuery = DB::table('users');
        $this->applyDateRange($registrationQuery, 'created_at', $start, $end);
        $newRegistrations = $registrationQuery->count();

        $registrationChange = null;
        if ($period !== 'all') {
            $previousEnd = $start->copy()->subSecond();
            $previousStart = $previousEnd->copy()->subSeconds($start->diffInSeconds($end));
            $previousRegistrations = DB::table('users')
                ->whereBetween('created_at', [$previousStart, $previousEnd])
                ->count();

            $registrationChange = $previousRegistrations === 0
                ? ($newRegistrations > 0 ? null : 0.0)
                : (($newRegistrations - $previousRegistrations) / $previousRegistrations) * 100;
        }

        $totalProfiles = DB::table('profiles')->count();
        $completeProfiles = DB::table('profiles')
            ->whereNotNull('gender')
            ->where('gender', '<>', '')
            ->whereNotNull('age')
            ->whereNotNull('city')
            ->where('city', '<>', '')
            ->whereNotNull('religion')
            ->where('religion', '<>', '')
            ->whereNotNull('marital_status')
            ->where('marital_status', '<>', '')
            ->count();
        $profileCompletion = $totalProfiles > 0
            ? round(($completeProfiles / $totalProfiles) * 100, 1)
            : 0;

        $salesQuery = DB::table('user_subscriptions as us')
            ->join('subscriptions as s', 's.id', '=', 'us.subscription_id')
            ->whereIn(DB::raw('LOWER(us.payment_status)'), self::PAID_STATUSES);
        $this->applyDateRange($salesQuery, 'us.created_at', $start, $end);
        $membershipSales = (float) $salesQuery->sum('s.amount');

        $vendorLeadsQuery = DB::table('vendor_customer_assignments');
        $this->applyDateRange($vendorLeadsQuery, 'assigned_at', $start, $end);
        $vendorLeads = $vendorLeadsQuery->count();

        $chartStart = $start?->copy();
        $chartEnd = $end?->copy();
        if ($period === 'all') {
            $chartStart = now()->subMonths(11)->startOfMonth();
            $chartEnd = now()->endOfDay();
        }

        $dailyRegistrationsQuery = DB::table('users')
            ->selectRaw('DATE(created_at) as registration_date, COUNT(*) as total')
            ->whereNotNull('created_at')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('registration_date');
        $this->applyDateRange($dailyRegistrationsQuery, 'created_at', $chartStart, $chartEnd);
        $dailyRegistrations = $dailyRegistrationsQuery->get()
            ->keyBy(fn ($row) => Carbon::parse($row->registration_date)->toDateString());

        $registrationLabels = [];
        $registrationValues = [];
        if ($chartStart && $chartEnd) {
            $date = $chartStart->copy()->startOfDay();
            $lastDate = $chartEnd->copy()->startOfDay();
            while ($date->lte($lastDate)) {
                $key = $date->toDateString();
                $registrationLabels[] = $date->format('d M');
                $registrationValues[] = (int) ($dailyRegistrations->get($key)->total ?? 0);
                $date->addDay();
            }
        }

        $genderCounts = DB::table('profiles')
            ->selectRaw("CASE
                WHEN LOWER(TRIM(COALESCE(gender, ''))) = 'male' THEN 'Male'
                WHEN LOWER(TRIM(COALESCE(gender, ''))) = 'female' THEN 'Female'
                ELSE 'Other / undisclosed'
            END as gender_group, COUNT(*) as total")
            ->groupBy('gender_group')
            ->pluck('total', 'gender_group');

        $profileDistribution = collect([
            'Male' => (int) ($genderCounts['Male'] ?? 0),
            'Female' => (int) ($genderCounts['Female'] ?? 0),
            'Other / undisclosed' => (int) ($genderCounts['Other / undisclosed'] ?? 0),
        ])->map(function ($count) use ($totalProfiles) {
            return [
                'count' => $count,
                'share' => $totalProfiles > 0 ? round(($count / $totalProfiles) * 100, 1) : 0,
            ];
        });

        $transactionsQuery = DB::table('user_subscriptions as us')
            ->leftJoin('users as u', 'u.id', '=', 'us.user_id')
            ->leftJoin('subscriptions as s', 's.id', '=', 'us.subscription_id')
            ->select([
                'us.id',
                'us.transaction_id',
                'us.profile_id',
                'us.payment_status',
                'us.status',
                'us.created_at',
                's.plan_name',
                's.amount',
                'u.name as member_name',
            ]);
        $this->applyDateRange($transactionsQuery, 'us.created_at', $start, $end);

        if ($search !== '') {
            $transactionsQuery->where(function ($query) use ($search) {
                $query->where('us.transaction_id', 'like', "%{$search}%")
                    ->orWhere('us.profile_id', 'like', "%{$search}%")
                    ->orWhere('u.name', 'like', "%{$search}%");
            });
        }

        $transactions = $transactionsQuery
            ->orderByDesc('us.created_at')
            ->orderByDesc('us.id')
            ->get();

        $vendorCities = DB::table('vendor')
            ->whereNotNull('city')
            ->where('city', '<>', '')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $vendorsQuery = DB::table('vendor as v')
            ->leftJoin('vendor_customer_assignments as assignments', function ($join) use ($vendorFilters) {
                $join->on('assignments.vendor_id', '=', 'v.id');

                if (!empty($vendorFilters['vendor_start_date'])) {
                    $join->where('assignments.assigned_at', '>=', $vendorFilters['vendor_start_date'] . ' 00:00:00');
                }

                if (!empty($vendorFilters['vendor_end_date'])) {
                    $join->where('assignments.assigned_at', '<=', $vendorFilters['vendor_end_date'] . ' 23:59:59');
                }
            })
            ->leftJoin('user_subscriptions as paid_subscriptions', function ($join) {
                if (DB::getDriverName() === 'mysql') {
                    $join->whereRaw(
                        'CONVERT(paid_subscriptions.profile_id USING utf8mb4) COLLATE utf8mb4_unicode_ci = CONVERT(assignments.profile_id USING utf8mb4) COLLATE utf8mb4_unicode_ci'
                    );
                } else {
                    $join->on('paid_subscriptions.profile_id', '=', 'assignments.profile_id');
                }

                $join->whereIn(DB::raw('LOWER(paid_subscriptions.payment_status)'), self::PAID_STATUSES);
            })
            ->select([
                'v.id',
                'v.agent_name',
                'v.city',
                'v.status',
                'v.commission',
            ])
            ->selectRaw('COUNT(DISTINCT assignments.id) as customers_count')
            ->selectRaw('COUNT(DISTINCT paid_subscriptions.profile_id) as paid_memberships_count')
            ->groupBy('v.id', 'v.agent_name', 'v.city', 'v.status', 'v.commission')
            ->orderByDesc('v.id');

        if (!empty($vendorFilters['vendor_city'])) {
            $vendorsQuery->where('v.city', $vendorFilters['vendor_city']);
        }

        if (!empty($vendorFilters['vendor_search'])) {
            $searchVendor = $vendorFilters['vendor_search'];
            $vendorsQuery->where(function ($query) use ($searchVendor) {
                $query->where('v.agent_name', 'like', "%{$searchVendor}%")
                    ->orWhere('v.city', 'like', "%{$searchVendor}%")
                    ->orWhere('v.id', 'like', "%{$searchVendor}%");
            });
        }

        return view('admin.report', [
            'period' => $period,
            'periods' => self::PERIODS,
            'search' => $search,
            'newRegistrations' => $newRegistrations,
            'registrationChange' => $registrationChange,
            'profileCompletion' => $profileCompletion,
            'membershipSales' => $membershipSales,
            'vendorLeads' => $vendorLeads,
            'registrationLabels' => $registrationLabels,
            'registrationValues' => $registrationValues,
            'profileDistribution' => $profileDistribution,
            'transactions' => $transactions,
            'vendors' => $vendorsQuery->get(),
            'vendorCities' => $vendorCities,
            'vendorFilters' => $vendorFilters,
        ]);
    }

    private function periodBounds(string $period): array
    {
        $now = now();

        return match ($period) {
            'today' => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
            'last_7_days' => [$now->copy()->subDays(6)->startOfDay(), $now->copy()->endOfDay()],
            'last_30_days' => [$now->copy()->subDays(29)->startOfDay(), $now->copy()->endOfDay()],
            'last_90_days' => [$now->copy()->subDays(89)->startOfDay(), $now->copy()->endOfDay()],
            'this_month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
            'last_month' => [$now->copy()->subMonthNoOverflow()->startOfMonth(), $now->copy()->subMonthNoOverflow()->endOfMonth()],
            default => [null, null],
        };
    }

    private function applyDateRange(\Illuminate\Database\Query\Builder $query, string $column, ?Carbon $start, ?Carbon $end): void
    {
        if ($start && $end) {
            $query->whereBetween($column, [$start, $end]);
        }
    }
}
