<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VendorAssignmentReportController extends Controller
{
    public function index()
    {
        $isMysql = DB::connection()->getDriverName() === 'mysql';

        $assignments = DB::table('vendor_customer_assignments as a')
            ->leftJoin('vendor as v', 'v.id', '=', 'a.vendor_id')
            ->leftJoin('profiles as p', function ($join) use ($isMysql) {
                if ($isMysql) {
                    $join->whereRaw(
                        'p.profile_id COLLATE utf8mb4_general_ci = a.profile_id COLLATE utf8mb4_general_ci'
                    );
                } else {
                    $join->on('p.profile_id', '=', 'a.profile_id');
                }
            })
            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
            ->select([
                'a.id',
                'a.vendor_id',
                'a.profile_id',
                'a.assigned_at',
                'v.agent_name',
                'v.city as vendor_city',
                'p.gender',
                'p.age',
                'p.city as profile_city',
                'u.name as profile_name',
                'u.phone as profile_mobile',
            ])
            ->orderByDesc('a.assigned_at')
            ->orderByDesc('a.id')
            ->paginate(10);

        return view('admin.vendor-assignments', compact('assignments'));
    }
}
