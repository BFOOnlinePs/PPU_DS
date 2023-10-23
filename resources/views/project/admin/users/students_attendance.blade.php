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
                    <div class="media"><img class="img-70 rounded-circle" alt="" src="https://laravel.pixelstrap.com/viho/assets/images/dashboard/1.png">
                      <div class="media-body">
                        <h3 class="mb-1 f-20 txt-primary">{{$user->name}}</h3>
                        {{-- <p class="f-12">التخصص : {{$major}}</p> --}}
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
              <h4 class="card-title mb-0">سجل الحضور و الغياب</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{-- <button class="btn btn-primary btn-sm custom-btn" onclick="$('#AddPlacesTrainingModal').modal('show')" type="button"><span class="fa fa-plus"></span> تسجيل الطالب في تدريب</button> --}}
                        </div>
                    </div>
              </div>
              <div class="row" id="content">
                @include('project.admin.users.ajax.studentsAttendanceList')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    @include('project.admin.users.modals.map_attendance')
  </div>
@endsection
@section('script')
    <script>
        var latitude1 , longitude1 , latitude2 , longitude2;
        function map(a , b , c , d){
            latitude1 = parseFloat(a); // Your latitude
            longitude1 = parseFloat(b); // Your longitude
            latitude2 = parseFloat(c); // Your latitude
            longitude2 = parseFloat(d); // Your longitude
            initMap();
            $('#studentsAttendanceModal').modal('show');
        }
        function initMap() {
            var map1 = new google.maps.Map(document.getElementById('map1'), {
                center: { lat: latitude1, lng: longitude1 },
                zoom:12
            });

            var marker = new google.maps.Marker({
                position: { lat: latitude1, lng: longitude1 },
                map: map1,
                title: 'موقع الطالب عند تسجيل الحضور'
            });

            var map2 = new google.maps.Map(document.getElementById('map2'), {
                center: { lat: latitude2, lng: longitude2 },
                zoom:12
            });

            var marker = new google.maps.Marker({
                position: { lat: latitude2, lng: longitude2 },
                map: map2,
                title: 'موقع الطالب عند تسجيل المغادرة'
            });
        }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnw9Vg4m3Vh6LM4krLUJ8Vn8AD6pRYXVI&callback=initMap&libraries=drawing&callback=initMap">
    </script>
@endsection
