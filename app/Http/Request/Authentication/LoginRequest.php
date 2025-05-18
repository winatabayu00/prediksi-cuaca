<?php

namespace App\Http\Request\Authentication;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Winata\Core\Response\Enums\DefaultResponseCode;
use Winata\Core\Response\Exception\BaseException;

class LoginRequest extends FormRequest
{

    public string $loginUsing = 'username';

    /**
     * @var array|string[]
     */
    protected array $allowLoginMethod = [
        'username', 'phone', 'email'
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     * @throws BaseException
     */
    public function rules(): array
    {
        // check login method
//        if ($this->hasHeader('login_using')) {
//            $this->loginUsing = $this->header('login_using');
//        }
//        if (!in_array($this->loginUsing, $this->allowLoginMethod)) {
//            throw new BaseException(rc: ResponseCode::ERR_INVALID_LOGIN_METHOD);
//        }
        return [
//            'dial' => [Rule::requiredIf(($this->loginUsing == 'phone')), 'string'],
//            'phone' => [Rule::requiredIf(($this->loginUsing == 'phone')), 'string'],
//            'username' => [Rule::requiredIf(($this->loginUsing == 'username')), 'string'],
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws BaseException
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

//        $login = $this->input($this->loginUsing);
//        if ($this->loginUsing == 'phone') {
//            $login = sanitizePhone(phone: $this->input('phone'), dial: $this->input('dial'));
//        }

        /** @var User $userToLogin */
        $userToLogin = User::query()
            ->where('email', '=', $this->input('email'))
            ->first();

        if (empty($userToLogin)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => "Your account is not registered",
            ]);
        }

        if (!Hash::check($this->input(['password']), $userToLogin->password)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'password' => 'Invalid password!',
            ]);
        }

        Auth::guard('web')->login($userToLogin);

        if (!Auth::check()) {
            throw new BaseException(rc: DefaultResponseCode::ERR_AUTHENTICATION, message: 'Failed to login');
        }


//        $this->updateLastLogin();
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }

    protected function updateLastLogin(): void
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $user->last_login_at = now();
            $user->save();
        }
    }
}
