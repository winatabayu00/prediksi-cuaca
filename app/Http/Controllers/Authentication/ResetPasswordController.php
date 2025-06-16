<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dentro\Yalr\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

#[Attributes\Prefix('auth')]
#[Attributes\Name('auth', false, true)]
class ResetPasswordController extends Controller
{
    #[Attributes\Get('reset-password', 'reset-password.form')]
    public function showForgotForm(Request $request)
    {
        return view('pages.authentication.reset-password');
    }
    #[Attributes\Post('reset-password', 'reset-password')]
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !hash_equals($record->token, hash('sha256', $request->token))) {
            return response()->json(['message' => 'Token tidak valid'], 400);
        }

        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return response()->json(['message' => 'Token sudah kadaluarsa'], 400);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        successToast('Password berhasil direset.');
        return redirect()->route('auth.login');
    }


}
