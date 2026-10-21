<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private const PAID_STATUSES = ['paid', 'success', 'successful', 'completed'];

    public function index()
    {
        $totalMembers = DB::table('users')
            ->where(function ($query) {
                $query->whereNull('role')
                    ->orWhereRaw('LOWER(role) <> ?', ['admin']);
            })
            ->count();

        $membersThisMonth = DB::table('users')
            ->where(function ($query) {
                $query->whereNull('role')
                    ->orWhereRaw('LOWER(role) <> ?', ['admin']);
            })
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $membersLastMonth = DB::table('users')
            ->where(function ($query) {
                $query->whereNull('role')
                    ->orWhereRaw('LOWER(role) <> ?', ['admin']);
            })
            ->whereBetween('created_at', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
            ->count();

        $pendingReviews = DB::table('profiles')
            ->where('verification_status', 'pending')
            ->count();

        $activeVendors = DB::table('vendor')
            ->whereRaw('LOWER(status) = ?', ['active'])
            ->count();

        $membershipRevenue = DB::table('user_subscriptions as us')
            ->join('subscriptions as s', 's.id', '=', 'us.subscription_id')
            ->whereIn(DB::raw('LOWER(us.payment_status)'), self::PAID_STATUSES)
            ->whereBetween('us.created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('s.amount');

        $previousMonthRevenue = DB::table('user_subscriptions as us')
            ->join('subscriptions as s', 's.id', '=', 'us.subscription_id')
            ->whereIn(DB::raw('LOWER(us.payment_status)'), self::PAID_STATUSES)
            ->whereBetween('us.created_at', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
            ->sum('s.amount');

        $photoVerificationQueue = DB::table('profiles as p')
            ->where('p.verification_status', 'pending')
            ->whereExists(function ($query) {
                $query->selectRaw('1')
                    ->from('profile_photos as photos')
                    ->whereColumn('photos.profile_id', 'p.profile_id');
            })
            ->count();

        $profilesWithoutPhoto = DB::table('profiles as p')
            ->where('p.verification_status', 'pending')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('profile_photos as photos')
                    ->whereColumn('photos.profile_id', 'p.profile_id');
            })
            ->count();

        $vendorApplications = DB::table('vendor')
            ->whereRaw('LOWER(status) = ?', ['pending'])
            ->count();

        $recentRegistrations = DB::table('profiles as p')
            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
            ->select([
                'p.id',
                'p.profile_id',
                'p.gender',
                'p.city',
                'p.verification_status',
                'p.created_at',
                'u.member_id',
                'u.name as member_name',
            ])
            ->orderByDesc('p.created_at')
            ->orderByDesc('p.id')
            ->limit(10)
            ->get();

        $chartStart = now()->subMonths(6)->startOfMonth();
        $registrationLabels = [];
        $registrationValues = [];

        for ($month = $chartStart->copy(); $month->lte(now()); $month->addMonth()) {
            $registrationLabels[] = $month->format('M');
            $registrationValues[] = DB::table('profiles')
                ->whereBetween('created_at', [$month->copy()->startOfMonth(), $month->copy()->endOfMonth()])
                ->count();
        }

        return view('admin.dashboard', [
            'totalMembers' => $totalMembers,
            'memberGrowth' => $this->percentageChange($membersThisMonth, $membersLastMonth),
            'pendingReviews' => $pendingReviews,
            'activeVendors' => $activeVendors,
            'membershipRevenue' => (float) $membershipRevenue,
            'revenueGrowth' => $this->percentageChange((float) $membershipRevenue, (float) $previousMonthRevenue),
            'photoVerificationQueue' => $photoVerificationQueue,
            'profilesWithoutPhoto' => $profilesWithoutPhoto,
            'vendorApplications' => $vendorApplications,
            'recentRegistrations' => $recentRegistrations,
            'registrationLabels' => $registrationLabels,
            'registrationValues' => $registrationValues,
        ]);
    }

    private function percentageChange(float|int $current, float|int $previous): ?float
    {
        if ((float) $previous === 0.0) {
            return null;
        }

        return (($current - $previous) / $previous) * 100;
    }
}
