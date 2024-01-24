@extends('layouts.styleForPDF')
@section('title')
{{__("translate.Semester's Report")}}{{-- تقرير فصل --}}
@endsection
@section('content')

       <h4 class="text-center">{{__('translate.Palestine Polytechnic University')}}{{-- جامعة بوليتكنك فلسطين --}}</h4>
       <h4 class="text-center">{{__('translate.Dual Studies College')}}{{-- كلية الدراسات الثنائية --}}</h4>
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
                      <td class="col-md-4">{{__('translate.Total of registered students this semester')}} {{--  إجمالي الطلاب المسجلين في المساقات خلال هذا الفصل --}}</td>
                      <td id="manager_summary">{{$coursesStudentsTotal}}</td>
                      {{-- <td><button class="btn btn-primary"> استعراض</button></td> --}}
                    </tr>
                    <tr>
                      <td class="col-md-4">{{__('translate.Total of Semester Courses')}} {{--إجمالي المساقات لهذا الفصل--}}</td>
                      <td id="phone_summary">{{$semesterCoursesTotal}}</td>
                      {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                    </tr>
                    <tr id="phone2_summary_area">
                      <td class="col-md-4"> {{__('translate.Total of Traning Hours for all students this semester')}} {{--إجمالي ساعات التدريب لجميع الطلاب خلال هذا الفصل--}}</td>
                      <td id="phone2_summary"> {{$trainingHoursTotal}}{{--ساعات--}}{{__('translate.Hours')}}،{{$trainingMinutesTotal}}{{--دقائق--}} {{__('translate.Minutes')}} </td>
                      {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                    </tr>
                    <tr>
                      <td class="col-md-4">{{__("translate.Total of Companies' Trainees this semester")}} {{--إجمالي الطلاب المسجلين في الشركات خلال هذاالفصل--}}</td>
                      <td id="address_summary">{{$traineesTotal}}</td>
                      {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                    </tr>
                    <tr>
                        <td class="col-md-4"> {{__('translate.Total of Companies have trainees this semester')}}{{--إجمالي الشركات المسجل بها خلال هذا الفصل--}}</td>
                        <td id="address_summary">{{$semesterCompaniesTotal}}</td>
                        {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
                    </tr>

              </tbody>
            </table>
        </div>
    </div>

@endsection
