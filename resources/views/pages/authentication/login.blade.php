@extends('layouts.guest')

@section('content')
    <div class="d-flex flex-column flex-lg-row flex-column-fluid justify-content-center">
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-start p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                        <form class="form w-100" action="{{ route('auth.login') }}" method="post">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="fw-bolder mb-3">
                                    {{ __('MASUK') }}
                                </h1>

                                <div class=" fw-semibold fs-6">
                                    {{ __('Masuk ke akun anda') }}
                                </div>
                            </div>

                            <div class="separator separator-content my-14"></div>

                            <div class="fv-row mb-8">
                                <input type="text" placeholder="{{ __('Email') }}" name="email" autocomplete="off"
                                       class="form-control bg-transparent" value="{{ old('email') }}"/>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="fv-row mb-3">
                                <input type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="off"
                                       class="form-control bg-transparent" />
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>

                                <a href="{{ route('auth.forgot-password.form') }}" class="link-primary">
                                    Lupa Kata Sandi ?
                                </a>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">

                                    <span class="indicator-label">
                                        {{ __('MASUK') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class=" d-flex flex-stack">
                        <div class="me-10">
                        </div>
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2024&copy;</span>
                            <a href="/" target="_blank" class="text-gray-800 text-hover-primary">{{ env('APP_NAME') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
