<div class="mb-0">

    <div class="landing-dark-bg pt-20">

        <div class="landing-dark-separator"></div>

        <div class="container">
            <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                <div class="d-flex align-items-center order-2 order-md-1">

                    <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="{{ route('home') }}">
								&copy; 2025 {{ env('APP_NAME') }}.
							</span>
                </div>

                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                    <li class="menu-item">
                        <a href="{{ route('home') }}" class="menu-link px-2">Beranda</a>
                    </li>

                    <li class="menu-item mx-5">
                        <a href="{{ route('prediksi') }}"
                           class="menu-link px-2">Prediksi</a>
                    </li>

                    <li class="menu-item mx-5">
                        <a href="{{ route('penjadwalan') }}"
                           class="menu-link px-2">Penjadwalan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
