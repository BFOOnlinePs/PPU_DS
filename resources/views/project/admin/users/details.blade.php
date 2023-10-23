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
                <div class="card-header">
                <a href="{{route('admin.users.edit' , ['id'=>$user->u_id])}}" class="fa fa-edit"  style="font-size: x-large;"><span></span></a>
                <h6 class="card-title mb-0">المعلومات الأساسية</h6>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
                <form>
                    <div class="row mb-2">
                        <div class="profile-title">
                            <div class="media"><img class="img-70 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/dashboard/1.png">
                                <div class="media-body">
                        @if ($user->u_role_id == 2)
                            <h3 class="mb-1 f-20 txt-primary">{{$user->name}}</h3>
                            <p class="f-12">التخصص : {{$major}}</p>
                        @endif
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
                @if ($user->u_role_id == 2)
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="btn btn-primary btn-sm custom-btn" href="{{route('admin.users.courses.student' , ['id'=>$user->u_id])}}">مساقات الطالب</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="btn btn-primary btn-sm custom-btn" href="{{route('admin.users.places.training' , ['id'=>$user->u_id])}}">أماكن التدريب</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="btn btn-primary btn-sm custom-btn" href="{{route('admin.users.students.attendance' , ['id'=>$user->u_id])}}">سجل المتابعة</a>
                        </div>
                    </div>
                @endif
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection
