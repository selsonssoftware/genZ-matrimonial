<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class MailTestController extends Controller
{
    public function index()
    {
        return view('admin.mail-test');
    }

    public function send(Request $request, NotificationService $notification)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $sent = $notification->sendEmail(
            $validated['email'],
            'Laravel Email Test',
            'Success! Your Laravel Gmail SMTP setup is working.'
        );

        if (!$sent) {
            return back()->with(
                'error',
                'Email failed. Please check your SMTP configuration and logs.'
            );
        }

        return back()->with(
            'success',
            'Test email sent successfully. Please check your inbox and spam folder.'
        );
    }
}
