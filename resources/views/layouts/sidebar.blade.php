<header class="main-nav">
    <nav>
        <div class="main-navbar">
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i
                                class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown"><a class="nav-link" href="../theme/index.html"
                            target="_blank"><i data-feather="home"></i><span>الرئيسية</span></a></li>

                    <li class="dropdown"><a class="nav-link" href="{{route('browse.users')}}"
                            target="_blank"><i data-feather="user"></i><span>ادارة المستخدمين</span></a></li>

                    <li class="dropdown"><a class="nav-link" href="{{route('admin.majors.index')}}"><i

                    <li class="dropdown"><a class="nav-link menu-title" href="{{route('admin.majors.index')}}"><i
                                data-feather="anchor"></i><span>إدارة التخصصات</span></a>
                    </li>

                        <ul class="nav-submenu menu-content">
                            {{-- <li><a class="submenu-title" href="javascript:void(0)">color version<span
                                        class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="index.html">Layout Light</a></li>
                                    <li><a href="layout-dark.html">Layout Dark</a></li>
                                </ul>
                            </li> --}}
                            {{-- <li> <a class="submenu-title" href="javascript:void(0)">Page layout<span
                                        class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="boxed.html">Boxed</a></li>
                                    <li><a href="layout-rtl.html">RTL </a></li>
                                </ul>
                            </li>
                            <li> <a class="submenu-title" href="javascript:void(0)">Footers<span
                                        class="sub-arrow"><i class="fa fa-chevron-right"></i></span></a>
                                <ul class="nav-sub-childmenu submenu-content">
                                    <li><a href="footer-light.html">Footer Light</a></li>
                                    <li><a href="footer-dark.html">Footer Dark</a></li>
                                    <li><a href="footer-fixed.html">Footer Fixed</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- <li class=""><a class="nav-link menu-title" href="{{route('users')}}"><i data-feather="users"></i><span>إدارة المساقات</span></a></li> --}}
                    <li class="dropdown"><a class="nav-link" href="{{route('admin.courses.index')}}"><i data-feather="book"></i><span>إدارة المساقات</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
