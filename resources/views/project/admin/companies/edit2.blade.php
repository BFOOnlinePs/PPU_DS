@extends('layouts.app')
@section('title')
    {{ __('translate.Add Company') }}{{-- إضافة شركة --}}
@endsection
@section('header_title')
    {{ __('translate.Companies') }}{{-- الشركات --}}
@endsection
@section('header_title_link')
    {{ __('translate.Companies Management') }}{{-- إدارة الشركات --}}
@endsection
@section('header_link')
    {{ __('translate.Add Company') }}{{-- إضافة شركة --}}
@endsection
@section('style')
    <style>
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.35);
            /* خلفية شفافة لشاشة التحميل */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* يجعل شاشة التحميل فوق جميع العناصر الأخرى */
        }

        .f1-steps {
            display: flex;
            justify-content: space-around;
            /* Distribute the steps evenly along the horizontal axis */
            align-items: center;
            /* Center the steps vertically */
        }

        .f1-step {
            text-align: center;
            flex: 1;
            /* Allow each step to grow and fill the available space */
        }

        /* Add some basic styling to position the icon */
        .input-container {
            position: relative;
            /* width: 300px; Set the width of the input container */
        }

        /* Style the input to provide some spacing for the icon */
        input {
            padding-left: 30px;
            /* Add padding to the left of the input to make room for the icon */
            width: 100%;
            /* Make the input take up the full width of the container */
        }
    </style>
@endsection
@section('content')
    <div class="card" style="padding-left:0px; padding-right:0px;">

        {{-- <div class="card-header pb-0">
        <h1>إضافة شركة</h1>
    </div> --}}
        <div class="card-body">

            <!--loading whole page-->
            <div class="loader-container loader-box" id="loaderContainer" hidden>
                <div class="loader-3"></div>
            </div>
            <!--//////////////////-->
            <div>

            </div>
            <form class="row" action='{{ route('admin.companies.update2') }}' method="post">
                @csrf
                <input hidden name="company_id" value="{{ $user->u_id }}">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اسم الشركة بالعربي</label>
                        <input type="text" value="{{ $company->c_name }}" name="caName" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اسم الشركة بالانجليزي</label>
                        <input type="text" value="{{ $user->c_english_name }}" name="ceName" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>ايميل الشركة</label>
                        <input type="text" value="{{ $user->email }}" name="email2" class="form-control" />
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label>كلمة المرور</label>
                        <input type="text" name="pw" type='password' class="form-control" />
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رقم الهاتف المحمول</label>
                        <input type="text" required name="mobile" value="{{ $company_branch->b_phone1 }}" placeholder="تخزن رقم الهاتف اذا كانت فارغة"
                            class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الشخص المسؤول</label>
                        <input type="text" value="{{ $user->name }}" name="user" class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary">تعديل</button>
                    </div>
                </div>
            </form>
            <!--<form class="f1" method="post" id="companyForm">-->
            <!--    <div class="f1-steps">-->
            <!--        <div class="f1-progress">-->
            <!--            <div class="f1-progress-line"></div>-->
            <!--        </div>-->
            <!--        <div class="f1-step active">-->
            <!--            <div class="f1-step-icon"><i class="fa fa-user"></i></div>-->
            <!--            <p>{{ __('translate.User') }}{{-- المستخدم --}}</p>-->
            <!--        </div>-->
            <!--        <div class="f1-step">-->
            <!--            <div class="f1-step-icon"><i class="fa fa-file-text-o"></i></div>-->
            <!--            <p>{{ __('translate.Company Information') }}{{-- معلومات الشركة --}}</p>-->
            <!--        </div>-->
            <!--        <div class="f1-step">-->
            <!--            <div class="f1-step-icon"><i class="fa fa-th-large"></i></div>-->
            <!--            <p>{{ __('translate.Company Departments') }}{{-- أقسام الشركة --}}</p>-->
            <!--        </div>-->
            <!--        <div class="f1-step">-->
            <!--            <div class="f1-step-icon"><i class="fa fa-sitemap"></i></div>-->
            <!--            <p>{{ __('translate.Company Branches') }}{{-- فروع الشركة --}}</p>-->
            <!--        </div>-->
            <!--        <div class="f1-step">-->
            <!--            <div class="f1-step-icon"><i class="fa fa-file-text"></i></div>-->
            <!--            <p>{{ __('translate.Summary') }}{{-- الملخص --}}</p>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    <fieldset>-->
            <!--        <div class="row">-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="mb-3 form-group">-->
            <!--                    <label for="f1-first-name">{{ __('translate.Company Name') }}{{-- اسم الشركة --}} <span style="color: red">*</span></label>-->

            <!--                    <div class="input-container">-->
            <!--                        <i id="ok_icon" class="icon fa fa-check" style="color:#ef681a" hidden></i>-->
            <!--                        <i id="search_icon" class="icon_spinner fa fa-spin fa-refresh" hidden></i>-->
            <!--                        <input class="form-control" type="text" id="c_name" name="c_name" required="" onkeyup="checkCompany(this.value)">-->
            <!--                    </div>-->

            <!--                    <div id="similarCompanyMessage" style="color:#dc3545" hidden>-->
            <!--                        <span>{{ __('translate.There is company with the same name you entered,') }}{{-- يوجد شركة بنفس الاسم الذي قمت بادخاله، --}}</span>-->
            <!--                        <u><a id="companyLink" style="color:#dc3545">{{ __('translate.To move to the edit click here') }}{{-- للانتقال إلى التعديل قم بالضغط هنا --}}</a></u>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.company_english_name') }} <span style="color: red">*</span></label>-->
            <!--                    <input class="f1-last-name form-control" id="c_english_name" type="text" name="c_english_name" required="">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Owner') }}{{-- الشخص المسؤول --}} <span style="color: red">*</span></label>-->
            <!--                    <input class="f1-last-name form-control" id="name" type="text" name="name" required="">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-first-name"> {{ __('translate.Email') }} {{-- البريد الإلكتروني --}} <span style="color: red">*</span></label>-->
            <!--                    <div class="input-container">-->
            <!--                        <i id="email_ok_icon" class="icon fa fa-check" style="color:#ef681a" hidden></i>-->
            <!--                        <i id="email_search_icon" class="icon_spinner fa fa-spin fa-refresh" hidden></i>-->
            <!--                        <input class="form-control" id="email" type="text" name="email" required="" oninput="validateEmail(this)">-->
            <!--                    </div>-->

            <!--                    <div id="similarEmailMessage" style="color:#dc3545" hidden>-->
            <!--                        <span>{{ __('translate.Email has already been used') }}{{-- البريد الإلكتروني موجود بالفعل --}}</span>-->
            <!--                    </div>-->

            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Password') }} {{-- كلمة المرور --}} <span style="color: red">*</span></label>-->
            <!--                    <input class="f1-password form-control" id="password" type="password" name="password" required="">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->

            <!--                    <label for="f1-last-name">{{ __('translate.Company Phone Number') }}{{-- رقم هاتف الشركة --}} <span style="color: red">*</span></label>-->
            <!--                    <input class="f1-last-name form-control" id="phoneNum" type="text" name="phoneNum" required="" oninput="validateInput(this)">-->
            <!--                    <div id="errorMessage_phoneNum" style="color:#dc3545" class="error-message"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->

            <!--                    <label for="f1-last-name">{{ __('translate.Company Address') }}{{-- عنوان الشركة --}} <span style="color: red">*</span></label>-->
            <!--                    <input class="f1-last-name form-control" id="address" type="text" name="address" required="">-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">المدينة <span style="color: red">*</span></label>-->
            <!--                    <select class="form-control select2bs4" name="b_city_id" id="">-->
            <!--                    </select>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Number of Company Branches - including the main branch') }}{{-- عدد فروع الشركة - "يشمل الفرع الرئيسي" --}} <span style="color: red">*</span></label>-->
            <!--                    <select id="branchesNum" name="branchesNum" class="form-control btn-square">-->
            <!--                        <option value="1">1</option>-->
            <!--                        <option value="2">2</option>-->
            <!--                        <option value="3">3</option>-->
            <!--                        <option value="4">4</option>-->
            <!--                        <option value="5">5</option>-->
            <!--                        <option value="6">6</option>-->
            <!--                        <option value="7">7</option>-->
            <!--                        <option value="8">8</option>-->
            <!--                        <option value="9">9</option>-->
            <!--                        <option value="10">10</option>-->
            <!--                    </select>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="row">-->

            <!--        </div>-->

            <!--        <div class="row">-->

            <!--        </div>-->

            <!--        <div class="row">-->

            <!--        </div>-->



            <!--        <div class="f1-buttons">-->
            <!--            <button class="btn btn-primary" id="firstButton" onclick="firstStep()" type="button">{{ __('translate.Next') }}{{-- التالي --}}</button>-->
            <!--            <button class="btn btn-primary btn-next" id="firstStepButton" type="button" hidden></button>-->
            <!--            {{-- <button class="btn btn-primary btn-next" id="firstStepButton" type="button">test</button> --}}-->
            <!--        </div>-->
            <!--    </fieldset>-->



            <!--    <fieldset>-->
            <!--        <div class="row">-->
            <!--            <div class="col-md-3">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Company Name') }}{{-- اسم الشركة --}}</label>-->

            <!--                    {{-- <input class="f1-last-name form-control" id="companyName" type="text" name="companyName" disabled> --}}-->
            <!--                    <input class="f1-last-name form-control" id="companyName" name="companyName" disabled>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="col-md-3">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Website') }}{{-- الموقع الإلكتروني --}}</label>-->

            <!--                    <input class="form-control" id="c_website" name="c_website" oninput="validateArabicText(this)">-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="col-md-3">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Company Type') }}{{-- نوع الشركة --}} <span style="color: red">*</span></label>-->
            <!--                    <select id="c_type" name="c_type" class="form-control btn-square">-->
            <!--                        <option selected="" disabled="" value="">--{{ __('translate.Choose') }}--{{-- اختيار --}}</option>-->
            <!--                        <option value="1">{{ __('translate.Public Sector') }}{{-- قطاع عام --}}</option>-->
            <!--                        <option value="2">{{ __('translate.Private Sector') }}{{-- قطاع خاص --}}</option>-->
            <!--                    </select>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="col-md-3">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Company Category') }}{{-- تصنيف الشركة --}} <span style="color: red">*</span></label>-->
            <!--                    <select id="c_category" name="c_category" class="form-control btn-square">-->
            <!--                        <option selected="" disabled="" value="">--{{ __('translate.Choose') }}--{{-- اختيار --}}</option>-->
            <!--                    </select>-->
            <!--                </div>-->
            <!--            </div>-->


            <!--        </div>-->

            <!--        <div class="row">-->
            <!--            <div class="col-md-12">-->
            <!--                <div class="form-group">-->
            <!--                    <label for="f1-last-name">{{ __('translate.Company Description') }}{{-- وصف الشركة --}}</label>-->
            <!--                    <textarea class="form-control" id="c_description" name="c_description" rows="6"></textarea>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->


            <!--        <input hidden id="manager_id" name="manager_id">-->
            <!--        {{-- <input hidden id="company_id" name="company_id"> --}}-->

            <!--        <div class="f1-buttons">-->
            <!--            {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}-->
            <!--            <button class="btn btn-primary" type="button" onclick="secondStep()">{{ __('translate.Next') }}{{-- التالي --}}</button>-->
            <!--            <button class="btn btn-primary btn-next" id="secondStepButton" type="button" hidden></button>-->
            <!--            {{-- <button class="btn btn-primary btn-next" id="firstStepButton" type="button">test</button> --}}-->
            <!--        </div>-->
            <!--    </fieldset>-->

            <!--    <fieldset>-->
            <!--        <div class="row p-3 m-5 mt-3">-->

            <!--                <div class="col-md-4 text-center">-->


            <!--                        <h1><span class="fa fa-th" style="text-align: center; font-size:80px; "></span></h1>-->


            <!--                        <h3>{{ __('translate.Add Department to the Company') }}{{-- إضافة قسم إلى الشركة --}}</h3>-->

            <!--                        <hr>-->
            <!--                        <p>{{ __('translate.In this section, you can add departments to the current company') }}{{-- في هذا القسم يمكنك إضافة الأقسام الخاصة بالشركة الحالية --}}</p>-->


            <!--                </div>-->


            <!--                <div class="col-md-8">-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-md-8">-->
            <!--                            <div class="form-group">-->
            <!--                                {{-- <label for="f1-first-name">{{__('translate.Department Name')}}اسم القسم</label> --}}-->
            <!--                                <input class="form-control" id="d_name" name="d_name" placeholder="{{ __('translate.Department Name') }}">-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-md-4">-->
            <!--                            <button class="btn btn-info" type="button" onclick="addDepartment()">{{ __('translate.Add') }}{{-- إضافة  --}}</button>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    {{-- <div class="row" id="departmentsArea">-->

        <!--                        <div class="col-md-6 mb-1 mr-1" style="background-color: #ef681a4e; border-radius:10px">-->
        <!--                            <h6>test</h6>-->
        <!--                        </div>-->


        <!--                    </div> --}}-->
            <!--                    <div class="row" >-->
            <!--                        <div class="col-md-8" id="departmentsArea">-->



            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--        </div>-->


            <!--        <input hidden id="departmentsList" name="departmentsList">-->

            <!--        <div class="f1-buttons">-->
            <!--            <button class="btn btn-primary" onclick="departmentStep()" type="button">{{ __('translate.Next') }}{{-- التالي --}}</button>-->
            <!--            <button class="btn btn-primary btn-next" id="departmentStepButton" type="button" hidden></button>-->
            <!--        </div>-->
            <!--    </fieldset>-->

            <!--    <fieldset>-->

            <!--        <div class="row">-->
            <!--            <div class="col-md-6">-->
            <!--                <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">-->
            <!--                  <div class="card-body">-->
            <!--                    <div class="ribbon ribbon-primary ribbon-right">{{ __('translate.Main Branch') }}{{-- الفرع --}}</div>-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-md-6">-->
            <!--                            <div class="form-group">-->
            <!--                                <label for="phone1_1">{{ __('translate.Phone 1') }}{{-- هاتف 1 --}}</label>-->
            <!--                                <input class="f1-last-name form-control" id="phone1_1" type="text" name="phone1_1" disabled required="">-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-md-6">-->
            <!--                            <div class="form-group">-->
            <!--                                <label for="phone2_1">{{ __('translate.Phone 2') }}{{-- هاتف 2 --}}</label>-->
            <!--                                <input class="f1-last-name form-control" id="phone2_1"  name="phone2_1" required="" oninput="validateInput(this)">-->
            <!--                                <div id="errorMessage_phone2_1" style="color:#dc3545" class="error-message"></div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-md-6">-->
            <!--                            <div class="form-group">-->

            <!--                                <label for="address1">{{ __('translate.Branch Address') }}{{-- عنوان الفرع --}}</label>-->
            <!--                                <input class="f1-last-name form-control" id="address1" type="text" disabled name="address1" required="">-->

            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="col-md-6">-->
            <!--                            <div class="form-group" id="departments_group1" hidden>-->
            <!--                                <label for="departments1">{{ __('translate.Branch Departments') }}{{-- أقسام الفرع --}} <span style="color: red">*</span></label>-->
            <!--                                <select class="js-example-basic-single col-sm-12" multiple="multiple" type="text" id="departments1" multiple required></select>-->
            <!--                            </div>-->
            <!--                        </div>-->

            <!--                        <input hidden id="department_for_1" name="department_for_1">-->

            <!--                    </div>-->
            <!--                  </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-md-6" id="secondBranch" hidden>-->
            <!--                <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">-->
            <!--                    <div class="card-body">-->
            <!--                        <div class="ribbon ribbon-primary ribbon-right">{{ __('translate.Branch') }} {{-- الفرع --}} 2</div>-->
            <!--                        <div class="row">-->
            <!--                            <div class="col-md-6">-->
            <!--                                <div class="form-group">-->
            <!--                                    <label for="phone1_2">{{ __('translate.Phone 1') }}{{-- هاتف 1 --}} <span style="color: red">*</span></label>-->
            <!--                                    <input class="f1-last-name form-control" id="phone1_2" type="text" name="phone1_2" required="" oninput="validateInput(this)">-->
            <!--                                    <div id="errorMessage_phone1_2" style="color:#dc3545" class="error-message"></div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="col-md-6">-->
            <!--                                <div class="form-group">-->
            <!--                                    <label for="phone2_2">{{ __('translate.Phone 2') }}{{-- هاتف 2 --}}</label>-->
            <!--                                    <input class="f1-last-name form-control" id="phone2_2" name="phone2_2" oninput="validateInput(this)">-->
            <!--                                    <div id="errorMessage_phone2_2" style="color:#dc3545" class="error-message"></div>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="row">-->
            <!--                            <div class="col-md-6">-->
            <!--                                <div class="form-group">-->
            <!--                                    <label for="address2">{{ __('translate.Branch Address') }}{{-- عنوان الفرع --}} <span style="color: red">*</span></label>-->
            <!--                                    <input class="f1-last-name form-control" id="address2" type="text" name="address2" required="">-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                            <div class="col-md-6">-->
            <!--                                <div class="form-group" id="departments_group2" hidden>-->
            <!--                                    <label for="departments2">{{ __('translate.Branch Departments') }}{{-- أقسام الفرع --}} <span style="color: red">*</span></label>-->
            <!--                                    <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments2" multiple></select>-->
            <!--                                </div>-->
            <!--                            </div>-->

            <!--                            <input hidden id="department_for_2" name="department_for_2">-->
            <!--                        </div>-->
            <!--                      </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <input hidden id="company_id" name="company_id">-->

            <!--        </div>-->




            <!--        <div id="branches">-->

            <!--        </div>-->




            <!--        <div class="f1-buttons">-->
            <!--            {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}-->
            <!--            {{-- <button class="btn btn-primary btn-submit" type="submit">إضافة</button> --}}-->
            <!--            <button class="btn btn-primary" id="thirdButton" type="button" onclick="thirdStep()">{{ __('translate.Next') }}{{-- التالي --}}</button>-->
            <!--            <button class="btn btn-primary btn-next" id="thirdStepButton" type="button" hidden></button>-->
            <!--        </div>-->
            <!--    </fieldset>-->

            <!--    <fieldset>-->

            <!--        <h1 class="mt-3" id="company_name_summary"></h1>-->
            <!--        <br>-->

            <!--        <div class="table-responsive">-->
            <!--            <table class="table table-bordered">-->
            <!--                <tr>-->
            <!--                    <th style="background-color: #ecf0ef82;" colspan="2">{{ __('translate.Main Information') }}{{-- المعلومات الأساسية --}}</th>-->
            <!--                </tr>-->
            <!--              <tbody>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Owner') }}{{-- الشخص المسؤول --}}</td>-->
            <!--                  <td id="manager_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Email') }} {{-- البريد الإلكتروني --}}</td>-->
            <!--                  <td id="email_sammury"></td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Company Phone Number') }}{{-- رقم هاتف الشركة --}}</td>-->
            <!--                  <td id="phone_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr id="phone2_summary_area" hidden>-->
            <!--                  <td class="col-md-3">{{ __('translate.Phone 2') }}{{-- هاتف 2 --}}</td>-->
            <!--                  <td id="phone2_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Company Address') }}{{-- عنوان الشركة --}}</td>-->
            <!--                  <td id="address_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Company Category') }}{{-- تصنيف الشركة --}}</td>-->
            <!--                  <td id="category_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                  <td class="col-md-3">{{ __('translate.Company Type') }}{{-- نوع الشركة --}}</td>-->
            <!--                  <td id="type_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr id="description_summary_area" hidden>-->
            <!--                  <td class="col-md-3">{{ __('translate.Company Description') }}{{-- وصف الشركة --}}</td>-->
            <!--                  <td id="description_summary"></td>-->
            <!--                </tr>-->
            <!--                <tr id="main_branch_departments_area" hidden>-->
            <!--                  <td class="col-md-3">{{ __('translate.Main Branch Departments') }}{{-- أقسام الفرع الرئيسي --}}</td>-->
            <!--                  <td id="main_branch_departments"></td>-->
            <!--                </tr>-->
            <!--                <tr id="website_summary_area" hidden>-->
            <!--                  <td class="col-md-3">{{ __('translate.Website') }}{{-- الموقع الإلكتروني --}}</td>-->
            <!--                  <td id="website_summary"></td>-->
            <!--                </tr>-->
            <!--              </tbody>-->
            <!--            </table>-->
            <!--        </div>-->
            <!--        <br>-->

            <!--table for departments-->
            <!--        <div id="departments_table" hidden>-->
            <!--            <div class="table-responsive">-->
            <!--                <table class="table table-bordered">-->
            <!--                    <tr>-->
            <!--                        <th style="background-color: #ecf0ef82;" colspan="2">{{ __('translate.Company Departments') }}{{-- أقسام الشركة --}}</th>-->
            <!--                    </tr>-->
            <!--                <tbody>-->
            <!--                    <tr>-->
            <!--                        <td id="departments_summary" class="col-md-3"></td>-->
            <!--                    </tr>-->

            <!--                </tbody>-->
            <!--                </table>-->
            <!--            </div>-->
            <!--        </div>-->
            <!------------------------->
            <!--        <br>-->



            <!--        <div id="branches_summary">-->

            <!--        </div>-->



            <!--        <div class="f1-buttons">-->
            <!--            {{-- <button class="btn btn-success" type="button">إنهاء</button> --}}-->
            <!--            <a type="button" class="btn btn-success" href="{{ route('admin.companies.index') }}">{{ __('translate.Finish') }}{{-- إنهاء --}}</a>-->
            <!--            <a type="button" class="btn btn-info" id="editCompanyLink">{{ __('translate.Edit') }}{{-- تعديل --}}</a>-->
            <!--            {{-- <button class="btn btn-info" type="button">تعديل</button> --}}-->
            <!--        </div>-->
            <!--    </fieldset>-->

            <!--</form>-->


        </div>


        @include('project.admin.companies.modals.uncompletedCompanyModal')

        @include('layouts.loader')
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard/jquery.backstretch.min.js') }}"></script>

    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>




@endsection
