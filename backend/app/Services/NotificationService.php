<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class NotificationService
{
    public function sendEmail(
        string $to,
        string $subject,
        string $message
    ): bool {
        try {
            Mail::raw($message, function ($mail) use ($to, $subject) {
                $mail->to($to)->subject($subject);
            });

            return true;
        } catch (Throwable $e) {
            Log::error('Email sending failed', [
                'recipient' => $to,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
