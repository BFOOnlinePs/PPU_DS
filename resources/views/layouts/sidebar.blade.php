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
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown"><a class="nav-link" href="../theme/index.html"><i
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
                </ul>
            </div>
        </div>
    </nav>
</header>
