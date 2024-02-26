<div class="page-main-header">
    <div class="main-header-right row m-0">
      <div class="main-header-left">
          <h6 style="margin-bottom: 0px;">{{__('translate.Dual Studies College')}}</h6>
        <div class="logo-wrapper">
            <img class="img-fluid" src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a>
        </div>
        <div class="dark-logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('assets/images/logo/dark-logo.png')}}" alt=""></a></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
      </div>

      <div class="nav-right col pull-right right-menu p-0">
        <ul class="nav-menus">
          <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>

          <li class="onhover-dropdown p-0">
            <a class="btn btn-primary-light" style="font-size: 12px" href="{{route('language' , 'en')}}">English</a>
            <a class="btn btn-primary-light" style="font-size: 12px" href="{{route('language' , 'ar')}}">عربي</a>
            <a class="btn btn-primary-light" style="font-size: 12px" href="#"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{__('translate.Log out')}} {{-- تسجيل الخروج --}}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        </ul>
      </div>
      <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
  </div>
