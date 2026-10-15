<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminAuthController extends Controller
{
    // 1. Show Login Page
    public function showLoginForm()
    {
        // Login page always open avuthundi
        return view('admin.login');
    }

    // 2. Admin Login
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);

        $loginInput = trim($request->login);

        // Name or Email tho user ni search cheyyadam
        $user = User::where('email', $loginInput)
            ->orWhere('name', $loginInput)
            ->first();

        // User dorikithe password verify cheyyadam
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            return redirect()->route('dashboard');
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

    // 4. Send Reset Link

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No admin account found with this email.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with this email.',
            ]);
        }

        $token = Str::random(60);

        $user->reset_token = Hash::make($token);
        $user->reset_token_created_at = now();
        $user->save();

        $resetLink = route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ]);

        try {
            Mail::raw(
                "Hello {$user->name},\n\n"
                . "Click the link below to reset your password:\n\n"
                . $resetLink
                . "\n\nIf you did not request this, ignore this email.",
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Admin Password Reset');
                }
            );
        } catch (\Exception $e) {
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

    // 6. Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (
            !$user || !$user->reset_token ||
            !Hash::check($request->token, $user->reset_token)
        ) {
            return back()->withErrors([
                'email' => 'Invalid or expired token!',
            ]);
        }

        // Optional expiry check: 60 minutes
        if (
            !$user->reset_token_created_at ||
            now()->diffInMinutes($user->reset_token_created_at) > 60
        ) {
            return back()->withErrors([
                'email' => 'Reset link expired. Please request a new link.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->reset_token_created_at = null;
        $user->save();

        return redirect()
            ->route('login')
            ->with('success', 'Password reset successfully. Please login again.');
    }

    // 7. Show Change Password Form
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    // 8. Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.different' => 'New password must be different from the current password.',
            'new_password_confirmation.same' => 'The confirmation password does not match.',
        ]);

        $user = Auth::user();

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The password you entered is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with(
            'success',
            'Password updated successfully!'
        );
    }

    // 9. Admin Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }
}
