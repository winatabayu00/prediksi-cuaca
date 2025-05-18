<div class="header-brand">
    <a href="#">
        <h3 class="text-white fs-1 fw-bold">{{ env('APP_NAME') }}</h3>
    </a>

    <div id="kt_aside_toggle"
         class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize"
         data-kt-toggle="true"
         data-kt-toggle-state="active"
         data-kt-toggle-target="body"
         data-kt-toggle-name="aside-minimize">

        <i class="fas fa-angle-double-left fs-1 me-n1 minimize-default"></i>

        <i class="fas fa-angle-double-right fs-1 minimize-active"></i>
    </div>

    <div class="d-flex align-items-center d-lg-none me-n2" title="Show aside menu">
        <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
            <i class="fas fa-bars fs-1"></i>
        </div>
    </div>
</div>
