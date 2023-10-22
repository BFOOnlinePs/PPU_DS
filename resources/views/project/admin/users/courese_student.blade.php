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
                <strong class="card-title mb-0" style="font-size: 15px;">
                    المعلومات الأساسية
                    <a href="{{route('admin.users.edit' , ['id'=>$user->u_id])}}" class="fa fa-edit" style="font-size: x-large;"><span></span></a>
                </strong>
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
              {{-- <h4 class="card-title mb-0">Edit Profile</h4> --}}
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm custom-btn" onclick="$('#AddCoursesStudentModal').modal('show')" type="button"><span class="fa fa-plus"></span> تسجيل مساق للطالب</button>
                        </div>
                    </div>
              </div>
              <div class="row" id="content">
                @include('project.admin.users.ajax.coursesList')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="add_courses_student">
        @include('project.admin.users.modals.add_courses_student')
    </div>
    @include('project.admin.users.modals.loading')
  </div>
@endsection
@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        function delete_course_for_student(c_id) {
            u_id = document.getElementById('u_id').value;
            $.ajax({
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.courses.student.delete')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'c_id' : c_id,
                    'u_id': u_id
                },
                success: function(response) {
                    var courseSelect = document.getElementById("select-course");
                    // Loop through all options and remove them
                    while (courseSelect.options.length > 0) {
                        courseSelect.remove(0);
                    }
                    response.courses.forEach(function(course) {
                        var option = document.createElement('option');
                        option.value = course.c_id;
                        option.text = course.c_name;
                        courseSelect.appendChild(option);
                    });
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
        let AddCoursesStudentForm = document.getElementById("addCoursesStudentForm");
        AddCoursesStudentForm.addEventListener("submit", (e) => {
                e.preventDefault();
            data = $('#addCoursesStudentForm').serialize();
            id = document.getElementById('u_id').value;
            $.ajax({
                beforeSend: function(){
                    $('#AddCoursesStudentModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.courses.student.add')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'data' : data ,
                    'id' : id
                },
                success: function(response) {
                    $('#AddCoursesStudentModal').modal('hide');
                    $('#content').html(response.html);
                    $('#add_courses_student').html(response.modal);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });
        });

    </script>
@endsection
