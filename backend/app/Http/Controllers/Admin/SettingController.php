<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class SettingController extends Controller
{
    /**
     * Settings Page & Data Fetch (Vendors and Users Only)
     */
    public function index(Request $request)
    {
        // 1. Fetch Key-Value Settings
        $rawSettings = [];
        if (Schema::hasTable('settings')) {
            $rawSettings = DB::table('settings')->pluck('value', 'key')->toArray();
        }

        $allRecords = collect();

        // 2. Fetch Vendors safely
        if (Schema::hasTable('vendor')) {
            $vendorQuery = DB::table('vendor as v')
                ->leftJoin('vendor_logins as vl', 'vl.vendor_id', '=', 'v.id')
                ->select(
                    'v.id',
                    DB::raw("COALESCE(v.agent_name, 'Vendor Agent') as name"),
                    DB::raw("COALESCE(vl.email, 'N/A') as email"),
                    DB::raw("'Vendor' as role"),
                    DB::raw("COALESCE(v.status, 'Active') as status"),
                    DB::raw("'vendor' as user_type"),
                    DB::raw("COALESCE(vl.created_at, NOW()) as created_at")
                )
                ->get();

            $allRecords = $allRecords->merge($vendorQuery);
        }

        // 3. Fetch Users safely
        if (Schema::hasTable('users')) {
            $userQuery = DB::table('users')->select(
                'id',
                'name',
                'email',
                DB::raw("'User' as role"),
                DB::raw("'Active' as status"),
                DB::raw("'user' as user_type"),
                'created_at'
            )->get();

            $allRecords = $allRecords->merge($userQuery);
        }

        // 4. In-Memory Search & Filters (Collation సమస్యలు పూర్తిగా రావు)
        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $allRecords = $allRecords->filter(function ($item) use ($search) {
                return str_contains(strtolower($item->name ?? ''), $search)
                    || str_contains(strtolower($item->email ?? ''), $search);
            });
        }

        if ($request->filled('role') && $request->input('role') !== 'All Roles') {
            $allRecords = $allRecords->where('role', $request->input('role'));
        }

        if ($request->filled('status') && $request->input('status') !== 'All Status') {
            $statusFilter = strtolower($request->input('status'));
            $allRecords = $allRecords->filter(function ($item) use ($statusFilter) {
                return strtolower($item->status ?? '') === $statusFilter;
            });
        }

        // Sort by created_at desc
        $allRecords = $allRecords->sortByDesc('created_at')->values();

        // Manual Pagination for the collection
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $allRecords->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $adminUsers = new LengthAwarePaginator(
            $currentItems,
            $allRecords->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        // 5. Modules List for Permissions Tab
        $modules = [
            'Dashboard',
            'User Management',
            'Profile Verification',
            'Vendor Management',
            'Matches & Interests',
            'Membership & Payments',
            'Matrimony Master Data',
            'CMS & Communication',
            'Reports',
        ];

        // 6. Role Permissions
        $selectedRole = $request->get('role', 'Vendor');
        $savedPermissions = [];
        if (Schema::hasTable('role_permissions')) {
            $savedPermissions = DB::table('role_permissions')
                ->where('role', $selectedRole)
                ->pluck('permissions', 'module')
                ->map(fn($item) => json_decode($item, true))
                ->toArray();
        }

        // 7. Audit Logs
        $auditLogs = new LengthAwarePaginator([], 0, 5);
        if (Schema::hasTable('audit_logs')) {
            $auditQuery = DB::table('audit_logs');
            if ($request->filled('from_date')) {
                $auditQuery->whereDate('created_at', '>=', Carbon::parse($request->input('from_date')));
            }
            if ($request->filled('to_date')) {
                $auditQuery->whereDate('created_at', '<=', Carbon::parse($request->input('to_date')));
            }
            if ($request->filled('log_user') && $request->input('log_user') !== 'All Users') {
                $auditQuery->where('admin_user', $request->input('log_user'));
            }
            if ($request->filled('log_action') && $request->input('log_action') !== 'All Actions') {
                $auditQuery->where('action', $request->input('log_action'));
            }
            $auditLogs = $auditQuery->orderBy('id', 'desc')->paginate(5, ['*'], 'audit_page');
        }

        return view('admin.setting', compact(
            'rawSettings',
            'adminUsers',
            'modules',
            'selectedRole',
            'savedPermissions',
            'auditLogs'
        ));
    }

    /**
     * Save General Settings
     */
    public function update(Request $request)
    {
        $inputs = $request->except(['_token', 'active_tab']);

        $switches = [
            'enable_2fa',
            'two_factor_auth_app',
            'two_factor_sms_otp',
            'notify_email',
            'notify_sms',
            'notify_push',
            'event_user_reg_email',
            'event_user_reg_sms',
            'event_user_reg_push',
            'event_profile_ver_email',
            'event_profile_ver_sms',
            'event_profile_ver_push',
            'event_payment_email',
            'event_payment_sms',
            'event_payment_push',
            'event_expiry_email',
            'event_expiry_sms',
            'event_expiry_push',
            'event_match_email',
            'event_match_sms',
            'event_match_push',
            'data_export_enabled',
            'export_fmt_csv',
            'export_fmt_pdf',
            'allow_user_self_delete',
            'enable_privacy_consent',
            'show_privacy_policy'
        ];

        foreach ($switches as $switch) {
            $inputs[$switch] = $request->has($switch) ? 1 : 0;
        }

        if (Schema::hasTable('settings')) {
            foreach ($inputs as $key => $value) {
                DB::table('settings')->updateOrInsert(
                    ['key' => $key],
                    [
                        'value' => \is_array($value) ? json_encode($value) : $value,
                        'updated_at' => now(),
                    ]
                );
            }
        }

        if (Schema::hasTable('audit_logs')) {
            DB::table('audit_logs')->insert([
                'admin_user' => auth()->user()->name ?? 'Admin',
                'action' => 'Changed settings',
                'module' => 'Settings',
                'ip_address' => $request->ip(),
                'created_at' => now(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Settings updated successfully!')
            ->with('active_tab', $request->input('active_tab', '#tabAdminUsers'));
    }

    /**
     * Update Permissions Table
     */
    public function updatePermissions(Request $request)
    {
        $role = $request->input('role', 'Vendor');
        $permissions = $request->input('perms', []);

        if (Schema::hasTable('role_permissions')) {
            foreach ($permissions as $module => $actions) {
                DB::table('role_permissions')->updateOrInsert(
                    ['role' => $role, 'module' => $module],
                    [
                        'permissions' => json_encode($actions),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        return redirect()->back()
            ->with('success', 'Permissions updated successfully!')
            ->with('active_tab', '#tabPermissions');
    }
}