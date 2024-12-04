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
                    <p style="font-size: 10px" class="text-center text-white mt-2 text-bold">{{ auth()->user()->name }}
                    </p>
                </li>
                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="onhover-dropdown  btn p-1 btn-xs">
                    <div class="notification-box text-center"><svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg><span class="dot-animated"></span></div>
                    <ul class="-drnotificationopdown onhover-show-div list-group" style="width: 500px">
                        <li class="list-group-item">
                            <p class="f-w-700 m-0">You have 3 Notifications<span
                                    class="pull-right badge badge-primary badge-pill">4</span></p>
                        </li>
                        <li class="noti-primary list-group-item"> <a href="/viho/app/email/mailbox">
                                <div class="media"><span class="notification-bg bg-light-primary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                        </svg></span>
                                    <div class="media-body">
                                        <p>Delivery processing </p><span>10 minutes ago</span>
                                    </div>
                                </div>
                            </a></li>
                        <li class="noti-secondary list-group-item"> <a href="/viho/app/email/mailbox">
                                <div class="media"><span class="notification-bg bg-light-secondary"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg></span>
                                    <div class="media-body">
                                        <p>Order Complete</p><span>1 hour ago</span>
                                    </div>
                                </div>
                            </a></li>
                        <li class="noti-success list-group-item"> <a href="/viho/app/email/mailbox">
                                <div class="media"><span class="notification-bg bg-light-success"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg></span>
                                    <div class="media-body">
                                        <p>Tickets Generated</p><span>3 hour ago</span>
                                    </div>
                                </div>
                            </a></li>
                        <li class="noti-danger list-group-item"> <a href="/viho/app/email/mailbox">
                                <div class="media"><span class="notification-bg bg-light-danger"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <polyline points="17 11 19 13 23 9"></polyline>
                                        </svg></span>
                                    <div class="media-body">
                                        <p>Delivery Complete</p><span>6 hour ago</span>
                                    </div>
                                </div>
                            </a></li>
                    </ul>
                </li>
                <li class="onhover-dropdown p-0">
                    <a class="btn btn-light btn-xs" href="{{ route('language', 'en') }}">EN</a>
                    <a class="btn btn-light btn-xs" href="{{ route('language', 'ar') }}">ع</a>
                    <a class="btn btn-danger btn-xs" href="#"
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
                    <h3 class="text-white"><a href="{{ route('home') }}" class="text-white">البوابة الالكترونية ::
                            كلية
                            الدراسات
                            الثنائية</a></h3>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
