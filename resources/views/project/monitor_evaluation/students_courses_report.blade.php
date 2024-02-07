@extends('layouts.app')
@section('title')
تقرير الطلاب المسجلين في المساقات
@endsection
@section('header_title')
تقرير الطلاب المسجلين في المساقات
@endsection
@section('header_title_link')
<a href="{{route('home')}}">{{__('translate.Main')}}{{-- الرئيسية --}}</a>
@endsection
@section('header_link')
<a href="{{route('monitor_evaluation.students_courses_report')}}">تقرير الطلاب المسجلين في المساقات</a>
@endsection

@section('style')

<style>
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35); /* خلفية شفافة لشاشة التحميل */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* يجعل شاشة التحميل فوق جميع العناصر الأخرى */
    }
</style>

@endsection

@section('content')

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <!--loading whole page-->
        <div class="loader-container loader-box" id="loaderContainer" hidden>
            <div class="loader-3"></div>
        </div>
        <!--//////////////////-->



        <form id="companiesReportAjax" action="{{route('monitor_evaluation.companiesReportPDF')}}" method="POST" enctype="multipart/form-data" target="_blank">
            @csrf
            <div>
            {{-- <input hidden id="test" name="test" value="{{base64_encode(serialize($data))}}"> --}}
            <button class="btn btn-primary mb-2 btn-s" id="semsterPDFButton" type="submit"><i class="fa fa-print"></i> </button>
        </div>
        </form>

        <br>

        <form id="companiesReportSearchForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Semester')}}{{-- الفصل الدراسي --}}</label>
                        <div class="col-lg-12">
                            <select id="semester" name="semester" class="form-control btn-square">
                                {{-- <option value="0">{{__('translate.All Semesters')}}جميع الفصول </option> --}}
                                <option value="1" @if($semester==1) selected @endif>{{__('translate.First')}}</option>
                                <option value="2" @if($semester==2) selected @endif>{{__('translate.Second')}}</option>
                                <option value="3" @if($semester==3) selected @endif>{{__('translate.Summer')}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Academic Year')}} {{-- العام الدراسي --}} </label>
                        <div class="col-lg-12">
                            <select id="year" name="year" class="form-control btn-square">
                                @foreach($years as $key)
                                <option value={{$key}} @if($key == $year) selected @endif> {{$key}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1"> {{__('translate.Gender')}}{{--  الجنس --}}</label>
                        <div class="col-lg-12">
                            <select id="gender" name="gender" class="form-control btn-square">
                                <option selected="" value="0">--{{__('translate.Choose')}}{{--اختيار--}}--</option>
                                <option value="0">{{__('translate.Male')}}</option>
                                <option value="1">{{__('translate.Female')}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Major')}} {{-- العام الدراسي --}} </label>
                        <div class="col-lg-12">
                            <select id="major" name="major" class="form-control btn-square">
                                <option selected="" value="0">--{{__('translate.Choose')}}{{--اختيار--}}--</option>
                                @foreach($majors as $key)
                                <option value={{$key->m_id}}> {{$key->m_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </form>

        <div id="companiesReportTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">رقم الطالب</th>
                            <th scope="col">اسم الطالب</th>
                            <th scope="col">إجمالي المساقات المسجلة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span>{{__('translate.No available data')}} {{-- لا توجد بيانات  --}}</span></td>
                        </tr>
                        @else
                            @foreach ($data as $key)
                                <tr>
                                    <td style="display:none;">{{ $key->r_id }}</td>
                                    <td>{{ $key->users->u_username }}</td>
                                    <td>{{ $key->users->name }}</td>
                                    <td>{{ $key->coursesNum }}</td>

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

<script>
// console.log({!! json_encode($data, JSON_HEX_APOS) !!});


</script>

@endsection
