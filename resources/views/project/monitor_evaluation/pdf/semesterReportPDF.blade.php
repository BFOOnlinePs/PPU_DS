@extends('layouts.styleForPDF')
@section('title')
    تقرير فصل
@endsection
@section('content')

    <h4 class="text-center">جامعة بوليتكنك فلسطين</h4>
    <h4 class="text-center">كلية الدراسات الثنائية</h4>
    <hr>
    <br>

        <h3>
            {{$title}}
        </h3>

    <div class="row">
        <div class="table-responsive col-md-12">
            <table class="table table-bordered">

              <tbody>
                <tr>
                  <td class="col-md-4">إجمالي الطلاب المسجلين في المساقات خلال هذا الفصل</td>
                  <td id="manager_summary">{{$coursesStudentsTotal}}</td>
                  {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                </tr>
                <tr>
                  <td class="col-md-4">إجمالي المساقات لهذا الفصل</td>
                  <td id="phone_summary">{{$semesterCoursesTotal}}</td>
                  {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                </tr>
                <tr id="phone2_summary_area">
                  <td class="col-md-4">إجمالي ساعات التدريب لجميع الطلاب خلال هذا الفصل</td>
                  <td id="phone2_summary">{{$trainingHoursTotal}} ساعات، {{$trainingMinutesTotal}} دقائق</td>
                  {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                </tr>
                <tr>
                  <td class="col-md-4">إجمالي الطلاب المسجلين في الشركات خلال هذاالفصل</td>
                  <td id="address_summary">{{$traineesTotal}}</td>
                  {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                </tr>
                <tr>
                    <td class="col-md-4">إجمالي الشركات المسجل بها خلال هذا الفصل</td>
                    <td id="address_summary">{{$semesterCompaniesTotal}}</td>
                    {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                </tr>

              </tbody>
            </table>
        </div>
    </div>

@endsection
