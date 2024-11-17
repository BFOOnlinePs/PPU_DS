<div class="page-main-header">
    <div class="main-header-right row m-0"
        style="background-image: url('{{ asset('assets/images/img/header_bg.jpg') }}')">
        <div class="main-header-left">
            {{-- <h6 style="margin-bottom: 0px;">{{__('translate.Dual Studies College')}}</h6> --}}
            <div class="logo-wrapper">
                <a href="{{ route('home') }}">
                    <img class="img-fluid" src="{{ asset('assets/images/logo/logo_ds2.png') }}" alt="">
                </a>
            </div>
            <div class="dark-logo-wrapper"><a href="index.html"><img class="img-fluid"
                        src="{{ asset('assets/images/logo/dark-logo.png') }}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle text-white" data-feather="align-center"
                    id="sidebar-toggle"></i></div>
        </div>

        <div class="nav-right col pull-right right-menu p-0">
            <ul style="float: left" class="nav-menus mt-3">
                <li>
                    <p style="font-size: 10px" class="text-center text-white mt-2 text-bold">{{ auth()->user()->name }}</p>
                </li>
                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="onhover-dropdown p-0">
                    <a class="btn btn-light" style="font-size: 12px" href="{{ route('language', 'en') }}">English</a>
                    <a class="btn btn-light" style="font-size: 12px" href="{{ route('language', 'ar') }}">عربي</a>
                    <a class="btn btn-danger" style="font-size: 12px" href="#"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('translate.Log out') }} {{-- تسجيل الخروج --}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <ul style="float: right" class="nav-menus">
                <li class="mt-2">
                    <h3 class="text-white"><a href="{{ route('home') }}" class="text-white">البوابة الالكترونية :: كلية
                            الدراسات
                            الثنائية</a></h3>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
