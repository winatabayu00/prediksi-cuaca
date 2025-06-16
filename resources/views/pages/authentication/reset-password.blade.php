@extends('layouts.guest')

@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid justify-content-center">
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-start p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="text-center mb-11">
                        <h1 class="fw-bolder mb-3">{{ __('Reset Password') }}</h1>
                        <div class="fw-semibold fs-6">{{ __('Masukkan password baru anda.') }}</div>
                    </div>

                    <form method="POST" action="{{ url('auth/reset-password') }}" class="form w-100">
                        @csrf

                        <input type="hidden" name="token" value="{{ request('token') }}">
                        <input type="hidden" name="email" value="{{ request('email') }}">

                        <div class="fv-row mb-8">
                            <input type="password" name="password" class="form-control bg-transparent"
                                   placeholder="{{ __('Password Baru') }}" required>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-8">
                            <input type="password" name="password_confirmation" class="form-control bg-transparent"
                                   placeholder="{{ __('Konfirmasi Password') }}" required>
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                        </div>
                    </form>

                    <div class="text-center">
                        <a href="{{ route('auth.login') }}" class="text-muted">{{ __('Kembali ke login') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
