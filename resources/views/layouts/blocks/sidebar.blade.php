<div class="aside-menu flex-column-fluid">
    <div class="hover-scroll-overlay-y mx-3 my-5 my-lg-5" id="kt_aside_menu_wrapper"
         data-kt-scroll="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
         data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">

        <div
            class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="#kt_aside_menu" data-kt-menu="true">

            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                </div>
            </div>

            <!-- Dashboard -->
            <div class="menu-item menu-accordion">
                <a href="{{ route('admin.dashboard.index') }}" class="menu-link {{ Route::is('admin.dashboard.index') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-house fs-2"></i>
                    </span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>

            <!-- Prediksi -->
            <div class="menu-item menu-accordion">
                <a href="{{ route('admin.prediksi.index') }}" class="menu-link {{ Route::is('admin.prediksi.index') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-brain fs-2"></i>
                    </span>
                    <span class="menu-title">Prediksi</span>
                </a>
            </div>

            <!-- Penjadwalan -->
            <div class="menu-item menu-accordion">
                <a href="{{ route('admin.penjadwalan.index') }}" class="menu-link {{ Route::is('admin.penjadwalan.index') ? 'active' : '' }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-clock fs-2"></i>
                    </span>
                    <span class="menu-title">Penjadwalan</span>
                </a>
            </div>

        </div>
    </div>
</div>
