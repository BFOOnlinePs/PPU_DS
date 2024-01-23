@extends('layouts.app')
@section('title')
    تقرير فصل
@endsection
@section('header_title')
    تقرير فصل
@endsection
@section('header_title_link')
    تقرير فصل
@endsection
@section('header_link')
    تقرير فصل
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

        <div class="mb-3">
            {{-- <button class="btn btn-primary mb-2 btn-s" id="semsterPDFButton" ><i class="fa fa-file-pdf-o"></i> {{__('translate.Report File')}} ملف التقرير</button> --}}
            <button class="btn btn-primary mb-2 btn-s" onclick="showSemesterPDF()"><i class="fa fa-print"></i> </button>
        </div>

        <!--loading whole page-->
        <div class="loader-container loader-box" id="loaderContainer" hidden>
            <div class="loader-3"></div>
        </div>
        <!--//////////////////-->

        <form id="searchForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">


                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Semester')}}{{-- الفصل الدراسي --}}</label>
                        {{-- <input class="form-control" id="semester" name="semester"> --}}
                        <div class="col-lg-12">
                            <select id="semester" name="semester" class="form-control btn-square">
                                <option value="1" @if($semester==1) selected @endif>{{__('translate.First')}}{{-- أول --}}</option>
                                <option value="2" @if($semester==2) selected @endif>{{__('translate.Second')}}{{-- ثاني --}}</option>
                                <option value="3" @if($semester==3) selected @endif>{{__('translate.Summer')}}{{-- صيفي --}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Academic Year')}}{{-- العام الدراسي --}}</label>
                        <div class="col-lg-12">
                            <select id="year" name="year" class="form-control btn-square">
                                @foreach($years as $key)
                                <option value={{$key}} @if($key == $year) selected @endif> {{$key}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 d-flex justify-content-center">
                    <div class="form-group">
                        <div style="margin-top:27px;" style="width: 100%">
                        <button class="btn btn-info  mb-2 btn-s" style="width: 120px" type="submit"> {{__('translate.View')}} {{-- عرض  --}} </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="semsterReportTable">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th id="semsterReportTableTitle" style="background-color: #ecf0ef82;" colspan="3"></th></th>
                    </tr>
                  <tbody>
                    <tr>
                      <td class="col-md-4">{{__('translate.Total of registered students this semester')}} {{--  إجمالي الطلاب المسجلين في المساقات خلال هذا الفصل --}}</td>
                      <td id="manager_summary">{{$coursesStudentsTotal}}</td>
                    </tr>
                    <tr>
                      <td class="col-md-4">{{__('translate.Total of Semester Courses')}} {{--إجمالي المساقات لهذا الفصل--}}</td>
                      <td id="phone_summary">{{$semesterCoursesTotal}}</td>
                    </tr>
                    <tr id="phone2_summary_area">
                      <td class="col-md-4"> {{__('translate.Total of Traning Hours for all students this semester')}} {{--إجمالي ساعات التدريب لجميع الطلاب خلال هذا الفصل--}}</td>
                      <td id="phone2_summary"> {{$trainingHoursTotal}}{{--ساعات--}}{{__('translate.Hours')}}،{{$trainingMinutesTotal}}{{--دقائق--}} {{__('translate.Minutes')}} </td>
                    </tr>
                    <tr>
                      <td class="col-md-4">{{__("translate.Total of Companies' Trainees this semester")}} {{--إجمالي الطلاب المسجلين في الشركات خلال هذاالفصل--}}</td>
                      <td id="address_summary">{{$traineesTotal}}</td>
                    </tr>
                    <tr>
                        <td class="col-md-4"> {{__('translate.Total of Companies have trainees this semester')}}{{--إجمالي الشركات المسجل بها خلال هذا الفصل--}}</td>
                        <td id="address_summary">{{$semesterCompaniesTotal}}</td>
                    </tr>

                  </tbody>
                </table>
            </div>
        </div>


    </div>




</div>

@endsection
@section('script')

<script>

    var dataPDF = "<?php echo base64_encode(serialize($pdf)); ?>";

    function pdfLink(data){

        //href="{{ route('monitor_evaluation.semesterReportPDF', ['data' => base64_encode(serialize($pdf))]) }}"
        var encodedPdfData = "<?php echo base64_encode(serialize($pdf)); ?>";

        var editLink = "{{ route('monitor_evaluation.semesterReportPDF', ['data' => 'dataArr']) }}";

        //var encodedData = encodeURIComponent(JSON.stringify(pdfData));

        editLink = editLink.replace('dataArr', data);
        //document.getElementById("pdfButton").setAttribute("href",editLink);
        return editLink
    }

    function showSemesterPDF(){
        editLink = pdfLink(dataPDF);
        window.open(editLink, '_blank');
    }

    window.addEventListener("load", (event) => {

        var semester = {!! json_encode($semester, JSON_HEX_APOS) !!}

        if(semester==1){
            semester = "{{__('translate.First Semester Report')}} "
        }else if(semester==2){
            semester = "{{__('translate.Second Semester Report')}} "
        }else{
            semester = "{{__('translate.Summer Semester Report')}} "
        }
        var year = {!! json_encode($year, JSON_HEX_APOS) !!}

        x= semester + "{{__('translate.for Academic Year')}} "+year
        $('#semsterReportTableTitle').html(x);
    });

    document.getElementById('searchForm').addEventListener("submit", (e) => {

        e.preventDefault();
        data = $('#searchForm').serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            //Send an AJAX request
            $.ajax({
                beforeSend: function(){
                    document.getElementById('loaderContainer').hidden = false;
                },
                type: 'POST',
                url: "{{ route('monitor_evaluation.semesterReportAjax') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    dataPDF = response.pdf;
                    document.getElementById('loaderContainer').hidden = true;
                    $('#semsterReportTable').html(response.view);

                    var semester = response.semester
                    var year = response.year
                    if(semester==1){
                        semester = "{{__('translate.First Semester Report')}} "
                    }else if(semester==2){
                        semester = "{{__('translate.Second Semester Report')}} "
                    }else{
                        semester = "{{__('translate.Summer Semester Report')}} "
                    }

                    x= semester + "{{__('translate.for Academic Year')}} "+year
                    $('#semsterReportTableTitle').html(x);

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

    });



</script>

@endsection
