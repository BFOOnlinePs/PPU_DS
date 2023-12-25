<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>viho - Premium Admin Template</title>
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        .column {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .text {
            /* font-size: 24px; */
            margin-bottom: 20px;
        }

        .photo {
            width: 270px;
            /* Adjust the width of the photo as needed */
            height: 270px;
        }

        @font-face {
            font-family: 'Tajawal';
            src: url(http://localhost/befound/PPU_DS/public/fonts/tajawal/Tajawal-Regular.ttf) format('truetype');
            font-weight: normal;
        }

        * {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->

    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid">
            <div class="row" style="
    background-color: red;
    background-color: #f5f6f9;
">
                <div class="col-xl-6 b-center"
                    style="
    /* place-items: center; */
    align-content: center;
    /* display: flex; */
    /* justify-content: center; */
    background-color: white;
">



                    <div class="column">
                        <h1 class="text">الدراسات الثنائية</h1>
                        <h3 class="text">جامعة بوليتكنك فلسطين</h3>
                        <img class="photo" src="{{ asset('assets/images/ds-ppu.png') }}" alt="Centered Photo">
                        <br>
                    </div>




                </div>

                <div class="col-xl-6 p-0">
                    <div class="login-card" style="
    height: 450px; background-color: rgb(36 105 92 / 0%);">
                        <form class="theme-form login-form shadow-sm mb-5 bg-white" method="POST"
                            action="{{ route('login') }}"
                            style="
    /* padding-bottom: 100px; */
    /* padding-top: 100px; */
    height: 350px;
    border-radius: 10px;
    /* padding-top: 50px; */
    padding-top: 40px;
">
                @csrf
                <h4>تسجيل الدخول</h4>
                <h6></h6>
                <div class="form-group">
                  <label>{{__('translate.Email')}} {{-- البريد الإلكتروني --}}</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                    <input id="email" class="form-control " name="email" type="email" required="" placeholder="Test@gmail.com" value="" autocomplete="email" autofocus="">
                                      </div>
                    @error('email')
                    <span class="text-danger">{{$message}}</span>

                @enderror
                </div>

                <div class="form-group">
                  <label>{{__('translate.Password')}} {{-- كلمة المرور --}}</label>
                  <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                    <input id="password" class="form-control " type="password" name="password" required="" placeholder="*********" autocomplete="current-password">
                                        <div class="show-hide"><span class="show">                         </span></div>
                  </div>
                  @error('password')
                {{$message}}
            @enderror
                </div>

<div class="mt-2">
                                <div class="div p-1 ">
                                    <button onclick="login('admin@gmail.com','123456789')" type="button" class="btn text-white btn-info btn-sm form-control">ادمن</button>
                                </div>
                                <div class="div p-1">
                                    <button onclick="login('nabeel@ppu.edu.ps','123456789')"  type="button" class="btn text-white btn-info btn-sm form-control">مشرف أكاديمي</button>
                                </div>
                                <div class="div p-1">
                                    <button onclick="login('','')"  type="button" class="btn text-white btn-info btn-sm form-control">مساعد اداري</button>
                                </div>
                                <div class="div p-1">
                                    <button onclick="login('noor@ppu.edu.ps','123456789')"  type="button" class="btn text-white btn-info btn-sm form-control">مسؤول المتابعة والتقييم</button>
                                </div>
                                <div class="div p-1">
                                    <button onclick="login('anas-bfo@gmail.com','123456789')"  type="button" class="btn text-white btn-info btn-sm form-control">{{__('translate.Manager of the company')}}{{-- مدير الشركة --}}</button>
                                </div>
                                <div class="div p-1">
                                    <button onclick="login('manar@gmail.com','123456789')"  type="button" class="btn text-white btn-info btn-sm form-control">مسؤول التدريب</button>
                                </div>
                            </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="margin-left: 0px;">
                        تسجيل الدخول
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        function login(username,password) {
            document.getElementById('email').value = username;
            document.getElementById('password').value = password;
        }
    </script>

</body>

</html>
