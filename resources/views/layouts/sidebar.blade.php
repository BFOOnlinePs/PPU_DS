<header class="main-nav">
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown"><a class="nav-link" href="../theme/index.html"><i
                                data-feather="home"></i><span>الرئيسية</span></a></li>

                    <li class="dropdown"><a href="{{route('admin.users.index')}}" class="nav-link"><i
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
                </ul>
            </div>
        </div>
    </nav>
</header>
