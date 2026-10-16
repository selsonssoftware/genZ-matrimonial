<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

    // 2. Admin Login - admins table only
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($request->input('login'));

        $admin = Admin::where('email', $loginInput)
            ->orWhere('name', $loginInput)
            ->first();

        if (
            $admin &&
            Hash::check($request->input('password'), $admin->password)
        ) {
            Auth::guard('admin')->login(
                $admin,
                $request->boolean('remember')
            );

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

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

    // 4. Send Reset Link - admins table only
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.exists' => 'No admin account found with this email.',
        ]);

        $admin = Admin::where('email', $request->email)->firstOrFail();

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
                . "Click the link below to reset your password:\n\n"
                . $resetLink
                . "\n\nIf you did not request this, ignore this email.",
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

    // 6. Reset Password - admins table only
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (
            !$admin ||
            !$admin->reset_token ||
            !Hash::check($request->token, $admin->reset_token)
        ) {
            return back()->withErrors([
                'email' => 'Invalid or expired token!',
            ]);
        }

        if (!$admin->reset_token_created_at) {
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
        abort_unless(Auth::guard('admin')->check(), 403);

        return view('admin.change-password');
    }

    // 8. Update Password - admins table only
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.different' => 'New password must be different from the current password.',
            'new_password_confirmation.same' => 'The confirmation password does not match.',
        ]);

        $admin = Auth::guard('admin')->user();

        if (
            !$admin ||
            !Hash::check($request->current_password, $admin->password)
        ) {
            return back()->withErrors([
                'current_password' => 'The password you entered is incorrect.',
            ]);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

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
}
