<div class="toolbar d-flex align-items-stretch">
    <div class="container-xxl py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">

        <div class="page-title d-flex justify-content-center flex-column me-5">
            <h1 class="d-flex flex-column text-gray-900 fw-bold fs-3 mb-0">{{ $pageTitle ?? env('APP_NAME') }}</h1>

        </div>

        <div class="d-flex align-items-stretch overflow-auto pt-3 pt-lg-0">


            @include('layouts.blocks.navbar')

        </div>
    </div>
</div>
