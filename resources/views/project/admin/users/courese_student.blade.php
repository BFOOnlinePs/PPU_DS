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
    <div class="p-2 pt-0 row">
        @include('project.admin.users.includes.menu_student')
    </div>
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-3">
            @include('project.admin.users.includes.information_edit_card_student')
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
                            <button class="btn btn-primary btn-sm" onclick="$('#AddCoursesStudentModal').modal('show')" type="button"><span class="fa fa-plus"></span>{{__('translate.Register a course for the student')}} {{-- تسجيل مساق للطالب --}}</button>
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
