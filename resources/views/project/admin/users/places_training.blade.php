@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
تعديل المستخدم / <a href="{{route('admin.users.details' , ['id'=>$user->u_id])}}">{{$user->name}}</a>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
<style>
    /* Define a custom style for the buttons */
    .custom-btn {
        background-color: #3498db; /* Background color */
        color: #ffffff; /* Text color */
        border: none; /* Remove button border */
        border-radius: 5px; /* Add rounded corners */
        padding: 10px 20px; /* Adjust padding for a better appearance */
        text-decoration: none; /* Remove underlines on links */
        display: inline-block; /* Display as inline-block to size according to content */
        transition: background-color 0.3s; /* Add a smooth color transition on hover */

        /* Optional: Add a box shadow for a raised effect */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Change button color on hover */
    .custom-btn:hover {
        background-color: #1b6f9e;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-header pb-1">
      <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </div>
<div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-3">
            <div class="card">
            <input type="hidden" value="{{$user->u_id}}" id="u_id">
            <div class="card-header pb-0">
                <a href="{{route('admin.users.edit' , ['id'=>$user->u_id])}}" class="fa fa-edit" style="font-size: x-large;"><span></span></a>
                <h6 class="card-title mb-0">المعلومات الأساسية</h6>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <form>
                <div class="row mb-2">
                  <div class="profile-title">
                    <div class="media"><img class="img-70 rounded-circle" alt="" src="../assets/images/user/7.jpg">
                      <div class="media-body">
                        <h3 class="mb-1 f-20 txt-primary">{{$user->name}}</h3>
                        <p class="f-12">التخصص : {{$major}}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">اسم المستخدم</label>
                  <input class="form-control" value="{{$user->u_username}}" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">الإيميل</label>
                  <input class="form-control" type="text" value="{{$user->email}}" readonly>
                </div>
                <div class="mb-3">
                  <label class="form-label">رقم الجوال</label>
                  <input class="form-control" value="{{$user->u_phone1}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">رقم الجوال الاحتياط</label>
                    <input class="form-control" value="{{$user->u_phone2}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">عنوان السكن</label>
                    <input class="form-control" value="{{$user->u_address}}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">تاريخ الميلاد</label>
                    <input class="form-control" value="{{$user->u_date_of_birth}}" readonly>
                </div>
                <div class="form-footer">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-xl-9">
          <form class="card">
            <div class="card-header pb-0">
              <h4 class="card-title mb-0">أماكن التدريب</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm custom-btn" onclick="$('#AddPlacesTrainingModal').modal('show')" type="button"><span class="fa fa-plus"></span> تسجيل الطالب في تدريب</button>
                        </div>
                    </div>
              </div>
              <div class="row" id="content">
                @include('project.admin.users.ajax.placesTrainingList')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    @include('project.admin.users.modals.add_places_training')
    @include('project.admin.users.modals.loading')
    @include('project.admin.users.modals.agreement_file')
  </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        $('#agreementFileInput').on('change', function () {
            alert("Helo");
        });
        function viewAttachment(url) {
            $('#AgreementFileModal').modal('show');
            document.getElementById('view_attachment_result').src = url;
        }

        function delete_training_place_for_student(sc_id) {
            sc_student_id = document.getElementById('u_id').value;
            $.ajax({
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.training.place.delete')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'sc_id':sc_id,
                    'sc_student_id':sc_student_id
                },
                success: function(response) {
                    $('#content').html(response.html);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });
        }
        $(document).ready(function() {
    $('#addPlacesTrainingForm').submit(function(e) {
            e.preventDefault();
            // data = $('#addPlacesTrainingForm').serialize();
            var formData = new FormData(this);
            id = document.getElementById('u_id').value;
            formData.append('id', id);
            $.ajax({
                beforeSend: function(){
                    $('#AddPlacesTrainingModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.places.training.add')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#AddPlacesTrainingModal').modal('hide');
                    $('#content').html(response.html);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });})});
        function checkSelectedBranch(branch_id) {
            $.ajax({
                url: "{{route('admin.users.places.training.departments')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'branch_id': branch_id
                },
                success: function(response) {
                    console.log(response.departments);
                    var selectDepartments = document.getElementById('select-departments');
                    selectDepartments.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectDepartments.firstChild) {
                        selectDepartments.removeChild(selectDepartments.firstChild);
                    }

                    var option = document.createElement('option');
                        option.value = "";
                        option.text = "";
                        selectDepartments.appendChild(option);

                    // Populate the select with departments
                    response.departments.forEach(function(department) {
                        var option = document.createElement('option');
                        option.value = department.d_id;
                        option.text = department.d_name;
                        selectDepartments.appendChild(option);
                    });
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
        function checkSelectedCompany(company_id) {
            $.ajax({
                url: "{{route('admin.users.places.training.branches')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'company_id': company_id
                },
                success: function(response) {
                    var departmentSelect = document.getElementById("select-departments");
                    // Loop through all options and remove them
                    while (departmentSelect.options.length > 0) {
                        departmentSelect.remove(0);
                    }
                    departmentSelect.disabled = true;

                    var selectBranches = document.getElementById('select-branches');
                    selectBranches.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectBranches.firstChild) {
                        selectBranches.removeChild(selectBranches.firstChild);
                    }

                    // Populate the select with branches
                    var option = document.createElement('option');
                        option.value = "";
                        option.text = "";
                        selectBranches.appendChild(option);

                    response.branches.forEach(function(branch) {
                        var option = document.createElement('option');
                        option.value = branch.b_id;
                        option.text = branch.b_address;
                        selectBranches.appendChild(option);
                    });


                    var selectTrainers = document.getElementById('select-trainers');
                    selectTrainers.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectTrainers.firstChild) {
                        selectTrainers.removeChild(selectTrainers.firstChild);
                    }

                    response.trainers.forEach(function(trainer) {
                        var option = document.createElement('option');
                        option.value = trainer.u_id;
                        option.text = trainer.name;
                        selectTrainers.appendChild(option);
                    });
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
    </script>
    @endsection
