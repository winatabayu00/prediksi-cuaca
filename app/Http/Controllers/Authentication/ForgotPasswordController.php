<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Dentro\Yalr\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

#[Attributes\Prefix('auth')]
#[Attributes\Name('auth', false, true)]
class ForgotPasswordController extends Controller
{
    #[Attributes\Get('forgot-password', 'forgot-password.form')]
    public function showForgotForm(Request $request)
    {
        return view('pages.authentication.forgot-password');
    }

    #[Attributes\Post('forgot-password', 'forgot-password')]
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => hash('sha256', $token),
                'created_at' => now()
            ]
        );

        $resetLink = url("auth/reset-password?token={$token}&email={$request->email}");

        Mail::send('emails.reset', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Anda');
        });

        successToast('Link reset password telah dikirim ke email Anda.');
        return redirect()->route('auth.login');
    }


}
