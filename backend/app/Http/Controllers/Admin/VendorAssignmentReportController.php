<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VendorAssignmentReportController extends Controller
{
    public function index()
    {
        $assignments = DB::table('vendor_customer_assignments as assignments')
            ->leftJoin(
                'vendor as vendors',
                'vendors.id',
                '=',
                'assignments.vendor_id'
            )
            ->leftJoin(
                'profiles',
                'profiles.profile_id',
                '=',
                'assignments.profile_id'
            )
            ->select([
                'assignments.id',
                'assignments.vendor_id',
                'assignments.profile_id',
                'assignments.assigned_at',
                'vendors.agent_name',
                'vendors.city as vendor_city',
                'profiles.gender',
                'profiles.age',
                'profiles.city as profile_city',
            ])
            ->orderByDesc('assignments.assigned_at')
            ->orderByDesc('assignments.id')
            ->paginate(10);

        return view('admin.vendor-assignments', compact('assignments'));
    }
}