
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>viho - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/calendar.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">

      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid calendar-basic">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div id="menu">
                          <div id="menu-navi">
                            <div class="menu-navi-left">
                              <button class="btn btn-primary move-today" type="button" data-action="move-today">Today</button>
                            </div>
                            <div class="render-range menu-navi-center" id="renderRange"></div>
                            <div class="menu-navi-right">
                              <button class="btn btn-primary" id="dropdownMenu-calendarType" type="button" data-bs-toggle="dropdown"><i id="calendarTypeIcon"></i><span id="calendarTypeName">Dropdown</span><i class="fa fa-angle-down"></i></button>
                              <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily"><i class="fa fa-bars"></i>Daily</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly"><i class="fa fa-th-large"></i>Weekly</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly"><i class="fa fa-th"></i>Month</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2"><i class="fa fa-th-large"></i>2 weeks</a></li>
                                <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3"><i class="fa fa-th-large"></i>3 weeks</a></li>
                                <li class="dropdown-divider" role="presentation"></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-workweek">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-workweek" checked=""><span class="checkbox-title"></span>Show weekends</a></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-start-day-1">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-start-day-1"><span class="checkbox-title"></span>Start Week on Monday</a></li>
                                <li role="presentation"><a role="menuitem" data-action="toggle-narrow-weekend">
                                    <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-narrow-weekend"><span class="checkbox-title"></span>Narrower than weekdays</a></li>
                              </ul>
                              <div class="move-btn">
                                <button class="btn btn-primary move-day" type="button" data-action="move-prev"><i class="fa fa-angle-left" data-action="move-prev"></i></button>
                                <button class="btn btn-primary move-day" type="button" data-action="move-next"><i class="fa fa-angle-right" data-action="move-next"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="lnb">
                          <div class="lnb-new-schedule">
                            <button class="btn lnb-new-schedule-btn btn-primary" id="btn-new-schedule" type="button" data-bs-toggle="modal">New schedule</button>
                          </div>
                          <div class="lnb-calendars" id="lnb-calendars">
                            <div class="lnb-calendars-d1" id="calendarList"></div>
                            <div class="lnb-calendars-item m-0 p-0">
                              <label>
                                <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked=""><span></span><strong>View all</strong>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div id="right">
                          <div id="calendar"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/calendar/tui-code-snippet.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/tui-time-picker.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/tui-date-picker.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/chance.min.js')}}"></script>
    <script src="{{asset('assets/js/calendar/tui-calendar.js')}}"></script>
    <script src="{{asset('assets/js/calendar/calendars.js')}}"></script>
    <script src="{{asset('assets/js/calendar/schedules.js')}}"></script>
    <script src="{{asset('assets/js/calendar/app.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>
