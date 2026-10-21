<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use JsonException;

class SettingsController extends Controller
{
    private const ADMIN_TABLE = 'admin';

    private const ADMIN_EMAIL_COLUMN = 'mailid';

    private const DEFAULTS = [
        'shop_name' => '',
        'support_email' => '',
        'phone' => '',
        'business_hours' => '',
        'business_name' => '',
        'registration_number' => '',
        'business_address' => '',
        'logo_path' => null,
        'favicon_path' => null,
        'primary_color' => '#4f46e5',
        'accent_color' => '#22c55e',
        'currency' => 'INR',
        'tax_rate' => 0,
        'auto_tax' => true,
        'default_origin' => '',
        'free_shipping_threshold' => null,
        'shipping_methods' => ['Standard Delivery'],
        'stripe_enabled' => true,
        'paypal_enabled' => false,
        'stripe_key' => null,
        'paypal_client_id' => null,
        'order_emails' => true,
        'low_stock_alerts' => false,
        'sms_notifications' => false,
        'invoice_prefix' => 'INV-',
        'include_tax_breakdown' => true,
        'pdf_download' => false,
        'meta_title' => '',
        'meta_description' => '',
        'privacy_url' => '',
        'terms_url' => '',
        'google_analytics_id' => '',
        'facebook_pixel_id' => '',
        'mailchimp_api_key' => null,
        'auto_backups' => false,
        'maintenance_mode' => false,
        'debug_mode' => false,
        'custom_script' => '',
        'role_permissions' => [],
        'minimum_password_length' => 8,
        'require_uppercase' => true,
        'require_lowercase' => true,
        'require_number' => true,
        'require_special_character' => false,
        'two_factor_enabled' => false,
        'two_factor_authenticator' => true,
        'two_factor_sms' => false,
        'max_login_attempts' => 5,
        'lockout_duration_minutes' => 15,
        'session_timeout_minutes' => 60,
        'notification_channels' => ['email' => true, 'sms' => false, 'push' => true],
        'notification_events' => [],
        'user_data_retention_years' => 2,
        'message_data_retention_years' => 1,
        'audit_log_retention_years' => 1,
        'deleted_record_retention_months' => 6,
        'data_export_enabled' => true,
        'data_export_csv' => true,
        'data_export_pdf' => true,
        'inactive_account_days' => 180,
        'user_deletion_enabled' => true,
        'privacy_consent_required' => true,
        'privacy_policy_visible' => true,
    ];

    private const SECRET_KEYS = ['stripe_key', 'paypal_client_id', 'mailchimp_api_key'];

    private const CHECKBOX_KEYS = [
        'auto_tax',
        'stripe_enabled',
        'paypal_enabled',
        'order_emails',
        'low_stock_alerts',
        'sms_notifications',
        'include_tax_breakdown',
        'pdf_download',
        'auto_backups',
        'maintenance_mode',
        'debug_mode',
        'require_uppercase',
        'require_lowercase',
        'require_number',
        'require_special_character',
        'two_factor_enabled',
        'two_factor_authenticator',
        'two_factor_sms',
        'data_export_enabled',
        'data_export_csv',
        'data_export_pdf',
        'user_deletion_enabled',
        'privacy_consent_required',
        'privacy_policy_visible',
    ];

    private const ROLES = [
        'admin' => 'Admin',
        'manager' => 'Manager',
        'support' => 'Support',
    ];

    private const MODULES = [
        'dashboard' => 'Dashboard',
        'user_management' => 'User Management',
        'profile_verification' => 'Profile Verification',
        'vendor_management' => 'Vendor Management',
        'matches_interests' => 'Matches & Interests',
        'membership_payments' => 'Membership & Payments',
        'matrimony_master_data' => 'Matrimony Master Data',
        'cms_communication' => 'CMS & Communication',
        'reports' => 'Reports',
        'settings' => 'Settings',
        'admin_users' => 'Admin Users & Roles',
    ];

    private const PERMISSION_ACTIONS = [
        'view' => 'View',
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
    ];

    private const NOTIFICATION_EVENTS = [
        'new_user_registration' => 'New User Registration',
        'profile_verification' => 'Profile Verification',
        'payment_received' => 'Payment Received',
        'membership_expiry' => 'Membership Expiry',
        'new_match_found' => 'New Match Found',
    ];

    public function index()
    {
        $settings = $this->loadSettings();
        $roles = $this->roles();
        $settings['role_permissions'] = $this->normalizeRolePermissions($settings['role_permissions'], $roles);
        $settings['notification_events'] = $this->normalizeNotificationEvents($settings['notification_events']);
        $admins = $this->adminAccounts();
        $auditLogs = $this->auditLogs(request());

        return view('admin.setting', [
            'settings' => $settings,
            'roles' => $roles,
            'modules' => self::MODULES,
            'permissionActions' => self::PERMISSION_ACTIONS,
            'notificationEvents' => self::NOTIFICATION_EVENTS,
            'admins' => $admins,
            'auditLogs' => $auditLogs,
            'auditFilters' => request()->only(['from', 'to', 'admin', 'action']),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $this->validateAndFlashSafeInput($request, $this->settingsRules());
        if ($validated instanceof RedirectResponse) {
            return $validated;
        }

        $currentSettings = $this->loadSettings();
        $submittedSettings = $validated['settings'];
        $settings = array_replace($currentSettings, $submittedSettings);

        foreach (self::CHECKBOX_KEYS as $key) {
            if (array_key_exists($key, $submittedSettings)) {
                $settings[$key] = $request->boolean("settings.{$key}");
            }
        }

        if (array_key_exists('role_permissions', $submittedSettings)) {
            $settings['role_permissions'] = $this->normalizeRolePermissions(
                array_replace(
                    is_array($currentSettings['role_permissions']) ? $currentSettings['role_permissions'] : [],
                    $submittedSettings['role_permissions']
                ),
                $this->roles()
            );
        }
        if (array_key_exists('notification_channels', $submittedSettings)) {
            $settings['notification_channels'] = $this->normalizeNotificationChannels(
                $submittedSettings['notification_channels']
            );
        }
        if (array_key_exists('notification_events', $submittedSettings)) {
            $settings['notification_events'] = $this->normalizeNotificationEvents(
                array_replace(
                    is_array($currentSettings['notification_events']) ? $currentSettings['notification_events'] : [],
                    $submittedSettings['notification_events']
                )
            );
        }
        if (empty($settings['role_permissions'])) {
            $settings['role_permissions'] = $this->defaultRolePermissions($this->roles());
        }
        $settings['shipping_methods'] = array_values($settings['shipping_methods'] ?? []);

        foreach (['logo', 'favicon'] as $upload) {
            if ($request->hasFile($upload)) {
                $settings[$upload.'_path'] = $request->file($upload)
                    ->store('settings/branding', 'public');
            }
        }

        $this->saveSettings($settings);
        $this->recordAudit('settings_updated', 'settings', 'Updated application settings.');

        $redirectParameters = [
            'section' => $request->input('section'),
            'role' => $request->input('role'),
        ];

        return redirect()
            ->route('admin.setting', array_filter($redirectParameters, fn ($value) => $value !== null))
            ->with('success', 'Settings saved successfully.');
    }

    public function backup()
    {
        $settings = $this->loadSettings();

        foreach (self::SECRET_KEYS as $key) {
            unset($settings[$key]);
        }
        unset($settings['logo_path'], $settings['favicon_path']);

        $backup = [
            'version' => 1,
            'scope' => 'application-settings',
            'created_at' => now()->toIso8601String(),
            'settings' => $settings,
        ];

        return response()->streamDownload(
            static function () use ($backup): void {
                echo json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
            },
            'application-settings-'.now()->format('Ymd-His').'.json',
            ['Content-Type' => 'application/json; charset=UTF-8']
        );
    }

    public function asset(string $type)
    {
        $settingKey = match ($type) {
            'logo' => 'logo_path',
            'favicon' => 'favicon_path',
            default => abort(404),
        };

        $path = $this->loadSettings()[$settingKey];
        abort_unless(
            is_string($path) && str_starts_with($path, 'settings/branding/'),
            404
        );

        $disk = Storage::disk('public');
        $stream = $disk->readStream($path);
        abort_unless(is_resource($stream), 404);

        return response()->stream(static function () use ($stream): void {
            fpassthru($stream);
            fclose($stream);
        }, 200, ['Content-Type' => 'application/octet-stream']);
    }

    public function restore(Request $request)
    {
        $validated = $this->validateAndFlashSafeInput($request, [
            'backup_file' => ['required', 'file', 'mimes:json,txt', 'max:2048'],
        ]);
        if ($validated instanceof RedirectResponse) {
            return $validated;
        }

        try {
            $backup = json_decode(
                $request->file('backup_file')->get(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException) {
            return back()->withErrors([
                'backup_file' => 'The selected file does not contain valid JSON.',
            ]);
        }

        if (! is_array($backup) || ($backup['version'] ?? null) !== 1 || ($backup['scope'] ?? null) !== 'application-settings') {
            return back()->withErrors([
                'backup_file' => 'This is not a supported application settings backup.',
            ]);
        }

        if (! isset($backup['settings']) || ! is_array($backup['settings'])) {
            return back()->withErrors([
                'backup_file' => 'The settings backup is missing its settings data.',
            ]);
        }

        foreach (self::SECRET_KEYS as $key) {
            if (array_key_exists($key, $backup['settings'] ?? [])) {
                return back()->withErrors([
                    'backup_file' => 'Settings backups must not contain API credentials.',
                ]);
            }
        }

        $backupSettings = collect($backup['settings'] ?? [])->except(['logo_path', 'favicon_path'])->all();
        foreach ([
            'role_permissions',
            'minimum_password_length',
            'require_uppercase',
            'require_lowercase',
            'require_number',
            'require_special_character',
            'two_factor_enabled',
            'two_factor_authenticator',
            'two_factor_sms',
            'max_login_attempts',
            'lockout_duration_minutes',
            'session_timeout_minutes',
            'notification_channels',
            'notification_events',
            'user_data_retention_years',
            'message_data_retention_years',
            'audit_log_retention_years',
            'deleted_record_retention_months',
            'data_export_enabled',
            'data_export_csv',
            'data_export_pdf',
            'inactive_account_days',
            'user_deletion_enabled',
            'privacy_consent_required',
            'privacy_policy_visible',
        ] as $newKey) {
            $backupSettings[$newKey] ??= self::DEFAULTS[$newKey];
        }

        $validated = Validator::make(
            ['settings' => $backupSettings],
            $this->settingsRules(false)
        )->validate();

        $current = $this->loadSettings();
        $settings = array_replace($current, $validated['settings']);

        foreach (self::CHECKBOX_KEYS as $key) {
            if (array_key_exists($key, $validated['settings'])) {
                $settings[$key] = (bool) $validated['settings'][$key];
            }
        }
        $settings['role_permissions'] = $this->normalizeRolePermissions(
            $validated['settings']['role_permissions'] ?? [],
            $this->roles()
        );
        $settings['notification_channels'] = $this->normalizeNotificationChannels(
            $validated['settings']['notification_channels'] ?? []
        );
        $settings['notification_events'] = $this->normalizeNotificationEvents(
            $validated['settings']['notification_events'] ?? []
        );

        $this->saveSettings($settings);

        return redirect()
            ->route('admin.setting')
            ->with('success', 'Application settings restored successfully. Saved API credentials were not changed.');
    }

    public function adminStore(Request $request)
    {
        $passwordRules = $this->adminPasswordRules();
        $messages = [
            'password.regex' => 'The password must contain at least one uppercase letter (A-Z) and one lowercase letter (a-z).',
            'password.min' => 'The password must be at least :min characters.',
            'password.letters' => 'The password must contain at least one letter.',
            'password.mixed_case' => 'The password must contain at least one uppercase and one lowercase letter.',
            'password.numbers' => 'The password must contain at least one number (0-9).',
            'password.symbols' => 'The password must contain at least one special character.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:191', Rule::unique(self::ADMIN_TABLE, self::ADMIN_EMAIL_COLUMN)],
            'role' => ['required', Rule::in(array_keys($this->roles()))],
            'password' => ['required', 'confirmed', $passwordRules],
        ], $messages);

        $admin = new Admin;
        $admin->name = trim($validated['name']);
        $admin->email = mb_strtolower(trim($validated['email']));
        $admin->role = $validated['role'];
        $admin->password = Hash::make($validated['password']);
        $admin->save();

        $this->recordAudit(
            'admin_created',
            'admin_users',
            'Created admin account for '.$admin->email.'.'
        );

        return redirect()->route('admin.setting', ['section' => 'admin-users-roles'])
            ->with('success', 'Admin account created successfully.');
    }

    public function adminUpdate(Request $request, int $id)
    {
        $admin = Admin::query()->findOrFail($id);
        $messages = [
            'password.regex' => 'The password must contain at least one uppercase letter (A-Z) and one lowercase letter (a-z).',
            'password.min' => 'The password must be at least :min characters.',
            'password.letters' => 'The password must contain at least one letter.',
            'password.mixed_case' => 'The password must contain at least one uppercase and one lowercase letter.',
            'password.numbers' => 'The password must contain at least one number (0-9).',
            'password.symbols' => 'The password must contain at least one special character.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique(self::ADMIN_TABLE, self::ADMIN_EMAIL_COLUMN)->ignore($admin->id),
            ],
            'role' => ['required', Rule::in(array_keys($this->roles()))],
            'password' => ['nullable', 'confirmed', $this->adminPasswordRules()],
        ], $messages);

        if (
            strtolower((string) $admin->role) === 'admin'
            && strtolower($validated['role']) !== 'admin'
            && Admin::query()->whereRaw('LOWER(role) = ?', ['admin'])->count() <= 1
        ) {
            return back()->withErrors([
                'role' => 'The last Admin account cannot be assigned a lower role.',
            ]);
        }

        $admin->name = trim($validated['name']);
        $admin->email = mb_strtolower(trim($validated['email']));
        $admin->role = $validated['role'];
        if (! empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        $this->recordAudit(
            'admin_updated',
            'admin_users',
            'Updated admin account for '.$admin->email.'.'
        );

        return redirect()->route('admin.setting', ['section' => 'admin-users-roles'])
            ->with('success', 'Admin account updated successfully.');
    }

    public function adminDestroy(int $id)
    {
        $admin = Admin::query()->findOrFail($id);
        $currentAdminId = Auth::guard('admin')->id();

        if ($currentAdminId !== null && (int) $currentAdminId === (int) $admin->id) {
            return back()->with('error', 'You cannot delete your own admin account.');
        }

        if (
            strtolower((string) $admin->role) === 'admin'
            && Admin::query()->whereRaw('LOWER(role) = ?', ['admin'])->count() <= 1
        ) {
            return back()->with('error', 'The last Admin account cannot be deleted.');
        }

        $email = $admin->email;
        $admin->delete();
        $this->recordAudit('admin_deleted', 'admin_users', 'Deleted admin account for '.$email.'.');

        return redirect()->route('admin.setting', ['section' => 'admin-users-roles'])
            ->with('success', 'Admin account deleted successfully.');
    }

    private function adminPasswordRules(): Password
    {
        $settings = $this->loadSettings();
        $rule = Password::min((int) $settings['minimum_password_length']);
        $extraRules = [];

        if (! empty($settings['require_uppercase']) && ! empty($settings['require_lowercase'])) {
            $rule->mixedCase();
        } elseif (! empty($settings['require_uppercase'])) {
            $extraRules[] = 'regex:/[A-Z]/';
        } elseif (! empty($settings['require_lowercase'])) {
            $extraRules[] = 'regex:/[a-z]/';
        }

        if (! empty($settings['require_number'])) {
            $rule->numbers();
        }
        if (! empty($settings['require_special_character'])) {
            $rule->symbols();
        }
        if ($extraRules !== []) {
            $rule->rules($extraRules);
        }

        return $rule;
    }

    private function adminAccounts()
    {
        if (! Schema::hasTable(self::ADMIN_TABLE)) {
            return collect();
        }

        $columns = array_values(array_filter(
            ['id', 'name', 'role'],
            fn (string $column): bool => Schema::hasColumn(self::ADMIN_TABLE, $column)
        ));
        if (Schema::hasColumn(self::ADMIN_TABLE, self::ADMIN_EMAIL_COLUMN)) {
            $columns[] = DB::raw(self::ADMIN_EMAIL_COLUMN.' as email');
        }

        return DB::table(self::ADMIN_TABLE)
            ->select($columns)
            ->orderBy('id')
            ->get();
    }

    private function roles(): array
    {
        $roles = self::ROLES;
        if (! Schema::hasTable(self::ADMIN_TABLE) || ! Schema::hasColumn(self::ADMIN_TABLE, 'role')) {
            return $roles;
        }

        foreach (DB::table(self::ADMIN_TABLE)->whereNotNull('role')->distinct()->pluck('role') as $role) {
            $key = strtolower(trim((string) $role));
            if ($key !== '') {
                $roles[$key] ??= ucwords(str_replace(['-', '_'], ' ', $key));
            }
        }

        return $roles;
    }

    private function defaultRolePermissions(array $roles): array
    {
        $permissions = [];
        foreach (array_keys($roles) as $role) {
            foreach (self::MODULES as $module => $_label) {
                foreach (self::PERMISSION_ACTIONS as $action => $_actionLabel) {
                    $permissions[$role][$module][$action] = match ($role) {
                        'admin' => true,
                        'manager' => in_array($action, ['view', 'create', 'edit'], true),
                        default => $action === 'view',
                    };
                }
            }
        }

        return $permissions;
    }

    private function normalizeRolePermissions(mixed $input, array $roles): array
    {
        $permissions = $this->defaultRolePermissions($roles);
        if (! is_array($input)) {
            return $permissions;
        }

        foreach ($roles as $role => $_label) {
            foreach (self::MODULES as $module => $_moduleLabel) {
                foreach (self::PERMISSION_ACTIONS as $action => $_actionLabel) {
                    if (isset($input[$role][$module]) && is_array($input[$role][$module])) {
                        $permissions[$role][$module][$action] = filter_var(
                            $input[$role][$module][$action] ?? false,
                            FILTER_VALIDATE_BOOLEAN
                        );
                    }
                }
            }
        }

        return $permissions;
    }

    private function normalizeNotificationChannels(mixed $input): array
    {
        return [
            'email' => filter_var(is_array($input) ? ($input['email'] ?? false) : false, FILTER_VALIDATE_BOOLEAN),
            'sms' => filter_var(is_array($input) ? ($input['sms'] ?? false) : false, FILTER_VALIDATE_BOOLEAN),
            'push' => filter_var(is_array($input) ? ($input['push'] ?? false) : false, FILTER_VALIDATE_BOOLEAN),
        ];
    }

    private function normalizeNotificationEvents(mixed $input): array
    {
        $events = [];
        foreach (self::NOTIFICATION_EVENTS as $event => $_label) {
            foreach (['email', 'sms', 'push'] as $channel) {
                $events[$event][$channel] = filter_var(
                    is_array($input) ? ($input[$event][$channel] ?? false) : false,
                    FILTER_VALIDATE_BOOLEAN
                );
            }
        }

        return $events;
    }

    private function auditLogs(Request $request)
    {
        if (! Schema::hasTable('admin_audit_logs')) {
            return collect();
        }

        $filters = Validator::make($request->query(), [
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date', 'after_or_equal:from'],
            'admin' => ['nullable', 'string', 'max:191'],
            'action' => ['nullable', 'string', 'max:100'],
        ])->validate();

        return DB::table('admin_audit_logs')
            ->when($filters['from'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
            ->when($filters['to'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date))
            ->when($filters['admin'] ?? null, fn ($query, $admin) => $query->where('admin_email', 'like', '%'.$admin.'%'))
            ->when($filters['action'] ?? null, fn ($query, $action) => $query->where('action', $action))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->query());
    }

    private function recordAudit(string $action, string $module, string $description): void
    {
        if (! Schema::hasTable('admin_audit_logs')) {
            return;
        }

        $admin = Auth::guard('admin')->user();
        if (! $admin) {
            return;
        }

        DB::table('admin_audit_logs')->insert([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name ?? 'Admin',
            'admin_email' => $admin->email ?? '',
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }

    private function settingsRules(bool $includeSecrets = true): array
    {
        $inputKeys = array_diff(array_keys(self::DEFAULTS), ['logo_path', 'favicon_path']);
        if (! $includeSecrets) {
            $inputKeys = array_diff($inputKeys, self::SECRET_KEYS);
        }

        $rules = [
            'settings' => ['required', 'array:'.implode(',', $inputKeys)],
            'settings.role_permissions' => ['sometimes', 'array'],
            'settings.role_permissions.*' => ['required', 'array'],
            'settings.role_permissions.*.*' => ['required', 'array'],
            'settings.role_permissions.*.*.*' => ['required', 'boolean'],
            'settings.minimum_password_length' => ['sometimes', 'required', 'integer', 'min:8', 'max:128'],
            'settings.require_uppercase' => ['sometimes', 'boolean'],
            'settings.require_lowercase' => ['sometimes', 'boolean'],
            'settings.require_number' => ['sometimes', 'boolean'],
            'settings.require_special_character' => ['sometimes', 'boolean'],
            'settings.two_factor_enabled' => ['sometimes', 'boolean'],
            'settings.two_factor_authenticator' => ['sometimes', 'boolean'],
            'settings.two_factor_sms' => ['sometimes', 'boolean'],
            'settings.max_login_attempts' => ['sometimes', 'required', 'integer', 'min:1', 'max:20'],
            'settings.lockout_duration_minutes' => ['sometimes', 'required', 'integer', 'min:1', 'max:1440'],
            'settings.session_timeout_minutes' => ['sometimes', 'required', 'integer', 'min:5', 'max:1440'],
            'settings.notification_channels' => ['sometimes', 'array:email,sms,push'],
            'settings.notification_channels.*' => ['required', 'boolean'],
            'settings.notification_events' => ['sometimes', 'array'],
            'settings.notification_events.*' => ['required', 'array:email,sms,push'],
            'settings.notification_events.*.*' => ['required', 'boolean'],
            'settings.user_data_retention_years' => ['sometimes', 'required', 'integer', 'min:1', 'max:10'],
            'settings.message_data_retention_years' => ['sometimes', 'required', 'integer', 'min:1', 'max:10'],
            'settings.audit_log_retention_years' => ['sometimes', 'required', 'integer', 'min:1', 'max:10'],
            'settings.deleted_record_retention_months' => ['sometimes', 'required', 'integer', 'min:1', 'max:60'],
            'settings.data_export_enabled' => ['sometimes', 'boolean'],
            'settings.data_export_csv' => ['sometimes', 'boolean'],
            'settings.data_export_pdf' => ['sometimes', 'boolean'],
            'settings.inactive_account_days' => ['sometimes', 'required', 'integer', 'min:30', 'max:3650'],
            'settings.user_deletion_enabled' => ['sometimes', 'boolean'],
            'settings.privacy_consent_required' => ['sometimes', 'boolean'],
            'settings.privacy_policy_visible' => ['sometimes', 'boolean'],
            'settings.shop_name' => ['sometimes', 'required', 'string', 'max:150'],
            'settings.support_email' => ['sometimes', 'required', 'email', 'max:191'],
            'settings.phone' => ['nullable', 'string', 'max:40'],
            'settings.business_hours' => ['nullable', 'string', 'max:120'],
            'settings.business_name' => ['nullable', 'string', 'max:191'],
            'settings.registration_number' => ['nullable', 'string', 'max:100'],
            'settings.business_address' => ['nullable', 'string', 'max:2000'],
            'settings.primary_color' => ['sometimes', 'required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'settings.accent_color' => ['sometimes', 'required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'settings.currency' => ['sometimes', 'required', Rule::in(['USD', 'EUR', 'GBP', 'INR'])],
            'settings.tax_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'settings.auto_tax' => ['sometimes', 'boolean'],
            'settings.default_origin' => ['nullable', 'string', 'max:191'],
            'settings.free_shipping_threshold' => ['nullable', 'numeric', 'min:0', 'max:999999999'],
            'settings.shipping_methods' => ['nullable', 'array'],
            'settings.shipping_methods.*' => [Rule::in(['Standard Delivery', 'Express', 'Pickup'])],
            'settings.stripe_enabled' => ['sometimes', 'boolean'],
            'settings.paypal_enabled' => ['sometimes', 'boolean'],
            'settings.stripe_key' => ['nullable', 'string', 'max:500'],
            'settings.paypal_client_id' => ['nullable', 'string', 'max:500'],
            'settings.order_emails' => ['sometimes', 'boolean'],
            'settings.low_stock_alerts' => ['sometimes', 'boolean'],
            'settings.sms_notifications' => ['sometimes', 'boolean'],
            'settings.invoice_prefix' => ['nullable', 'string', 'max:30'],
            'settings.include_tax_breakdown' => ['sometimes', 'boolean'],
            'settings.pdf_download' => ['sometimes', 'boolean'],
            'settings.meta_title' => ['nullable', 'string', 'max:191'],
            'settings.meta_description' => ['nullable', 'string', 'max:1000'],
            'settings.privacy_url' => ['nullable', 'url', 'max:2048'],
            'settings.terms_url' => ['nullable', 'url', 'max:2048'],
            'settings.google_analytics_id' => ['nullable', 'string', 'max:100'],
            'settings.facebook_pixel_id' => ['nullable', 'string', 'max:100'],
            'settings.mailchimp_api_key' => ['nullable', 'string', 'max:500'],
            'settings.auto_backups' => ['sometimes', 'boolean'],
            'settings.maintenance_mode' => ['sometimes', 'boolean'],
            'settings.debug_mode' => ['sometimes', 'boolean'],
            'settings.custom_script' => ['nullable', 'string', 'max:20000'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:ico,png', 'max:1024'],
        ];

        if (! $includeSecrets) {
            unset(
                $rules['logo'],
                $rules['favicon'],
                $rules['settings.stripe_key'],
                $rules['settings.paypal_client_id'],
                $rules['settings.mailchimp_api_key']
            );
        }

        return $rules;
    }

    private function validateAndFlashSafeInput(Request $request, array $rules): array|RedirectResponse
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $input = $request->all();
            unset($input['logo'], $input['favicon'], $input['backup_file']);

            if (isset($input['settings']) && is_array($input['settings'])) {
                foreach (self::SECRET_KEYS as $key) {
                    unset($input['settings'][$key]);
                }
            }

            return back()
                ->withErrors($validator)
                ->withInput($input);
        }

        return $validator->validated();
    }

    private function loadSettings(): array
    {
        $settings = self::DEFAULTS;

        foreach (DB::table('app_settings')->get(['setting_key', 'setting_value']) as $row) {
            if (! array_key_exists($row->setting_key, self::DEFAULTS)) {
                continue;
            }

            $value = $row->setting_value === null
                ? null
                : (in_array($row->setting_key, self::SECRET_KEYS, true)
                ? Crypt::decryptString($row->setting_value)
                : $row->setting_value);

            $settings[$row->setting_key] = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
        }

        return $settings;
    }

    private function saveSettings(array $settings): void
    {
        DB::transaction(function () use ($settings): void {
            $rows = [];
            foreach (array_keys(self::DEFAULTS) as $key) {
                if (! array_key_exists($key, $settings)) {
                    continue;
                }

                $value = $settings[$key];
                if (in_array($key, self::SECRET_KEYS, true)) {
                    if ($value === null || $value === '') {
                        continue;
                    }

                    $encodedValue = Crypt::encryptString(
                        json_encode($value, JSON_THROW_ON_ERROR)
                    );
                } else {
                    $encodedValue = json_encode($value, JSON_THROW_ON_ERROR);
                }

                $rows[] = [
                    'setting_key' => $key,
                    'setting_value' => $encodedValue,
                    'updated_at' => now(),
                    'created_at' => now(),
                ];
            }

            if ($rows !== []) {
                DB::table('app_settings')->upsert(
                    $rows,
                    ['setting_key'],
                    ['setting_value', 'updated_at']
                );
            }
        });
    }
}
