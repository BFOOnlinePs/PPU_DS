@extends('layouts.app')
@section('title')
    إضافة شركة
@endsection
@section('header_title')
     {{__('translate.Companies')}}{{-- الشركات --}}
@endsection
@section('header_title_link')
    إدارة الشركات
@endsection
@section('header_link')
    إضافة شركة
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
    .c_name{
      position: absolute;
      top: 20px; /* Adjust the top position as needed */
      right: 40px; /* Adjust the left position as needed */
      padding-bottom:10px;
      margin-bottom: 5px; /* Remove default margin-bottom */
      }
</style>

@endsection
@section('content')

<div class="card" style="padding-left:0px; padding-right:0px; padding-top:0px">
<div style="position: absolute; top: 10px; right: 40px;"> <h2>{{$company->c_name}}</h2></div>
<!-- <h3 class="c_name"> {{$company->c_name}}</h3> -->

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
        <div class="f1"  id="companyForm">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line"></div>
                </div>

                <div class="f1-step"onclick="info()">
                    <div class="f1-step-icon"><i class="fa fa-file-text-o" ></i></div>
                    <p>{{__('translate.Company information')}}{{-- معلومات الشركة --}}</p>
                </div>
                <div class="f1-step" onclick="department()">
                    <div class="f1-step-icon"><i class="fa fa-th-large" ></i></div>
                    <p>{{__('translate.Company departments')}}{{-- أقسام الشركة --}}</p>
                </div>
                <div class="f1-step" onclick="branch()">
                    <div class="f1-step-icon"><i class="fa fa-sitemap" ></i></div>
                    <p>{{__('translate.Company branches')}}{{-- فروع الشركة --}}</p>
                </div>

            </div>




            <div id ="info">
                <form id="EditCompanyInfo" method="post">

            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-first-name"> {{__('translate.Company name')}} {{-- اسم الشركة --}}</label>

                            <div class="input-container">
                                <i id="ok_icon" class="icon fa fa-check" style="color:#24695c" hidden></i>
                                <i id="search_icon" class="icon_spinner fa fa-spin fa-refresh" hidden></i>
                                <input class="form-control" type="text" id="c_name" name="c_name" value="{{$company->c_name}}" required="" onkeyup="checkCompany(this.value)">
                            </div>

                            <div id="similarCompanyMessage" style="color:#dc3545" hidden>
                                <span>يوجد شركة بنفس الاسم الذي قمت بادخاله،</span>
                                <u><a id="companyLink" style="color:#dc3545">للانتقال إلى التعديل قم بالضغط هنا</a></u>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Owner')}}{{-- الشخص المسؤول --}}</label>
                            <input class="f1-last-name form-control" id="name" type="text" name="name" value="{{$company->manager->name}}" required="">
                        </div>
                    </div>

              <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company phone number')}}{{-- رقم هاتف الشركة --}}</label>
                            <input class="f1-last-name form-control" id="phoneNum" type="text" name="phoneNum" value="{{$company->manager->u_phone1}}" required="">
                        </div>


                </div>







    <div class="row">
                <div class="col-md-4">
                        <div class=" mb-3 form-group">
                            <label for="f1-first-name"> {{__('translate.Email')}} {{-- البريد الإلكتروني --}} </label>
                            <input class="form-control" id="email" type="text" name="email" value="{{$company->manager->email}}" required="h">
                        </div>

                 </div>
                       <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Password')}} {{-- كلمة المرور --}}</label>
                            <input class="f1-password form-control" id="password" type="password" name="password" >
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="f1-last-name">{{__('translate.Company address')}}{{-- عنوان الشركة --}}</label>
                                <input class="f1-last-name form-control" id="address" type="text" name="address" value="{{$company->manager->u_address}}" required="">
                            </div>
                    </div>
                </div>
    </div>

                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Type of company')}}{{-- نوع الشركة --}}</label>
                            <select id="c_type" name="c_type" class="form-control btn-square" value="{{$company->c_type}}">
                                <option @if($company->c_type== 1) selected @endif value="1">{{__('translate.Public sector')}}{{-- قطاع عام --}}</option>
                                <option @if($company->c_type== 2) selected @endif value="2">{{__('translate.Private sector')}}{{-- قطاع خاص --}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company category')}}{{-- تصنيف الشركة --}}</label>
                            <select id="c_category" name="c_category" class="form-control btn-square" value="{{$company->c_category_id}}">
                                @foreach($categories as $key)
                                   <option value="{{$key->cc_id}}" @if($company->c_category_id == $key->cc_id) selected @endif>{{$key->cc_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
   <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Website')}}{{-- الموقع الإلكتروني --}}</label>
                            <input  class="form-control" id="c_website" name="c_website" value="{{$company->c_website}}">
                        </div>
                    </div>


                </div>
                 <div class="row">



                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company description')}}{{-- وصف الشركة --}}</label>
                            <textarea  class="form-control" id="c_description" name="c_description" rows="6" >{{$company->c_description}}</textarea>
                        </div>
                    </div>



    </div>



                <input hidden id="manager_id" name="manager_id" value="{{$company->manager->u_id}}">
                <input hidden id="c_id" name="c_id" value="{{$company->c_id}}">
                <div class="f1-buttons">
                    <button type="submit" id="submit" class="btn btn-primary">{{__('translate.Edit')}}{{-- تعديل --}}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('translate.Cancel')}}{{-- إلغاء --}}</button>
                                </div>

    </form>
                </div>









                <div id="department" hidden>
                <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                    <form id="addDepartment" method="post">

                                        <label for="f1-first-name"> {{__('translate.Department Name')}}{{-- اسم القسم --}}</label>
                                        <input class="form-control" id="d_name" name="d_name">
                                        <input class="form-control" id="d_company_id" name="d_company_id" value="{{$company->c_id}}" hidden>
    </form>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 26px;">
                                    <button class="btn btn-info" type="button" onclick="addDepartment()">{{__('translate.Add department')}}{{-- إضافة القسم --}}</button>
                                </div>
                            </div>
                            <div class="row" id="departmentsArea">

                            </div>
                        </div>


                <!--أقسام الشركة-->


                <div class="col-md-8" >
                    <div class="ribbon-wrapper-right card"  id="departments_summary_area_company" >
                      <div class="card-body">
                        <div class="ribbon ribbon-clip-right ribbon-right ribbon-primary">{{__('translate.Company departments')}}{{-- أقسام الشركة --}}</div>
                        <div id="departments">
                             <div class="row">
                                        <form id="EditCompanyDepartments" method="post">
                                            <div id="noor12121">

                                            <input id="companyDepartments" name="companyDepartments" value="{{$companyDepartments}}" hidden>
                                        @foreach($companyDepartments as $key1)
                                        <input hidden id="d_id" name="d_id" value="{{$key1->d_id}}">
                               <div class="col-md-4">
                                <input class="f1-last-name form-control" name="d_name_{{$key1->d_id}}" id="d_name_{{$key1->d_id}}" value="{{$key1->d_name}}">
      </div>


                                    @endforeach

                <input hidden id="c_id" name="c_id" value="{{$company->c_id}}">
                  </div>
       <div class="f1-buttons" id="formButtons" hidden>
                    <button type="submit" id="submit" class="btn btn-primary">{{__('translate.Edit')}}{{-- تعديل --}}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('translate.Cancel')}}{{-- إلغاء --}}</button>
                                </div>


  </form>
    </div>
    <div id="addedDepartment" >

    </div>


    </div>
                        </div>
                    </div>



            </div>


    </div>









            <div id="branch" hidden>
            <div>
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='addBranch()'><span class="fa fa-plus"></span> {{__('translate.Add Branch')}}{{-- إضافة فرع --}}</button>
</div>
    <div class="row" id="companyBranches">
            @foreach($company->companyBranch as $key)


                    <div class="col-md-6">
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                          <div class="card-body">
                            <form id="EditCompanyBranches_{{$key->b_id}}" method="POST">
                            <div class="ribbon ribbon-primary ribbon-right">@if($key->b_main_branch == 1) {{__('translate.Main Branch')}}{{-- الفرع الرئيسي --}} @else {{__('translate.Branch')}} {{-- الفرع --}} {{ $loop->index  ++  }}@endif</div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone1">{{__('translate.Phone 1')}}{{-- هاتف 1 --}}</label>
                                        <input class="f1-last-name form-control" id="phone1_{{$key->b_id}}" type="text" name="phone1_{{$key->b_id}}" value="{{$key->b_phone1}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2">{{__('translate.Phone 2')}}{{-- هاتف 2 --}}</label>
                                        <input class="f1-last-name form-control" id="phone2_{{$key->b_id}}"  name="phone2_{{$key->b_id}}"  value="{{$key->b_phone2}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{__('translate.Branch Address')}}{{-- عنوان الفرع --}}</label>
                                        <input class="f1-last-name form-control" id="address_{{$key->b_id}}" type="text" name="address_{{$key->b_id}}"   value="{{$key->b_address}}" >
                                    </div>
                                </div>
                                <input hidden id="department_for_1_{{$key->b_id}}" name="department_for_1_{{$key->b_id}}">
                                <input hidden id="c_id_{{$key->b_id}}" name="c_id_{{$key->b_id}}" value="{{$company->c_id}}">
                                <input hidden id="manager_id_{{$key->b_id}}" name="manager_id_{{$key->b_id}}" value="{{$company->c_manager_id}}">
                                <input hidden id="b_id" name="b_id" value="{{$key->b_id}}">
                                <input hidden id="branches" name="branches" value="{{$company->companyBranch}}">
                                <div class="col-md-6">
                                    <div class="form-group" id="departments_group1_{{$key->b_id}}" >
                                        <input hidden id="branchesNumber_{{$key->b_id}}" name="branchedNumber_{{$key->b_id}}" value="{{count($company->companyBranch)}}">
                                        <label for="departments_{{$key->b_id}}">{{__('translate.Branch Departments')}}{{-- أقسام الفرع --}}</label>
                                        <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments_{{$key->b_id}}"  multiple></select>

                                    </div>
                                </div>



                            </div>
                <div class="f1-buttons" >
                    <button  id="submit_{{$key->b_id}}" onclick="submitEditCompanyBranches({{ $key->b_id}})" class="btn btn-primary">{{__('translate.Edit')}}{{-- تعديل --}}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('translate.Cancel')}}{{-- إلغاء --}}</button>
                                </div>
  </form>
                          </div>
                        </div>

                    </div>



            @endforeach
     </div>



                <div id="branches">

                </div>





    </div>
    </div>


    </div>



    <!-- </div>
    </div> -->


    @include('project.admin.companies.modals.uncompletedCompanyModal')

    @include('project.admin.companies.modals.addBranchModal')

    @include('layouts.loader')
</div>

@endsection


@section('script')
<!-- <script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script> -->

<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>



<script>
let companyForm = document.getElementById("companyForm");
let EditCompanyInfoForm = document.getElementById("EditCompanyInfo");
let EditCompanyDepartments = document.getElementById("EditCompanyDepartments");
let addBranchForm = document.getElementById("addBranchForm");
let editBranchForm = document.getElementById("EditCompanyBranches");
let companyName;
let company_id;
let branchesNumber = 1;
let departments = JSON.parse(document.getElementById('companyDepartments').value);
let branches=JSON.parse(document.getElementById('branches').value)
let uncompletedCompanySize = 0;
let uncompletedCompany;
$(document).ready(function()  {

for(i=0 ; i< branches.length ; i++){

    $('#departments_'+branches[i].b_id).on('select2:open', function (event) {
   console.log('Select2 dropdown opened!');

   // Your custom code when the dropdown is opened

   var multiselect = this;
   multiselect.innerHTML = '';
console.log("hi")
console.log(multiselect);
         var options = departments;
        //  var selectedOptions=$('#departments1').val();

         for (var r = 0; r < options.length; r++) {

                    var option = document.createElement("option");
                    option.text = options[r].d_name;
                    console.log("f")
                    console.log(options[r])
                    option.value =  r;
                   // option.selected=true;
                    multiselect.add(option);
         }


});

}
});


//noor
function info(){

    document.getElementById('info').hidden = false ;
    document.getElementById('department').hidden = true ;
    document.getElementById('branch').hidden = true ;
}
function department(){
    document.getElementById('info').hidden = true ;
    document.getElementById('department').hidden = false ;
    document.getElementById('branch').hidden = true ;
    if(document.getElementById('companyDepartments').value != null){
        document.getElementById('formButtons').hidden=false;
    }
    console.log("document.getElementById('companyDepartments').value")
    console.log(document.getElementById('companyDepartments').value)
    // var departmentsArray = JSON.parse(document.getElementById('companyDepartments').value);
    // console.log("dataArray")
    // console.log(departmentsArray)
    // for(i=0;i<departmentsArray.length;i++){
    //     departments.push(departmentsArray[i]);
    // }
 console.log("departments")
    console.log(departments)

}
function branch(){
    document.getElementById('info').hidden = true ;
    document.getElementById('department').hidden = true ;
    document.getElementById('branch').hidden = false ;
    console.log("fbbb")
    console.log(departments)
        //  var multiselect = document.getElementById('departments1');
        //  var options = departments;
        //  for (var r = 0; r < options.length; r++) {
        //             var option = document.createElement("option");
        //             option.text = options[r].d_name;
        //             option.value = r;
        //             multiselect.add(option);
        //  }



}
function addBranch(){


    var multiselect = document.getElementById('departments1');

     var options = departments;

         for (var r = 0; r < options.length; r++) {

                    var option = document.createElement("option");
                    option.text = options[r].d_name;
                    console.log("f")
         console.log(options[r])
                    option.value = r;
                    multiselect.add(option);
         }
         $('#AddBranchModal').modal('show');

}
EditCompanyInfoForm.addEventListener("submit", (e) => {
            e.preventDefault();
            data = $('#EditCompanyInfo').serialize();
            console.log(data);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                //new
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.companies.update') }}",
                data: data,
                success: function(response) {

                    company = response.company1
                    console.log("company");
                    console.log(company.c_name);
                    $('#info').html(response.view);

                    // document.getElementById('c_name').value = company.c_name;
                    // document.getElementById('name').value = company.manager.name;
                    // document.getElementById('phoneNum').value = company.manager.u_phone1;
                    // document.getElementById('email').value = company.manager.email;
                    // document.getElementById('password').value = company.manager.password;
                    // document.getElementById('u_address').value = company.manager.address;
                    // document.getElementById('c_type').value = company.c_type;
                    // document.getElementById('c_description').value = company.c_description;
                    // document.getElementById('c_website').value = company.c_website;
                    // document.getElementById('c_category').value = company.c_category;


                },
                //new
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });
        addBranchForm.addEventListener("submit", (e) => {
            e.preventDefault();
            depArr=[];
            ms_departments = $('#departments1').val();
            console.log(ms_departments)
            depArr = JSON.stringify($('#departments1').val());

            console.log("ms_departments")

                document.getElementById("departmentsList").value = depArr;



            console.log("data55555")
            data = $('#addBranchForm').serialize();
            console.log(data);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                //new
                beforeSend: function(){

                    $('#AddBranchModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.companies.createBranchesEdit') }}",
                data: data,
               // dataType: 'json',
                success: function(response) {
                    alert(response);
                     $('#companyBranches').html(response.view);



                },
                //new
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });
        function submitEditCompanyBranches(data){
            editBranchFormID="EditCompanyBranches_"+data;
            editBranchForm =document.getElementById(editBranchFormID);
            editBranchFormIDser='#'+editBranchFormID;
            // e.preventDefault();
            data = $(editBranchFormIDser).serialize();
            console.log(data);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                //new
                beforeSend: function(){


                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.companies.updateBranches') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    alert(response)
                     $('#companyBranches').html(response.view);



                },
                //new
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        }



        EditCompanyDepartments.addEventListener("submit", (e) => {
            e.preventDefault();
            data = $('#EditCompanyDepartments').serialize();
            console.log(data);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                //new
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.companies.updateDepartments') }}",
                data: data,
                success: function(response) {
                //   alert(response)

                     $('#noor12121').html(response.view);



                },
                //new
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

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
    data=$('#addDepartment').serialize();
    console.log(data)
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

// Send an AJAX request with the CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken
    }
});

// Send an AJAX request
$.ajax({
    //new
    beforeSend: function(){

        $('#LoadingModal').modal('show');
    },
    type: 'POST',
    url: "{{ route('admin.companies.addDepartment') }}",
    data: data,
    dataType: 'json',
    success: function(response) {
         $('#noor12121').html(response.view);
         departments = JSON.parse(document.getElementById('companyDepartments').value);
         console.log("departmentsdepartmentsdepartments")
         console.log(departments)


    },
    //new
    complete: function(){
        $('#LoadingModal').modal('hide');
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
    }
});


    departmentName = document.getElementById('d_name').value;
   document.getElementById('departments_summary_area_company').hidden=false;
   // departments.push(departmentName);
    departments = JSON.parse(document.getElementById('companyDepartments').value);
console.log("departmentsdepartmentsdepartments")
console.log(departments)

    document.getElementById('d_name').value = "";
    console.log("f")
    console.log(departments)
    console.log(branchesNumber)
    branchesNumber= document.getElementById('branchesNumber').value ;
    if(departments.length!=0){

////////////to set departments for branches/////////////
if(branchesNumber>=1){
    //to show department area in each branch
    for(var i = 0; i < branchesNumber; i++){
        departmentArea = `departments_group${i+1}`
        document.getElementById(departmentArea).hidden = false;

        departmentSelect = `departments${i+1}`
        var multiselect = document.getElementById(departmentSelect);
console.log("nnnnnn")
console.log(multiselect)
        // var options = departments;

        // for (var r = 0; r < options.length; r++) {
        // var option = document.createElement("option");
        // option.text = departmentName;
        // option.value = departments.length;
        // multiselect.add(option);

        // }

    }
}




}

}

function deleteDepartment(i){
    if(departments.length!=0){

////////////to set departments for branches/////////////
if(branchesNumber>=1){
    //to show department area in each branch
    for(var c = 0; c < branchesNumber; c++){
        departmentArea = `departments_group${c+1}`;
        document.getElementById(departmentArea).hidden = false;
        departmentSelect = `departments${c+1}`;
        var multiselect = document.getElementById(departmentSelect);
        var option = document.createElement("option");
        option.value = i;
        multiselect.options.remove(option);
    }}}
    departments.splice(i, 1);
    x = "";
    for(i=0;i<departments.length;i++){
        x=x+ '<br> <div class="row"> <div class="col-md-8"> <div class="form-group"><input class="f1-last-name form-control" id="d_name"  value="'+departments[i]+'"> </div></div>'
        +'<div class="col-md-4" ><button class="btn btn-danger" onclick="deleteDepartment('+i+')"><i class="fa fa-trash"></i></button></div></div>'
    }
    $('#addedDepartment').html(x);


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
                                        <input class="f1-last-name form-control" id="phone1_${i+1}" type="text" name="phone1_${i+1}" >
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
                                        <input class="f1-last-name form-control" id="address${i+1}" type="text" name="address${i+1}" >
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
                                        <input class="f1-last-name form-control" id="phone1_${i+2}" type="text" name="phone1_${i+2}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2_${i+2}">هاتف 2</label>
                                        <input class="f1-last-name form-control" id="phone2_${i+2}" name="phone2_${i+2}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=address${i+2}">عنوان الفرع</label>
                                        <input class="f1-last-name form-control" id="address${i+2}" type="text" name="address${i+2}" >
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
