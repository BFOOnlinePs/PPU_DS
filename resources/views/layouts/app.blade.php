<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('en') ? 'ltr' : 'rtl' }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="pixelstrap">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" href="{{ asset('assets/images/ds-ppu.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/ds-ppu.png') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/prism.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--added by Noor for surveys -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        @font-face {
            font-family: 'Tajawal';
            src: url({{ asset('assets/fonts/tajawal/Tajawal-Regular.ttf') }}) format('truetype');
            font-weight: normal;
        }

        /* @font-face {
            font-family: 'Tajawal';
            src: url({{ asset('/fonts/tajawal/Tajawal-Bold.ttf') }}) format('truetype');
            font-weight: bold;
        } */

        .page-main-header .main-header-right .left-menu-header {
            padding: 24px 10px;
        }

        p,
        b,
        div,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Tajawal', sans-serif !important;
        }

        /* Add this style to your CSS file or in a style tag in your HTML */
        .left-menu-header {
            display: flex;
            flex-direction: row;
            /* This makes the children flow horizontally */
            align-items: center;
            /* Optional: Align children vertically in the center */
        }

        .page-body {

            margin-top: 90px !important;
        }

        .nav-link:hover {

            background-color: #EF681A !important;
            color: #ef681a !important;
        }

        .nav-link svg {
            height: 16px;

        }

        .page-wrapper.compact-wrapper .page-body-wrapper header.main-nav .main-navbar .nav-menu {
            height: calc(100vh) !important;
        }

        /* Smooth scroll and custom scrollbar for the entire page */
html {
  scroll-behavior: smooth; /* Enable smooth scrolling */
  overflow-y: scroll; /* Ensure vertical scroll if needed */
}

/* Custom Scrollbar for the entire HTML page */
html::-webkit-scrollbar {
  width: 5px; /* Vertical scrollbar width */
  height: 5px; /* Horizontal scrollbar height */
}

html::-webkit-scrollbar-track {
  background: transparent; /* Scrollbar track background */
}

html::-webkit-scrollbar-thumb {
  background: #888; /* Scrollbar thumb color */
  border-radius: 10px; /* Rounded scrollbar */
}

html::-webkit-scrollbar-thumb:hover {
  background: #555; /* Scrollbar thumb color on hover */
}

/* Firefox custom scrollbar for the entire page */
html {
  scrollbar-width: thin; /* Make scrollbar thin */
  scrollbar-color: #888 transparent; /* Thumb and track colors */
}

/* Smooth scroll for #mainnav */
#mainnav {
  scroll-behavior: smooth;
  overflow-y: scroll; /* Enable vertical scroll within this element */
  max-height: 400px; /* Set height to enable scrolling */
  border: 1px solid #ccc;
  padding: 10px;
}

/* Custom Scrollbar for #mainnav */
#mainnav::-webkit-scrollbar {
  display: none; /* Hide scrollbar */
}

#mainnav::-webkit-scrollbar-track {
  background: transparent;
}

#mainnav::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

#mainnav::-webkit-scrollbar-thumb:hover {
  background: #555;
}

/* Firefox custom scrollbar for #mainnav */
#mainnav {
  scrollbar-width: none;
  scrollbar-color: #888 transparent;
  overflow-y: scroll; /* Ensure vertical scrolling is enabled */
  max-height: 400px; /* Set a height to enable scrolling */

}
    </style>

    @yield('style')
</head>

<body class="{{ app()->isLocale('en') ? 'ltr' : 'rtl' }}">
    @include('project.admin.settings.styles')
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper compact-sidebar" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.navbar')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('layouts.sidebar')
            <!-- Page Sidebar Ends-->
            @include('layouts.content')
            <!-- footer start-->
            @include('layouts.footer')
        </div>
    </div>
    <!-- latest jquery-->

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    {{-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> --}}
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- login js-->
    <!-- Plugin used-->
    @yield('script')
</body>

</html>
