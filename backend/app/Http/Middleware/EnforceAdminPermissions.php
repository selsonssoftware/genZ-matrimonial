<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class EnforceAdminPermissions
{
    private const ROUTE_MODULES = [
        'dashboard' => 'dashboard',
        'users.' => 'user_management',
        'admin.profile-verification.' => 'profile_verification',
        'admin.vendors.' => 'vendor_management',
        'admin.vendor-assignments.' => 'vendor_management',
        'admin.matches-interests' => 'matches_interests',
        'admin.membership' => 'membership_payments',
        'admin.matrimonymasterdata' => 'matrimony_master_data',
        'admin.cms-communication' => 'cms_communication',
        'admin.report' => 'reports',
        'admin.setting.admins.' => 'admin_users',
        'admin.setting' => 'settings',
        'settings' => 'settings',
        'admins.' => 'admin_users',
        'change.password' => 'settings',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();
        $routeName = (string) $request->route()?->getName();
        $module = $this->moduleFor($routeName);

        if (app()->environment('local') && ! ($admin instanceof Admin)) {
            return $next($request);
        }

        abort_unless(
            $admin instanceof Admin || app()->environment('local'),
            403,
            'An authenticated admin account is required.'
        );

        $timeout = 60;
        if (Schema::hasTable('app_settings')) {
            $savedTimeout = DB::table('app_settings')
                ->where('setting_key', 'session_timeout_minutes')
                ->value('setting_value');
            if ($savedTimeout !== null) {
                $timeout = (int) json_decode($savedTimeout, true, 512, JSON_THROW_ON_ERROR);
            }
        }

        $lastActivity = $request->session()->get('admin_last_activity');
        if (is_int($lastActivity) && time() - $lastActivity > $timeout * 60) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'login' => 'Your admin session expired. Please sign in again.',
            ]);
        }
        $request->session()->put('admin_last_activity', time());

        if (str_starts_with($routeName, 'change.password')) {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }

        if ($module === null) {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }

        if (! Schema::hasTable('app_settings')) {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }

        $permissionsJson = DB::table('app_settings')
            ->where('setting_key', 'role_permissions')
            ->value('setting_value');

        if ($permissionsJson === null) {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }

        $allPermissions = json_decode($permissionsJson, true, 512, JSON_THROW_ON_ERROR);
        $role = strtolower(trim((string) $admin->role));
        if ($role === 'superadmin') {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }

        $action = $this->actionFor($request, $routeName);
        if ($role === 'admin' && $module === 'settings' && in_array($action, ['view', 'edit'], true)) {
            return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
        }
        $allowed = $allPermissions[$role][$module][$action] ?? false;

        abort_unless(filter_var($allowed, FILTER_VALIDATE_BOOLEAN), 403, 'You do not have permission to perform this action.');

        return $this->continueAndAudit($request, $next, $admin, $routeName, $module);
    }

    private function continueAndAudit(
        Request $request,
        Closure $next,
        Admin $admin,
        string $routeName,
        ?string $module
    ): Response {
        $response = $next($request);

        if (
            ! $request->isMethodSafe()
            && $response->getStatusCode() < 400
            && $module !== null
            && Schema::hasTable('admin_audit_logs')
            && $routeName !== 'admin.setting.update'
            && ! str_starts_with($routeName, 'admin.setting.admins.')
        ) {
            DB::table('admin_audit_logs')->insert([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name ?? 'Admin',
                'admin_email' => $admin->email ?? '',
                'action' => $this->auditAction($request, $routeName),
                'module' => $module,
                'description' => strtoupper($request->method()).' '.$routeName,
                'ip_address' => $request->ip(),
                'created_at' => now(),
            ]);
        }

        return $response;
    }

    private function moduleFor(string $routeName): ?string
    {
        foreach (self::ROUTE_MODULES as $prefix => $module) {
            if ($routeName === $prefix || str_starts_with($routeName, $prefix)) {
                return $module;
            }
        }

        return null;
    }

    private function actionFor(Request $request, string $routeName): string
    {
        if ($request->isMethod('DELETE')) {
            return 'delete';
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return 'edit';
        }

        if ($request->isMethod('POST')) {
            return str_contains($routeName, '.store') || str_contains($routeName, '.create')
                ? 'create'
                : 'edit';
        }

        return 'view';
    }

    private function auditAction(Request $request, string $routeName): string
    {
        if ($request->isMethod('DELETE')) {
            return 'record_deleted';
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return 'record_updated';
        }

        return str_contains($routeName, '.store') || str_contains($routeName, '.create')
            ? 'record_created'
            : 'record_updated';
    }
}
