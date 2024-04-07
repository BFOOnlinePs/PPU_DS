<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('assets/images/dashboard/1.png')}}" alt="">
      <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
        <h6 class="mt-3 f-14 f-w-600">{{auth::user()->name}}</h6></a>
    </div>
    <nav>
        <div class="main-navbar">

            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                <div id="mainnav">
                    <ul class="nav-menu custom-scrollbar">
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        @if(auth()->user()->u_role_id == 1) {{-- admin --}}
                            <li><a class="nav-link" href="{{route('admin.users.index')}}"><i data-feather="users"></i><span>{{__('translate.Users Management')}}{{-- المستخدمين --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.majors.index')}}"><i data-feather="book-open"></i><span>{{__('translate.Majors Management')}}{{-- التخصصات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.courses.index')}}"><i data-feather="book"></i><span>{{__('translate.Courses')}}{{-- التدريبات العملية --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.attendance_and_departure_report_index')}}"><i data-feather="clock"></i data-feather=><span>{{__('translate.Student Attendance')}}{{-- سجل الحضور والمغادرة --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Companies')}}{{-- الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.registration.index')}}"><i data-feather="user-check"></i><span>{{__('translate.Registration')}}{{-- التسجيل --}}</span></a></li>
{{--                            <li><a class="nav-link" href="{{route('admin.attendance.index')}}"><i data-feather="user-check"></i><span>{{__('translate.Student Attendance')}}--}}{{-- سجل الحضور والمغادرة --}}{{--</span></a></li>--}}
                            <li><a class="nav-link" href="{{ route('admin.settings') }}"><i data-feather="settings"></i><span>{{__('translate.Settings')}}{{-- الإعدادات --}}</span></a></li>
                        @elseif(auth()->user()->u_role_id == 2) {{-- Student --}}
                            <li><a class="nav-link" href="{{route('students.personal_profile.index')}}"><i data-feather="user"></i><span>{{__('translate.Profile')}}{{-- الملف الشخصي --}}</span></a></li>
                            <li><a class="nav-link" href="{{ route('students.company.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Companies')}}{{-- الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('students.attendance.index')}}"><i data-feather="check"></i><span>{{__('translate.Attendance Logs')}}{{-- سجلات المتابعة --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('students.payments.index')}}"><i data-feather="dollar-sign"></i><span>{{__('translate.Payments')}}{{-- الدفعات --}}</span></a></li>
                        @elseif (auth()->user()->u_role_id == 3) {{-- Supervisor --}}
                            <li><a class="nav-link" href="{{route('supervisors.majors.index' , ['id' => auth()->user()->u_id])}}"><i data-feather="book-open"></i><span>{{__('translate.Majors')}}{{-- التخصصات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisors.students.index' , ['id' => auth()->user()->u_id])}}"><i data-feather="users"></i><span>{{__('translate.Students')}}{{-- الطلاب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisors.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Training Places')}}{{-- أماكن التدريب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Companies')}}{{-- الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisors.training_nominations.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.training_nominations')}}{{-- ترشيحات التدريب --}}</span></a></li>
                        @elseif (auth()->user()->u_role_id == 4) {{-- Assistant --}}
                            <li><a class="nav-link" href="{{route('supervisor_assistants.majors.index' , ['id' => auth()->user()->u_id])}}"><i data-feather="book-open"></i><span>{{__('translate.Majors')}}{{-- التخصصات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisor_assistants.students.index' , ['ms_major_id' => null])}}"><i data-feather="users"></i><span>{{__('translate.Students')}}{{-- الطلاب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisor_assistants.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Training Places')}}{{-- أماكن التدريب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('admin.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Companies')}}{{-- الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisors.training_nominations.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.training_nominations')}}{{-- ترشيحات التدريب --}}</span></a></li>
                        @elseif (auth()->user()->u_role_id == 5) {{-- M&E --}}
                            <li><a class="nav-link" href="{{route('home')}}"><i data-feather="home"></i><span>{{__('translate.Main')}}{{-- الرئيسية --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.semesterReport')}}"><i data-feather="calendar"></i><span>{{__('translate.Reports')}}{{-- تقارير --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.companiesReport')}}"><i data-feather="briefcase"></i data-feather=><span>{{__("translate.Companies' Report")}}{{-- تقرير الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.attendance_and_departure_report_index')}}"><i data-feather="clock"></i data-feather=><span>{{__("translate.Student Attendance")}}{{-- تقرير الحضور والمغادرة --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.companiesPaymentsReport')}}"><i data-feather="users"></i data-feather=><span>{{__("translate.Companies Payments' Report")}}{{-- تقرير دفعات الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('monitor_evaluation.paymentsReport')}}"><i data-feather="dollar-sign"></i data-feather=><span>{{__("translate.Payments' Report")}}{{-- تقرير الدفعات المالية --}}</span></a></li>
                        @elseif (auth()->user()->u_role_id == 6) {{-- Company Manager --}}
                            <li><a class="nav-link" href="{{route('company_manager.students.index')}}"><i data-feather="users"></i><span>{{__('translate.Students')}}{{-- الطلاب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('company_manager.records.index')}}"><i data-feather="list"></i><span>{{__('translate.Attendance Logs')}}{{-- سجلات المتابعة --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('company_manager.attendance.index')}}"><i data-feather="user-check"></i><span>{{__('translate.Student Attendance')}}{{-- سجل الحضور والمغادرة --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('company_manager.student_nominations.index')}}"><i data-feather="user-check"></i><span>{{__('translate.student_nominations')}}{{-- ترشيحات التدريب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('company_manager.payments.index')}}"><i data-feather="dollar-sign"></i><span>{{__('translate.Payments')}}{{-- الدفعات --}}</span></a></li>
                        @elseif (auth()->user()->u_role_id == 8) {{-- Communications Manager with Companies --}}
                            <li><a class="nav-link" href="{{route('admin.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Companies')}}{{-- الشركات --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('communications_manager_with_companies.students.index')}}"><i data-feather="users"></i><span>{{__('translate.Students')}}{{-- الطلاب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('communications_manager_with_companies.companies.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.Training Places')}}{{-- أماكن التدريب --}}</span></a></li>
                            <li><a class="nav-link" href="{{route('supervisors.training_nominations.index')}}"><i data-feather="briefcase"></i><span>{{__('translate.training_nominations')}}{{-- ترشيحات التدريب --}}</span></a></li>
                            @endif
                        @if (auth()->user()->u_role_id != 2 && auth()->user()->u_role_id !=6 ) 
                        <li><a class="nav-link" href="{{route('admin.announcements.index')}}"><i data-feather="inbox"></i><span>{{__('translate.announcements')}}{{--  الاعلانات --}}</span></a></li>
                         @endif
                        <li><a class="nav-link" href="{{route('admin.survey.index')}}"><i data-feather="clipboard"></i><span>{{__('translate.surveys')}}{{--  الاستبيانات --}}</span></a></li>
                        <!-- <li class="dropdown-basic">
                     <div class="dropdown">
                         <div class="dropbtn">
                            <a class="nav-link" href="{{ route('admin.survey.index') }}">
                                <i data-feather="clipboard"></i>
                                <span>{{__('translate.Survey')}}</span>
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ route('admin.survey.index') }}">{{__('translate.surveys')}}</a>
                                @if(auth()->user()->u_role_id !=2 )    <a href="{{ route('admin.survey.addSurvey') }}">{{__('translate.add_survey')}}</a> @endif
                                {{-- <a href="{{ route('admin.registration.semesterStudents') }}">{{__("translate.Current Semester's Students")}}</a>--}}
                            </div>
                        </div>
                     </div>
                 </li> -->
                    </ul>
                </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
