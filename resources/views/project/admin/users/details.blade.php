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
        @endif
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
            <div class="card-body pt-0">
              <div class="row">
              </div>

              <hr>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection
