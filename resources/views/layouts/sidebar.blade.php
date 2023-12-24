<header class="main-nav">
    <nav>
        <div class="sidebar-user text-center">
                <img class="img-90 rounded-circle"
                src="https://laravel.pixelstrap.com/viho/assets/images/dashboard/1.png" alt="">
            <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
            <a href="user-profile" data-bs-original-title="" title="">
                <h6 class="mt-3 f-14 f-w-600">{{ auth()->user()->name }}</h6>
            </a>
            <p class="mb-0 font-roboto">{{ auth()->user()->email }}</p>
        </div>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    @if(auth()->user()->u_role_id == 2) {{-- Student --}}
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <li class=""><a class="nav-link" href="{{ route('students.personal_profile.index')}}"><i data-feather="user"></i><span>الملف الشخصي</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('students.company.index')}}"><i data-feather="list"></i><span>الشركات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('students.attendance.index')}}"><i data-feather="check"></i><span>سجل الحضور والمغادرة</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('students.payments.index')}}"><i data-feather="dollar-sign"></i><span>الدفعات</span></a></li>
                    @elseif (auth()->user()->u_role_id == 3) {{--- Supervisor --}}
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                            </li>
                        <li class=""><a class="nav-link" href="{{ route('supervisors.majors.index' , ['id' => auth()->user()->u_id])}}"><i
                            data-feather="book-open"></i><span>التخصصات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('supervisors.students.index' , ['id' => auth()->user()->u_id])}}"><i
                            data-feather="users"></i><span>الطلاب</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('supervisors.companies.index') }}"><i
                                data-feather="briefcase"></i><span> أماكن التدريب</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies_categories.index') }}"><i
                                    data-feather="briefcase"></i><span>تصنيف الشركات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies.index') }}"><i
                                    data-feather="briefcase"></i><span>الشركات</span></a></li>
                    @elseif (auth()->user()->u_role_id == 4) {{--- Asisstant --}}
                        <li class="back-btn">
                            <div class="mobile-back text-end">
                                <span>Back</span>
                                <i class="fa fa-angle-right ps-2" aria-hidden="true">
                                </i>
                            </div>
                        </li>
                        <li class="">
                            <a class="nav-link" href="{{ route('supervisor_assistants.majors.index' , ['id' => auth()->user()->u_id])}}">
                                <i data-feather="book-open">
                                </i>
                                <span>التخصصات</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="nav-link" href="{{route('supervisor_assistants.students.index' , ['ms_major_id' => null])}}">
                                <i data-feather="users">
                                </i>
                                <span>الطلاب</span>
                            </a>
                        </li>
                        <li class="">
                        <a class="nav-link" href="{{route('supervisor_assistants.companies.index') }}">
                            <i data-feather="briefcase"></i>
                            <span> أماكن التدريب</span>
                        </a>
                        </li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies_categories.index') }}"><i
                        data-feather="briefcase"></i><span>تصنيف الشركات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies.index') }}"><i
                        data-feather="briefcase"></i><span>الشركات</span></a></li>
                    @elseif (auth()->user()->u_role_id == 6) {{-- Company manager --}}
                        <li class="back-btn">
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                        </li>
                        <li class=""><a class="nav-link" href="{{route('company_manager.students.index')}}"><i data-feather="users"></i><span>الطلاب</span></a></li>
                        <li class=""><a class="nav-link" href="{{route('company_manager.records.index')}}"><i data-feather="list"></i><span>سجلات المتابعة</span></a></li>
                        <li class=""><a class="nav-link" href="{{route('company_manager.payments.index')}}"><i data-feather="dollar-sign"></i><span>الدفعات</span></a></li>
                    @else
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                        </li>
                        <li class="dropdown"><a class="nav-link" href="{{route('home')}}"><i
                                    data-feather="home"></i><span>الرئيسية</span></a></li>

                        <li class="dropdown"><a href="{{ route('admin.users.index') }}" class="nav-link"><i
                                    data-feather="users"></i><span>إدارة المستخدمين</span></a></li>

                        <li class="dropdown"><a class="nav-link" href="{{ route('admin.majors.index') }}"><i
                                    data-feather="anchor"></i><span>إدارة التخصصات</span></a>
                        </li>
                        <li class=""><a class="nav-link" href="{{ route('admin.courses.index') }}"><i
                                    data-feather="book"></i><span>إدارة المساقات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.semesterCourses.index') }}"><i
                                    data-feather="book"></i><span>مساقات الفصول</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies_categories.index') }}"><i
                                    data-feather="briefcase"></i><span>تصنيف الشركات</span></a></li>
                        <li class=""><a class="nav-link" href="{{ route('admin.companies.index') }}"><i
                                    data-feather="briefcase"></i><span>الشركات</span></a></li>
                    @endif
                    {{-- <li class="dropdown"><a class="nav-link" href="{{ route('admin.majors.index') }}"><i
                                data-feather="anchor"></i><span>إدارة التخصصات</span></a>
                    </li>
                    <li class=""><a class="nav-link" href="{{ route('admin.courses.index') }}"><i
                                data-feather="book"></i><span>إدارة المساقات</span></a></li>
                    <li class=""><a class="nav-link" href="{{ route('admin.semesterCourses.index') }}"><i
                                data-feather="book"></i><span>مساقات الفصول</span></a></li>
                    <li class=""><a class="nav-link" href="{{ route('admin.companies_categories.index') }}"><i
                                data-feather="briefcase"></i><span>تصنيف الشركات</span></a></li>
                    <li class=""><a class="nav-link" href="{{ route('admin.companies.index') }}"><i data-feather="briefcase"></i><span>الشركات</span></a></li> --}}
                </ul>
            </div>
        </div>
    </nav>
</header>
