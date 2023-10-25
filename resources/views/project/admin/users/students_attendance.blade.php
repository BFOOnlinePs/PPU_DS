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
              <h4 class="card-title mb-0">سجل الحضور و الغياب</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{-- <button class="btn btn-primary btn-sm" onclick="$('#AddPlacesTrainingModal').modal('show')" type="button"><span class="fa fa-plus"></span> تسجيل الطالب في تدريب</button> --}}
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
