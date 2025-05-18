<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Request\Authentication\LoginRequest;
use App\Models\User;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Winata\Core\Response\Exception\BaseException;

#[Attributes\Prefix('auth')]
#[Attributes\Name('auth', false, true)]
class LoginController extends Controller
{
    /**
     * @return View
     */
    #[Attributes\Get('login', 'login')]
    public function loginView(): View
    {
        return $this->view('pages.authentication.login');
    }

    /**
     * @throws BaseException
     * @throws ValidationException
     */
    #[Attributes\Post('login')]
    public function doLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard.index'));

    }


    /**
     * @return View
     */
    #[Attributes\Get('register', 'register')]
    public function registerView(): View
    {
        return $this->view('pages.authentication.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    #[Attributes\Post('register')]
    public function doRegister(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);

        successToast('Berhasil melakukan pendaftaran akun');
        return redirect()->route('auth.login');
    }

    /**
     * Destroy an authenticated session.
     */
    #[Attributes\Delete('logout', 'logout')]
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.login'));
    }
}
