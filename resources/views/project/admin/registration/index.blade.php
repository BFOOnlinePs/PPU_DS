@extends('layouts.app')
@section('title')
    مساقات الفصل الحالي
@endsection
@section('header_title')
{{__('translate.Current semester courses')}}
@endsection
@section('header_title_link')
    التسجيل
@endsection
@section('header_link')
    مساقات الفصل الحالي
@endsection

@section('style')

@endsection

@section('content')


<div>
    {{-- <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.registration.index")}}"'><span class="fa fa-book"></span> مساقات الفصل الحالي</button> --}}
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.registration.semesterStudents")}}"'><span class="fa fa-users"></span> {{__('translate.The students of the current semester')}}{{-- طلاب الفصل الحالي --}}</button>
</div>

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">{{__('translate.Course code')}}{{-- رمز المساق --}}</th>
                            <th scope="col">{{__('translate.Course name')}}{{-- اسم المساق --}}</th>
                            <th scope="col">{{__('translate.Course hours')}}{{-- ساعات المساق --}}</th>
                            <th scope="col">{{__('translate.Course type')}}{{-- نوع المساق --}}</th>
                            <th scope="col">{{__('translate.The students of the course')}}{{-- طلاب المساق --}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span>{{__('translate.No data available')}}{{-- لا توجد بيانات --}}</span></td>
                        </tr>
                    @else
                        @foreach ($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->sc_id }}</td>
                                <td>{{ $key->courses->c_course_code }}</td>
                                <td>{{ $key->courses->c_name }}</td>
                                <td>{{ $key->courses->c_hours }}</td>
                                @if( $key->courses->c_course_type == 0) <td>{{__('translate.Theoretical')}} {{-- نظري --}}</td>@endif
                                @if( $key->courses->c_course_type == 1) <td>{{__('translate.Practical')}} {{-- عملي --}}</td>@endif
                                @if( $key->courses->c_course_type == 2) <td>{{__('translate.Theoretical - Practical')}} {{-- نظري - عملي --}}</td>@endif
                                <td>
                                    <button class="btn btn-info" onclick='location.href="{{route("admin.registration.CourseStudents",["id"=>$key->courses->c_id])}}"'><i class="fa fa-search"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
            </div>
        </div>



    </div>





</div>


@endsection
@section('script')

@endsection
