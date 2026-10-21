<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminAuthController extends Controller
{
    // 1. Show Login Page
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.login');
    }

    // 2. Admin Login - admin table only
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($request->input('login'));
        $limiterKey = Str::transliterate(Str::lower($loginInput.'|'.$request->ip()));
        $maxAttempts = (int) $this->securitySetting('max_login_attempts', 5);
        $lockoutSeconds = (int) $this->securitySetting('lockout_duration_minutes', 15) * 60;

        if (RateLimiter::tooManyAttempts($limiterKey, $maxAttempts)) {
            return back()->withErrors([
                'login' => 'Too many login attempts. Try again in '.RateLimiter::availableIn($limiterKey).' seconds.',
            ])->onlyInput('login');
        }

        $normalizedLoginInput = mb_strtolower($loginInput);
        $adminQuery = Admin::whereRaw('LOWER(mailid) = ?', [$normalizedLoginInput]);
        if (Schema::hasColumn((new Admin)->getTable(), 'name')) {
            $adminQuery->orWhereRaw('LOWER(name) = ?', [$normalizedLoginInput]);
        }
        $admin = $adminQuery->first();

        $submittedPassword = $request->input('password');
        $storedPassword = $admin ? (string) $admin->getAuthPassword() : '';
        $passwordInfo = $admin ? password_get_info($storedPassword) : ['algo' => null];
        $storedPasswordIsHashed = ! in_array($passwordInfo['algo'] ?? null, [null, 0], true);
        $passwordMatches = $admin && (
            $storedPasswordIsHashed
                ? password_verify($submittedPassword, $storedPassword)
                : hash_equals($storedPassword, $submittedPassword)
        );

        if ($passwordMatches) {
            if (! $storedPasswordIsHashed) {
                $admin->password = Hash::make($submittedPassword);
                $admin->save();
            }

            Auth::guard('admin')->login(
                $admin,
                $request->boolean('remember') && Schema::hasColumn('admin', 'remember_token')
            );
            RateLimiter::clear($limiterKey);

            $request->session()->regenerate();

            return redirect()->to(route('dashboard', [], false));
        }

        RateLimiter::hit($limiterKey, $lockoutSeconds);

        return back()
            ->withErrors([
                'login' => 'Name/Email or Password is incorrect!',
            ])
            ->onlyInput('login');
    }

    // 3. Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    // 4. Send Reset Link - admin table only
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists((new Admin)->getTable(), 'mailid')],
        ], [
            'email.exists' => 'No admin account found with this email.',
        ]);

        $admin = Admin::whereRaw('LOWER(mailid) = ?', [mb_strtolower($request->input('email'))])->firstOrFail();

        $token = Str::random(60);

        $admin->reset_token = Hash::make($token);
        $admin->reset_token_created_at = now();
        $admin->save();

        $resetLink = route('password.reset', [
            'token' => $token,
            'email' => $admin->email,
        ]);

        try {
            Mail::raw(
                "Hello {$admin->name},\n\n"
                ."Click the link below to reset your password:\n\n"
                .$resetLink
                ."\n\nIf you did not request this, ignore this email.",
                function ($message) use ($admin) {
                    $message->to($admin->email)
                        ->subject('Admin Password Reset');
                }
            );
        } catch (\Throwable $e) {
            report($e);

            return back()->withErrors([
                'email' => 'Unable to send the reset email. Please check mail configuration.',
            ]);
        }

        return back()->with(
            'status',
            'Password reset link sent to your registered email.'
        );
    }

    // 5. Show Reset Password Form
    public function showResetForm(Request $request, $token)
    {
        return view('admin.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // 6. Reset Password - admin table only
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', $this->passwordRule()],
        ]);

        $admin = Admin::whereRaw('LOWER(mailid) = ?', [mb_strtolower($request->input('email'))])->first();

        if (
            ! $admin instanceof Admin ||
            ! $admin->reset_token ||
            ! Hash::check($request->token, $admin->reset_token)
        ) {
            return back()->withErrors([
                'email' => 'Invalid or expired token!',
            ]);
        }

        if (! $admin->reset_token_created_at) {
            return back()->withErrors([
                'email' => 'Reset link expired. Please request a new link.',
            ]);
        }

        $createdAt = Carbon::parse($admin->reset_token_created_at);

        if ($createdAt->lt(now()->subMinutes(60))) {
            return back()->withErrors([
                'email' => 'Reset link expired. Please request a new link.',
            ]);
        }

        $admin->password = Hash::make($request->password);
        $admin->reset_token = null;
        $admin->reset_token_created_at = null;
        $admin->save();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Password reset successfully. Please login again.'
            );
    }

    // 7. Show Change Password Form
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    // 8. Update Password - admin table only
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'confirmed'],
        ], [
            'new_password.required' => 'New password is required.',
            'new_password.confirmed' => 'The confirmation password does not match.',
        ]);

        $admin = Auth::guard('admin')->user();

        abort_unless($admin instanceof Admin, 403);

        DB::table('admin')
            ->where('id', $admin->getAuthIdentifier())
            ->update([
                'password' => Hash::make($request->new_password),
                'updated_date' => now(),
            ]);

        return back()->with(
            'success',
            'Password updated successfully!'
        );
    }

    // 9. Admin Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }

    private function securitySetting(string $key, mixed $default): mixed
    {
        if (! Schema::hasTable('app_settings')) {
            return $default;
        }

        $value = DB::table('app_settings')->where('setting_key', $key)->value('setting_value');

        return $value === null ? $default : json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }

    private function passwordRule(): Password
    {
        $rule = Password::min((int) $this->securitySetting('minimum_password_length', 8));
        $extraRules = [];

        if ($this->securitySetting('require_uppercase', true)) {
            $extraRules[] = 'regex:/[A-Z]/';
        }
        if ($this->securitySetting('require_lowercase', true)) {
            $extraRules[] = 'regex:/[a-z]/';
        }
        if ($this->securitySetting('require_number', true)) {
            $rule->numbers();
        }
        if ($this->securitySetting('require_special_character', false)) {
            $rule->symbols();
        }
        if ($extraRules !== []) {
            $rule->rules($extraRules);
        }

        return $rule;
    }
}
