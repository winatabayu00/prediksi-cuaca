<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"
/

<head>
    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8"/>
    <meta name="description" content="
            The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        "/>
    <meta name="keywords" content="
            tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        "/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="{{ env('APP_NAME') }}"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Metronic by Keenthemes"/>


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>

    @include('includes.styles')
</head>


<body id="kt_body" class="aside-enabled">

<script>
    var defaultThemeMode = "light";
    var themeMode;

    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }

        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }

        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>

<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
             data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
             data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
             data-kt-drawer-toggle="#kt_aside_mobile_toggle">

            @include('layouts.blocks.sidebar-top')
            @include('layouts.blocks.sidebar')
        </div>
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <div id="kt_header" style="" class="header  align-items-stretch">
                @include('layouts.blocks.header')

                @include('layouts.blocks.header-toolbar')
            </div>
            <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <div id="kt_content_container" class=" container-xxl ">
                        @yield('page-content')
                    </div>
                </div>
            </div>

            @include('layouts.blocks.footer')

        </div>
    </div>
</div>

<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
</div>


@include('includes.scripts')
</body>


</html>
