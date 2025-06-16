@extends('layouts.guest')

@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid justify-content-center">
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-start p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="text-center mb-11">
                        <h1 class="fw-bolder mb-3">{{ __('Lupa Password') }}</h1>
                        <div class="fw-semibold fs-6">{{ __('Masukkan email anda untuk menerima link reset password.') }}</div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ url('auth/forgot-password') }}" class="form w-100">
                        @csrf

                        <div class="fv-row mb-8">
                            <input type="email" name="email" class="form-control bg-transparent"
                                   placeholder="{{ __('Email') }}" required value="{{ old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" class="btn btn-primary">{{ __('Kirim Link Reset Password') }}</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('auth.login') }}" class="text-muted">{{ __('Kembali ke login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
