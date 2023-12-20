@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title')

@endsection
@section('header_title_link')
<a href="{{route('admin.users.index')}}">المستخدمين</a>
@endsection
@section('header_link')
تعديل المستخدم
@endsection
@section('style')
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
        @if ($user->u_role_id == 2)
            @include('project.admin.users.includes.menu_student')
        @elseif($user->u_role_id == 3)
            @include('project.admin.users.includes.menu_academic_supervisor')
        @elseif($user->u_role_id == 4)
            @include('project.admin.users.includes.menu_supervisor_assistatns')
        @endif
    </div>
    <div class="edit-profile">
      <div class="row">
        @if ($user->u_role_id == 1)
            <div class="col-xl-12">
            @include('project.admin.users.includes.information_edit_card_admin')
        @else
            <div class="col-xl-3">
            @include('project.admin.users.includes.information_edit_card_student')
        @endif
        </div>
        @if ($user->u_role_id != 1) {{-- Admin doesn't have this part of page --}}
            <div class="col-xl-9">
            <form class="card">
                <div class="card-header pb-0">
                    @if($user->u_role_id == 6)
                        <input type="hidden" value="{{$user->u_id}}" id="user_id">
                        <h4 class="card-title mb-0">   الطلاب المتدربين لدى شركة {{$company->c_name}} </h4>
                        @if (isset($students))
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <input class="form-control mb-2 " onkeyup="user_search(this.value)" type="search" placeholder="البحث">
                                </div>
                            </div>
                            <div id="user-table">
                                @include('project.admin.users.includes.student')
                            </div>
                        @else
                            <span class="text-center">لا يوجد متدربين في هذه الشركة</span>
                        @endif
                    @endif
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body pt-0">
                <div class="row">
                </div>

                <hr>

                </div>
            </form>
            </div>
        @endif
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        function user_search(value) {
            user_id = document.getElementById('user_id').value;
            $.ajax({
                url: "{{route('users.company_manager.searchStudentByName')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'user_id' : user_id,
                    'value' : value
                },
                success: function(response) {
                    if(response.html !== '') {
                        $('#user-table').html(response.html);
                    }
                },
                error: function(error) {

                    // alert(error.responseText);
                }
            });
        }
    </script>
@endsection
