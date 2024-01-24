@extends('layouts.app')
@section('title')
{{__('translate.Add Company')}}{{--إضافة شركة--}}
@endsection
@section('header_title')
     {{__('translate.Companies')}}{{-- الشركات --}}
@endsection
@section('header_title_link')
{{__('translate.Companies Management')}}{{--إدارة الشركات--}}
@endsection
@section('header_link')
{{__('translate.Add Company')}}{{--إضافة شركة--}}
@endsection
@section('style')

<style>
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35); /* خلفية شفافة لشاشة التحميل */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* يجعل شاشة التحميل فوق جميع العناصر الأخرى */
}

.f1-steps {
    display: flex;
    justify-content: space-around; /* Distribute the steps evenly along the horizontal axis */
    align-items: center; /* Center the steps vertically */
}

.f1-step {
    text-align: center;
    flex: 1; /* Allow each step to grow and fill the available space */
}

/* Add some basic styling to position the icon */
.input-container {
      position: relative;
      /* width: 300px; Set the width of the input container */
    }

    .icon {
      position: absolute;
      left: 10px; /* Adjust the left position to control the icon's placement */
      top: 50%;
      transform: translateY(-50%);
    }

    .icon_spinner {
      position: absolute;
      left: 10px; /* Adjust the left position to control the icon's placement */
      top: 30%;
      transform: translateY(-50%);
    }

    /* Style the input to provide some spacing for the icon */
    input {
      padding-left: 30px; /* Add padding to the left of the input to make room for the icon */
      width: 100%; /* Make the input take up the full width of the container */
    }
</style>

@endsection
@section('content')

<div class="card" style="padding-left:0px; padding-right:0px;">

    {{-- <div class="card-header pb-0">
        <h1>إضافة شركة</h1>
    </div> --}}
    <div class="card-body" >

        <!--loading whole page-->
        <div class="loader-container loader-box" id="loaderContainer" hidden>
            <div class="loader-3"></div>
        </div>
        <!--//////////////////-->
        <div>

        </div>
        <form class="f1" method="post" id="companyForm">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line"></div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>المستخدم</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-file-text-o"></i></div>
                    <p>{{__('translate.Company Information')}}{{-- معلومات الشركة --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-th-large"></i></div>
                    <p>{{__('translate.Company Departments')}}{{-- أقسام الشركة --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-sitemap"></i></div>
                    <p>{{__('translate.Company Branches')}}{{-- فروع الشركة --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-file-text"></i></div>
                    <p>الملخص</p>
                </div>
            </div>

            <fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="f1-first-name"> {{__('translate.Company Name')}} {{-- اسم الشركة --}}</label>

                            <div class="input-container">
                                <i id="ok_icon" class="icon fa fa-check" style="color:#24695c" hidden></i>
                                <i id="search_icon" class="icon_spinner fa fa-spin fa-refresh" hidden></i>
                                <input class="form-control" type="text" id="c_name" name="c_name" required="" onkeyup="checkCompany(this.value)">
                            </div>

                            <div id="similarCompanyMessage" style="color:#dc3545" hidden>
                                <span>يوجد شركة بنفس الاسم الذي قمت بادخاله،</span>
                                <u><a id="companyLink" style="color:#dc3545">للانتقال إلى التعديل قم بالضغط هنا</a></u>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Owner')}}{{-- الشخص المسؤول --}}</label>
                            <input class="f1-last-name form-control" id="name" type="text" name="name" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-first-name"> {{__('translate.Email')}} {{-- البريد الإلكتروني --}} </label>
                            <input class="form-control" id="email" type="text" name="email" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Password')}} {{-- كلمة المرور --}}</label>
                            <input class="f1-password form-control" id="password" type="password" name="password" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Phone Number')}}{{-- رقم هاتف الشركة --}}</label>
                            <input class="f1-last-name form-control" id="phoneNum" type="text" name="phoneNum" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="f1-last-name">{{__('translate.Company Address')}}{{-- عنوان الشركة --}}</label>
                                <input class="f1-last-name form-control" id="address" type="text" name="address" required="">
                            </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">عدد فروع الشركة - "يشمل الفرع الرئيسي"</label>
                            <select id="branchesNum" name="branchesNum" class="form-control btn-square">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>



                <div class="f1-buttons">
                    <button class="btn btn-primary" onclick="firstStep()" type="button">التالي</button>
                    <button class="btn btn-primary btn-next" id="firstStepButton" type="button" hidden></button>
                </div>
            </fieldset>



            <fieldset>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Name')}} {{-- اسم الشركة --}}</label>

                            <input class="f1-last-name form-control" id="companyName" type="text" name="companyName" disabled>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Website')}}{{-- الموقع الإلكتروني --}}</label>

                            <input class="form-control" id="c_website" name="c_website">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Type')}}{{-- نوع الشركة --}}</label>
                            <select id="c_type" name="c_type" class="form-control btn-square">
                                <option value="1">{{__('translate.Public Sector')}}{{-- قطاع عام --}}</option>
                                <option value="2">{{__('translate.Private Sector')}}{{-- قطاع خاص --}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Category')}}{{-- تصنيف الشركة --}}</label>
                            <select id="c_category" name="c_category" class="form-control btn-square">
                                @foreach($categories as $key)
                                    <option value="{{$key->cc_id}}">{{$key->cc_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Description')}}{{-- وصف الشركة --}}</label>
                            <textarea  class="form-control" id="c_description" name="c_description" rows="6"></textarea>
                        </div>
                    </div>
                </div>


                <input hidden id="manager_id" name="manager_id">
                {{-- <input hidden id="company_id" name="company_id"> --}}

                <div class="f1-buttons">
                    {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}
                    <button class="btn btn-primary" type="button" onclick="secondStep()">التالي</button>
                    <button class="btn btn-primary btn-next" id="secondStepButton" type="button" hidden></button>
                </div>
            </fieldset>

            <fieldset>
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-first-name"> اسم القسم</label>
                            <input class="form-control" id="d_name"  name="d_name"> --}}
                            {{-- <input class="form-control" id="d_name" type="text" name="d_name"> --}}
                        {{-- </div>
                    </div>
                    <div class="col-md-6" style="margin-top: 26px;">
                        <button class="btn btn-info" type="button" onclick="addDepartment()">إضافة القسم</button>
                    </div>
                </div> --}}


                {{-- <hr>
                <div id="departmentsArea">

                </div> --}}

                <div class="row p-3 m-5 mt-3">

                        <div class="col-md-4 text-center">


                                <h1><span class="fa fa-th" style="text-align: center; font-size:80px; "></span></h1>


                                <h3>{{__('translate.Add Department to the Company')}}{{-- إضافة قسم إلى الشركة --}}</h3>

                                <hr>
                                <p>في هذا القسم يمكنك إضافة الأقسام الخاصة بالشركة الحالية</p>


                        </div>


                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="f1-first-name"> {{__('translate.Department Name')}}{{-- اسم القسم --}}</label>
                                        <input class="form-control" id="d_name" name="d_name">
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 26px;">
                                    <button class="btn btn-info" type="button" onclick="addDepartment()">{{__('translate.Add Department')}}{{-- إضافة القسم --}}</button>
                                </div>
                            </div>
                            <div class="row" id="departmentsArea">

                            </div>
                        </div>

                </div>


                <input hidden id="departmentsList" name="departmentsList">

                <div class="f1-buttons">
                    <button class="btn btn-primary" onclick="departmentStep()" type="button">التالي</button>
                    <button class="btn btn-primary btn-next" id="departmentStepButton" type="button" hidden></button>
                </div>
            </fieldset>

            <fieldset>

                <div class="row">
                    <div class="col-md-6">
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                          <div class="card-body">
                            <div class="ribbon ribbon-primary ribbon-right">{{__('translate.Main Branch')}}{{-- الفرع الرئيسي --}}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone1_1">{{__('translate.Phone 1')}}{{-- هاتف 1 --}}</label>
                                        <input class="f1-last-name form-control" id="phone1_1" type="text" name="phone1_1" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2_1">{{__('translate.Phone 2')}}{{-- هاتف 2 --}}</label>
                                        <input class="f1-last-name form-control" id="phone2_1"  name="phone2_1" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address1">{{__('translate.Branch Address')}}{{-- عنوان الفرع --}}</label>
                                        <input class="f1-last-name form-control" id="address1" type="text" name="address1" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="departments_group1" hidden>
                                        <label for="departments1">{{__('translate.Branch Departments')}}{{-- أقسام الفرع --}}</label>
                                        <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments1" multiple></select>
                                    </div>
                                </div>

                                <input hidden id="department_for_1" name="department_for_1">

                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="secondBranch" hidden>
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                            <div class="card-body">
                                <div class="ribbon ribbon-primary ribbon-right">{{__('translate.Branch')}} {{-- الفرع --}} 2</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone1_2">{{__('translate.Phone 1')}}{{-- هاتف 1 --}}</label>
                                            <input class="f1-last-name form-control" id="phone1_2" type="text" name="phone1_2" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone2_2">{{__('translate.Phone 2')}}{{-- هاتف 2 --}}</label>
                                            <input class="f1-last-name form-control" id="phone2_2" name="phone2_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address2">{{__('translate.Branch Address')}}{{-- عنوان الفرع --}}</label>
                                            <input class="f1-last-name form-control" id="address2" type="text" name="address2" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="departments_group2" hidden>
                                            <label for="departments2">{{__('translate.Branch Departments')}}{{-- أقسام الفرع --}}</label>
                                            <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments2" multiple></select>
                                        </div>
                                    </div>

                                    <input hidden id="department_for_2" name="department_for_2">
                                </div>
                              </div>
                        </div>
                    </div>

                    <input hidden id="company_id" name="company_id">

                </div>




                <div id="branches">

                </div>




                <div class="f1-buttons">
                    {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}
                    {{-- <button class="btn btn-primary btn-submit" type="submit">إضافة</button> --}}
                    <button class="btn btn-primary" type="button" onclick="thirdStep()">التالي</button>
                    <button class="btn btn-primary btn-next" id="thirdStepButton" type="button" hidden></button>
                </div>
            </fieldset>

            <fieldset>

                <h1 class="mt-3" id="company_name_summary"></h1>
                <br>

                <!--معلومات الشركة-->
                <div class="col-md-12">
                    <div class="ribbon-wrapper-right card">
                      <div class="card-body">
                        <div class="ribbon ribbon-clip-right ribbon-right ribbon-primary">{{__('translate.Company Information')}}{{-- معلومات الشركة --}}</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Owner')}}{{-- الشخص المسؤول --}}</label>
                                    <input class="f1-last-name form-control" id="manager_summary" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Email')}} {{-- البريد الإلكتروني --}}</label>
                                    <input class="f1-last-name form-control" id="email_sammury" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Company Phone Number')}}{{-- رقم هاتف الشركة --}}</label>
                                    <input class="f1-last-name form-control" id="phone_summary" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Company Address')}}{{-- عنوان الشركة --}}</label>
                                    <input class="f1-last-name form-control" id="address_summary" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Company Category')}}{{-- تصنيف الشركة --}}</label>
                                    <input class="f1-last-name form-control" id="category_summary" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">{{__('translate.Company Type')}}{{-- نوع الشركة --}}</label>
                                    <input class="f1-last-name form-control" id="type_summary" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="description_summary_area" hidden>
                                    <label for="f1-last-name">{{__('translate.Company Description')}}{{-- وصف الشركة --}}</label>
                                    <textarea class="f1-last-name form-control" id="description_summary" rows="6" disabled></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="phone2_website_area">

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="mb_department_summary_area" hidden>
                                    <label for="f1-last-name">أقسام الفرع الرئيسي</label>
                                    <input class="f1-last-name form-control" id="main_branch_departments" disabled>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

                <!--أقسام الشركة-->
                <div class="col-md-12">
                    <div class="ribbon-wrapper-right card" id="departments_summary_area" hidden>
                      <div class="card-body">
                        <div class="ribbon ribbon-clip-right ribbon-right ribbon-primary">{{__('translate.Company Departments')}}{{-- أقسام الشركة --}}</div>
                        <div id="departments_summary">

                        </div>
                    </div>
                    </div>
                </div>

                <!--فروع الشركة-->
                <div class="col-md-12">
                    <div class="ribbon-wrapper-right card" id="branches_summary_area" hidden>
                      <div class="card-body">
                        <div class="ribbon ribbon-clip-right ribbon-right ribbon-primary">{{__('translate.Company Branches')}}{{-- فروع الشركة --}}</div>
                        <div id="branches_summary">

                        </div>
                    </div>
                    </div>
                  </div>


                <div class="f1-buttons">
                    {{-- <button class="btn btn-success" type="button">إنهاء</button> --}}
                    <a type="button" class="btn btn-success" href="{{ route('admin.companies.index') }}">إنهاء</a>
                    <a type="button" class="btn btn-info" id="editCompanyLink">{{__('translate.Edit')}}{{-- تعديل --}}</a>
                    {{-- <button class="btn btn-info" type="button">تعديل</button> --}}
                </div>
            </fieldset>

        </form>


    </div>


    @include('project.admin.companies.modals.uncompletedCompanyModal')

    @include('layouts.loader')
</div>

@endsection


@section('script')
<script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>

<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>



<script>
let companyForm = document.getElementById("companyForm");
let companyName;
let company_id;
let branchesNum = document.getElementById('branchesNum').value;
let branchesNumber = 1;
const departments = [];
let uncompletedCompanySize = 0;
let uncompletedCompany;



//for uncomleted companies
window.addEventListener("load", (event) => {

    //console.log($('fieldset:eq(0)'))
    //console.log($('fieldset:first'))
    // $('fieldset').each(function(index, element) {
    //     console.log(index)
    // })

    uncompletedCompanySize = {{count($uncompletedCompany)}}
    if(uncompletedCompanySize != 0){

        uncompletedCompany = {!! json_encode($uncompletedCompany, JSON_HEX_APOS) !!};

        x=""
        for(i=0;i<uncompletedCompanySize;i++){
            //console.log(uncompletedCompany[i].c_name)
            x += `<div class="row mb-2">
                    <div class="col-md-6">
                        <h6>
                            ${uncompletedCompany[i].c_name}
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary" onclick="completeCompany(${i})" >إكمال</button>
                    </div>
                  </div>`
        }

        $('#p_company').html(x);



        //console.log(uncompletedCompany[0])


        //show popup with companies and links to them
        $('#uncompletedCompanyModal').modal('show');
    }

});

function completeCompany(index){

    document.getElementById('c_name').value = uncompletedCompany[index].c_name;
    document.getElementById('name').value = uncompletedCompany[index].manager.name;
    document.getElementById('email').value = uncompletedCompany[index].manager.email;
    document.getElementById('password').value = uncompletedCompany[index].manager.password;
    document.getElementById('phoneNum').value = uncompletedCompany[index].manager.u_phone1;
    document.getElementById('address').value = uncompletedCompany[index].manager.u_address;
    document.getElementById('phone1_1').value=uncompletedCompany[index].manager.u_phone1;
    document.getElementById('address1').value=uncompletedCompany[index].manager.u_address;
    document.getElementById('manager_id').value = uncompletedCompany[index].manager.u_id;
    document.getElementById('companyName').value = uncompletedCompany[index].c_name;

    document.getElementById('company_id').value = uncompletedCompany[index].c_id;


    branchesNum = document.getElementById('branchesNum').value;
    if(branchesNum<2){
        //cause adress2 and phone1 are required inputs in the wizard and it will not continue to the
        //next step even they are hidden, so when choose 1 branch they are actully exists but whithout values
        //so the wizard will not continue to next step
        //so this is the temp solution for this issue
        document.getElementById('address2').value = 0;
        document.getElementById('phone1_2').value = 0;
    }

    $('#uncompletedCompanyModal').modal('hide');

}

function checkCompany(data){

    document.getElementById('ok_icon').hidden = true;

    if(data!=""){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })

    $.ajax({
        beforeSend: function(){
            document.getElementById('search_icon').hidden = false;
        },
        url: "{{ route('admin.companies.checkCompany') }}",
        method: "post",
        data: {
            'search': data,
            _token: '{!! csrf_token() !!}',
        },
        success: function(response) {

            if(response.data!=null){

                company_id = response.company_id;

                var editLink = "{{ route('admin.companies.edit', ['id' => 'company_id']) }}";
                editLink = editLink.replace('company_id', company_id);
                document.getElementById("companyLink").setAttribute("href",editLink);

                document.getElementById('search_icon').hidden = true;
                document.getElementById('ok_icon').hidden = true;

                document.getElementById('similarCompanyMessage').hidden = false;

            }else{
                document.getElementById('similarCompanyMessage').hidden = true;


                document.getElementById('search_icon').hidden = true;
                document.getElementById('ok_icon').hidden = false;
            }

        },
        error: function(xhr, status, error) {
            alert('error');
        }
    });
    }

}



function firstStep(){

    branchesNum = document.getElementById('branchesNum').value;
    if(branchesNum<2){
        //cause adress2 and phone1 are required inputs in the wizard and it will not continue to the
        //next step even they are hidden, so when choose 1 branch they are actully exists but whithout values
        //so the wizard will not continue to next step
        //so this is the temp solution for this issue
        document.getElementById('address2').value = 0;
        document.getElementById('phone1_2').value = 0;
    }

    branchesNumber = document.getElementById('branchesNum').value;

    ////////set phone number and address to the main branch in branches page///////
    phoneNum1 = document.getElementById('phoneNum').value;
    address1 = document.getElementById('address').value;

    document.getElementById('phone1_1').value=phoneNum1;
    document.getElementById('address1').value=address1;
    ///////////////////////////////////////////////////////////////////////////////

    if(uncompletedCompanySize!=0){
        console.log("hi reem from first step but with complete company")
        document.querySelector('#firstStepButton').click();
    }else{
        console.log("hi reem from first step but with new company")
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        data = $('#companyForm').serialize();

        console.log(data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            beforeSend: function(){
                //$('#LoadingModal').modal('show');
                document.getElementById('loaderContainer').hidden = false;
            },
            type: 'POST',
            url: "{{ route('admin.companies.create') }}",
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log(response.company_id)
                manager_id = response.manager_id;
                document.getElementById('manager_id').value = manager_id;
                document.getElementById('company_id').value = response.company_id;
                companyName = document.getElementById("c_name").value;
                document.getElementById('companyName').value = companyName;

            },
            complete: function(){
                //$('#LoadingModal').modal('hide');
                document.getElementById('loaderContainer').hidden = true;
                document.querySelector('#firstStepButton').click();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    //document.getElementById('companyName').value = "companyName";
    //document.querySelector('#firstStepButton').click();

}

function secondStep(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    data = $('#companyForm').serialize();

    // if(document.getElementById('c_website').value=="" && document.getElementById('c_description').value==""&&uncompletedCompanySize==0){
    //     document.querySelector('#secondStepButton').click();
    // }else{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            beforeSend: function(){
                //$('#LoadingModal').modal('show');
                document.getElementById('loaderContainer').hidden = false;
            },
            type: 'POST',
            url: "{{ route('admin.companies.updateCompany') }}",
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log("all has done")
            },
            complete: function(){
                //$('#LoadingModal').modal('hide');
                document.getElementById('loaderContainer').hidden = true;
                document.querySelector('#secondStepButton').click();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    //}

    //document.querySelector('#secondStepButton').click();

}

function thirdStep(){

    //to set selected values in department for each branch
    if(departments.length!=0){
        for(i=0;i<branchesNumber;i++){

            branchDepId=`department_for_${i+1}`;
            branchSelect = `#departments${i+1}`;

            //console.log("$(branchSelect).val()")
            //console.log($(branchSelect).val())
            depArr = JSON.stringify($(branchSelect).val());

            //document.getElementById(branchDepId).value = $(branchSelect).val();
            document.getElementById(branchDepId).value = depArr;
        }
    }

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    data = $('#companyForm').serialize();
    console.log(data);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    $.ajax({
        beforeSend: function(){
            //$('#LoadingModal').modal('show');
            document.getElementById('loaderContainer').hidden = false;
        },
        type: 'POST',
        url: "{{ route('admin.companies.createBranches') }}",
        data: data,
        dataType: 'json',
        success: function(response) {
            console.log(response.data)
            // console.log(response.list)
            // console.log(response.company_id)
            //document.getElementById('company_id').value = response.company_id;
        },
        complete: function(){
            document.getElementById('loaderContainer').hidden = true;
            document.querySelector('#thirdStepButton').click();

            var editLink = "{{ route('admin.companies.edit', ['id' => 'company_id']) }}";
            editLink = editLink.replace('company_id', document.getElementById("company_id").value);
            document.getElementById("editCompanyLink").setAttribute("href",editLink);



            categories = {!! json_encode($categories, JSON_HEX_APOS) !!};
            //set step 4 values - summary tab
            document.getElementById("company_name_summary").innerHTML = "اسم الشركة : "+document.getElementById("c_name").value;
            document.getElementById("manager_summary").value = document.getElementById("name").value ;
            document.getElementById("email_sammury").value = document.getElementById("email").value;
            document.getElementById("phone_summary").value = document.getElementById("phoneNum").value;
            document.getElementById("address_summary").value = document.getElementById("address").value;
            document.getElementById("category_summary").value = categories[document.getElementById("c_category").value-1].cc_name;
            document.getElementById("type_summary").value = document.getElementById("c_type").value == 1 ? "قطاع عام" : "قطاع خاص";


            x = "";
            if(document.getElementById("c_description").value != ""){
                document.getElementById("description_summary_area").hidden = false;
                document.getElementById("description_summary").value = document.getElementById("c_description").value;
            }
            if(document.getElementById("phone2_1").value != ""){
                x +=`<div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">هاتف 2</label>
                            <input class="f1-last-name form-control" value="${document.getElementById("phone2_1").value}" disabled>
                        </div>
                    </div>`;
                $('#phone2_website_area').html(x);
            }
            if(document.getElementById("c_website").value != ""){
                x +=`<div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">الموقع الإلكتروني</label>
                            <input class="f1-last-name form-control" value="${document.getElementById("c_website").value}" disabled>
                        </div>
                    </div>`;
                $('#phone2_website_area').html(x);
            }


            //to list all departments for company
            if(departments.length!=0){

                x="";
                //departments area
                document.getElementById("departments_summary_area").hidden = false;
                //main branch department
                document.getElementById("mb_department_summary_area").hidden = false;

                //to set main branch departments
                mb_departments = $('#departments1').val();
                for(d=0;d<mb_departments.length;d++){
                    x += `${departments[mb_departments[d]]}`
                    if(d < mb_departments.length-1){
                        x += "، "
                    }
                }
                document.getElementById("main_branch_departments").value = x;

                //to list departments for this company
                x="";
                for(i=0;i<departments.length;i++){
                    d_name = departments[i];

                    x += `<li>${d_name}</li>`
                }
                $('#departments_summary').html(x);
            }




            branchesNum = document.getElementById('branchesNum').value;

            //to list branches in summary page for this company
            if(branchesNum > 1){
                x=""
                document.getElementById("branches_summary_area").hidden = false;
                for(i=1;i<branchesNum;i++){

                    branchSelect = `#departments${i+1}`;
                    branch_name = "";
                    branch_id = `address${i+1}`
                    branch_address = document.getElementById(branch_id).value;
                    branch_phone1 = document.getElementById(`phone1_${i+1}`).value;
                    branch_phone2 = document.getElementById(`phone2_${i+1}`).value;
                    x += `<h6>الفرع ${i+1}<h6>

                        <hr>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">هاتف 1</label>
                                    <input class="f1-last-name form-control" value="${branch_phone1}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">عنوان الفرع</label>
                                    <input class="f1-last-name form-control" value="${branch_address}" disabled>
                                </div>
                            </div>
                          </div>
                        `
                    if(document.getElementById(`phone2_${i+1}`).value != "" || departments.length!=0){
                        x += `<div class="row">`
                    }
                    if(document.getElementById(`phone2_${i+1}`).value != ""){
                        x += `<div class="col-md-6">
                                  <div class="form-group">
                                      <label for="f1-last-name">هاتف 2</label>
                                      <input class="f1-last-name form-control" value="${branch_phone2}" disabled>
                                  </div>
                              </div>`
                    }
                    if(departments.length!=0){
                        tempB = "";
                        //console.log("$(branchSelect).val()");
                        //console.log($(branchSelect).val());
                        for(r=0;r<$(branchSelect).val().length;r++){
                            temp = $(branchSelect).val()
                            tempB += `${departments[temp[r]]}`
                            if(r < $(branchSelect).val().length - 1){
                                tempB += `، `
                            }
                        }

                        x += `<div class="col-md-6">
                                <div class="form-group">
                                    <label for="f1-last-name">الأقسام الخاصة بالفرع</label>
                                    <input class="f1-last-name form-control" value="${tempB}" disabled>
                                </div>
                              </div>`

                    }
                    if(document.getElementById(`phone2_${i+1}`).value != "" || departments.length!=0){
                        x += `</div">`
                    }

                }

                $('#branches_summary').html(x);
            }

            $('.ribbon-wrapper').fadeOut('slow');
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

    /////////////////////////////////////this whole code for summary content////////////////////////////////////////////
    // var editLink = "{{ route('admin.companies.edit', ['id' => 'company_id']) }}";
    // editLink = editLink.replace('company_id', document.getElementById("company_id").value);
    // document.getElementById("editCompanyLink").setAttribute("href",editLink);



    // categories = {!! json_encode($categories, JSON_HEX_APOS) !!};
    // //set step 4 values - summary tab
    // document.getElementById("company_name_summary").innerHTML = "اسم الشركة : "+document.getElementById("c_name").value;
    // document.getElementById("manager_summary").value = document.getElementById("name").value ;
    // document.getElementById("email_sammury").value = document.getElementById("email").value;
    // document.getElementById("phone_summary").value = document.getElementById("phoneNum").value;
    // document.getElementById("address_summary").value = document.getElementById("address").value;
    // document.getElementById("category_summary").value = categories[document.getElementById("c_category").value-1].cc_name;
    // document.getElementById("type_summary").value = document.getElementById("c_type").value == 1 ? "قطاع عام" : "قطاع خاص";


    // x = "";
    // if(document.getElementById("c_description").value != ""){
    //     document.getElementById("description_summary_area").hidden = false;
    //     document.getElementById("description_summary").value = document.getElementById("c_description").value;
    // }
    // if(document.getElementById("phone2_1").value != ""){
    //     x +=`<div class="col-md-6">
    //             <div class="form-group">
    //                 <label for="f1-last-name">هاتف 2</label>
    //                 <input class="f1-last-name form-control" value="${document.getElementById("phone2_1").value}" disabled>
    //             </div>
    //         </div>`;
    //     $('#phone2_website_area').html(x);
    // }
    // if(document.getElementById("c_website").value != ""){
    //     x +=`<div class="col-md-6">
    //             <div class="form-group">
    //                 <label for="f1-last-name">الموقع الإلكتروني</label>
    //                 <input class="f1-last-name form-control" value="${document.getElementById("c_website").value}" disabled>
    //             </div>
    //         </div>`;
    //     $('#phone2_website_area').html(x);
    // }


    // //to list all departments for company
    // if(departments.length!=0){

    //     x="";
    //     //departments area
    //     document.getElementById("departments_summary_area").hidden = false;
    //     //main branch department
    //     document.getElementById("mb_department_summary_area").hidden = false;

    //     //to set main branch departments
    //     mb_departments = $('#departments1').val();
    //     for(d=0;d<mb_departments.length;d++){
    //         x += `${departments[mb_departments[d]]}`
    //         if(d < mb_departments.length-1){
    //             x += "، "
    //         }
    //     }
    //     document.getElementById("main_branch_departments").value = x;

    //     //to list departments for this company
    //     x="";
    //     for(i=0;i<departments.length;i++){
    //         d_name = departments[i];

    //         x += `<li>${d_name}</li>`
    //     }
    //     $('#departments_summary').html(x);
    // }




    // branchesNum = document.getElementById('branchesNum').value;

    // //to list branches in summary page for this company
    // if(branchesNum > 1){
    //    x=""
    //     document.getElementById("branches_summary_area").hidden = false;
    //     for(i=1;i<branchesNum;i++){

    //         branchSelect = `#departments${i+1}`;
    //         branch_name = "";
    //         branch_id = `address${i+1}`
    //         branch_address = document.getElementById(branch_id).value;
    //         branch_phone1 = document.getElementById(`phone1_${i+1}`).value;
    //         branch_phone2 = document.getElementById(`phone2_${i+1}`).value;
    //         x += `<h6>الفرع ${i+1}<h6>

    //             <hr>
    //               <div class="row">
    //                 <div class="col-md-6">
    //                     <div class="form-group">
    //                         <label for="f1-last-name">هاتف 1</label>
    //                         <input class="f1-last-name form-control" value="${branch_phone1}" disabled>
    //                     </div>
    //                 </div>
    //                 <div class="col-md-6">
    //                     <div class="form-group">
    //                         <label for="f1-last-name">عنوان الفرع</label>
    //                         <input class="f1-last-name form-control" value="${branch_address}" disabled>
    //                     </div>
    //                 </div>
    //               </div>
    //             `
    //         if(document.getElementById(`phone2_${i+1}`).value != "" || departments.length!=0){
    //             x += `<div class="row">`
    //         }
    //         if(document.getElementById(`phone2_${i+1}`).value != ""){
    //             x += `<div class="col-md-6">
    //                       <div class="form-group">
    //                           <label for="f1-last-name">هاتف 2</label>
    //                           <input class="f1-last-name form-control" value="${branch_phone2}" disabled>
    //                       </div>
    //                   </div>`
    //         }
    //         if(departments.length!=0){
    //             tempB = "";
    //             //console.log("$(branchSelect).val()");
    //             //console.log($(branchSelect).val());
    //             for(r=0;r<$(branchSelect).val().length;r++){
    //                 temp = $(branchSelect).val()
    //                 tempB += `${departments[temp[r]]}`
    //                 if(r < $(branchSelect).val().length - 1){
    //                     tempB += `، `
    //                 }
    //             }

    //             x += `<div class="col-md-6">
    //                     <div class="form-group">
    //                         <label for="f1-last-name">الأقسام الخاصة بالفرع</label>
    //                         <input class="f1-last-name form-control" value="${tempB}" disabled>
    //                     </div>
    //                   </div>`

    //         }
    //         if(document.getElementById(`phone2_${i+1}`).value != "" || departments.length!=0){
    //             x += `</div">`
    //         }

    //     }
    // }




}

companyForm.addEventListener("submit", (e) => {
    e.preventDefault();
    data = $('#companyForm').serialize();
    //console.log(data)

});

function addDepartment(){
    departmentName = document.getElementById('d_name').value;
    departments.push(departmentName);
    x = "";
    for(i=0;i<departments.length;i++){
        x = x + '<div class="row mb-2"><div class="col-md-6"><h5>'+departments[i]+
        '</h5></div><div class="col-md-2"><button class="btn btn-danger" onclick="deleteDepartment('+i+')"><i class="fa fa-trash"></i></button></div></div>'
    }
    $('#departmentsArea').html(x);
    document.getElementById('d_name').value = "";
}

function deleteDepartment(i){
    departments.splice(i, 1);
    x = "";
    for(i=0;i<departments.length;i++){
        x = x + '<div class="row mb-2"><div class="col-md-6"><h5>'+departments[i]+
        '</h5></div><div class="col-md-2"><button class="btn btn-danger" onclick="deleteDepartment('+i+')"><i class="fa fa-trash"></i></button></div></div>'
    }
    $('#departmentsArea').html(x);
}

function departmentStep(){

        branchesNumber = document.getElementById('branchesNum').value;

        //to set department values to input and send it to the controller
        document.getElementById('departmentsList').value = JSON.stringify(departments);

        x="";

        //console.log("branchesNumberbranchesNumberbranchesNumberbranchesNumberbranchesNumberbranchesNumber");
        //console.log(branchesNumber);

        if(branchesNumber>1){

            document.getElementById('secondBranch').hidden = false;

            for(i=2;i<branchesNumber;i += 2){

                    x += `<div class="row">
                          <div class="col-md-6">
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                          <div class="card-body">
                            <div class="ribbon ribbon-primary ribbon-right">الفرع ${i+1}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone1_${i+1}">هاتف 1</label>
                                        <input class="f1-last-name form-control" id="phone1_${i+1}" type="text" name="phone1_${i+1}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2_${i+1}">هاتف 2</label>
                                        <input class="f1-last-name form-control" id="phone2_${i+1}" name="phone2_${i+1}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=address${i+1}">عنوان الفرع</label>
                                        <input class="f1-last-name form-control" id="address${i+1}" type="text" name="address${i+1}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="departments_group${i+1}" hidden>
                                        <label for="departments${i+1}">أقسام الفرع</label>
                                        <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments${i+1}" multiple></select>
                                    </div>
                                </div>

                                <input hidden id="department_for_${i+1}" name="department_for_${i+1}">

                            </div>
                          </div>
                        </div>
                          </div>`;


                    // Check if there is another branch to add in the same row
                    if (i + 2 <= branchesNumber) {
                        x += `<div class="col-md-6">
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                          <div class="card-body">
                            <div class="ribbon ribbon-primary ribbon-right">الفرع ${i+2}</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone1_${i+2}">هاتف 1</label>
                                        <input class="f1-last-name form-control" id="phone1_${i+2}" type="text" name="phone1_${i+2}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2_${i+2}">هاتف 2</label>
                                        <input class="f1-last-name form-control" id="phone2_${i+2}" name="phone2_${i+2}" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=address${i+2}">عنوان الفرع</label>
                                        <input class="f1-last-name form-control" id="address${i+2}" type="text" name="address${i+2}" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="departments_group${i+2}" hidden>
                                        <label for="departments${i+2}">أقسام الفرع</label>
                                        <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments${i+2}" multiple></select>
                                    </div>
                                </div>

                                <input hidden id="department_for_${i+2}" name="department_for_${i+2}">

                            </div>
                          </div>
                        </div>
                             </div>`;
                    }

                    x += '</div>';
            }


            $('#branches').html(x);


            //to load script after adding branches
            loadScript("{{ asset('assets/js/select2/select2-custom.js') }}", function() {});
            loadScript("{{ asset('assets/js/select2/select2.full.min.js') }}", function() {});


        }


        if(departments.length!=0){

            ////////////to set departments for branches/////////////
            if(branchesNumber>=1){
                //to show department area in each branch
                for(var i = 0; i < branchesNumber; i++){
                    departmentArea = `departments_group${i+1}`
                    document.getElementById(departmentArea).hidden = false;

                    departmentSelect = `departments${i+1}`
                    var multiselect = document.getElementById(departmentSelect);

                    var options = departments;

                    for (var r = 0; r < options.length; r++) {
                    var option = document.createElement("option");
                    option.text = options[r];
                    option.value = r;
                    multiselect.add(option);
                    }

                }
            }
            ////////////////////////////////////////////////////////////////



        }

        ////////////////////////////////////////////////////////////////


    document.querySelector('#departmentStepButton').click();

}


//to load script again
function loadScript(src, callback) {
    var script = document.createElement('script');
    script.src = src;
    script.onload = callback;
    document.head.appendChild(script);
}

</script>


@endsection
