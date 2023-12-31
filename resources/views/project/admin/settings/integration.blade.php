@extends('layouts.app')
@section('title')
@endsection
@section('header_title')
@endsection
@section('header_title_link')
@endsection
@section('header_link')
@endsection
@section('style')
<style>
</style>
@endsection
@section('content')
    <div class="card" style="padding-left:0px; padding-right:0px;">
        <div class="card-body" >
        <!--loading whole page-->
            <div class="loader-container loader-box" id="loaderContainer" hidden>
                <div class="loader-3"></div>
            </div>
        <div>
        </div>
        <form class="f1" method="post" id="companyForm">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line"></div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-file-excel-o"></i></div>
                    <p>{{__('translate.Upload excel file')}}{{-- رفع ملف إكسل --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-database"></i></div>
                    <p>{{__('translate.Columns selection')}}{{-- تحديد الأعمدة --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-refresh"></i></div>
                    <p>{{__('translate.Synchronization')}}{{-- مزامنة --}}</p>
                </div>
            </div>
            <fieldset>
                <div class="row" id="step1">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="f1-first-name">{{__('translate.Upload excel file')}}:{{-- رفع ملف إكسل --}}</label>
                            <div class="input-container">
                                <input class="form-control" type="file" id="excel_file" name="excel_file" required="" onchange="upload_excel_file(this)">
                            </div>
                            <div id="progress-container" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span id="progress-text">{{__('translate.Uploading')}}...{{-- جارٍ التحميل --}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" onclick="nextStep()" type="button">{{__('translate.Next')}}{{-- التالي --}}</button>
                </div>
            </fieldset>
            <fieldset>
                <div class="row" id="step2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translte.Year')}}{{-- السنة --}}</label>
                            <select id="year" name="year"  class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Student ID number')}}{{-- رقم الطالب الجامعي --}}</label>
                            <select id="student_id" name="student_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Course number')}}{{-- رقم المساق --}}</label>
                            <select id="course_id" name="course_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Major number')}}{{-- رقم التخصص --}}</label>
                            <select id="major_id" name="major_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Term')}}{{-- الفصل --}}</label>
                            <select id="semester" name="semester" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__("translate.Student's name")}}{{-- اسم الطالب --}}</label>
                            <select id="student_name" name="student_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Course name')}}{{-- اسم المساق --}}</label>
                            <select id="course_name" name="course_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__("translate.Major's name")}}{{-- اسم التخصص --}}</label>
                            <select id="major_name" name="major_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}
                    <button class="btn btn-primary btn-next" type="button" onclick="nextStep()">{{__('translate.Next')}}{{-- التالي --}}</button>
                </div>
            </fieldset>
            <fieldset>
                <div class="row p-3 m-5 mt-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h6>{{__("translate.In this section, when clicking on 'Synchronize', the fields are synchronized, establishing integration between the database and the Excel file")}}{{-- في هذا القسم عند الضغط على مزامنة يتم مزامنة الحقول وعمل تكامل ما بين قاعدة البيانات وملف إكسل --}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    {{-- <button class="btn btn-primary btn-previous" type="button">رجوع</button> --}}
                    <button class="btn btn-primary" onclick="show_confirm_alert()" type="button">{{__('translate.Synchronization')}}{{-- مزامنة --}}</button>
                </div>
            </fieldset>
        </form>
    </div>
        @include('project.admin.settings.includes.alertToConfirmIntegration')
    </div>
@endsection
@section('script')
<script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script>
    function show_confirm_alert()
    {
        $('#confirmIntegrationModal').modal('show');
    }
    function submit_form() {
        let data = [];
        data.push('year');
        data.push(document.getElementById('year').value);
        data.push('semester');
        data.push(document.getElementById('semester').value);
        data.push('student_id');
        data.push(document.getElementById('student_id').value);
        data.push('student_name');
        data.push(document.getElementById('student_name').value);
        data.push('course_id');
        data.push(document.getElementById('course_id').value);
        data.push('course_name');
        data.push(document.getElementById('course_name').value);
        data.push('major_id');
        data.push(document.getElementById('major_id').value);
        data.push('major_name');
        data.push(document.getElementById('major_name').value);
        let file = document.getElementById('excel_file').files[0];
        if (file) {
            let formData = new FormData();
            formData.append('input-file', file);
            formData.append('data' , data);
            $.ajax({
                url: "{{ route('integration.submitForm') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#confirmIntegrationModal').modal('hide');
                },
                error: function (error) {
                }
            });
        }

    }
    function create_options(headers , id) {
        let selectOptions = document.getElementById(id) , cnt = 0;
        selectOptions.innerHTML = '';
        let option = document.createElement('option');
        option.value = -1;
        option.text = `{{__('translate.Choose field')}}`; // اختر الحقل
        selectOptions.appendChild(option);
        headers.forEach(function (header) {
            let option = document.createElement('option');
            option.value = cnt++;
            option.text = header;
            selectOptions.appendChild(option);
        });
    }
    function upload_excel_file(input) {
        let file = input.files[0];
        if (file) {
            let formData = new FormData();
            formData.append('input-file', file);
            $(`#progress-container`).show();
            // Make an AJAX request to submit the file
            $.ajax({
                url: "{{ route('integration.uploadFileExcel') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (event) {
                        if (event.lengthComputable) {
                            var percentComplete = (event.loaded / event.total) * 100;
                            $(`#progress-bar`).css('width', percentComplete + '%');
                            $(`#progress-bar`).attr('aria-valuenow', percentComplete);
                            $(`#progress-text`).text('Uploading: ' + percentComplete.toFixed(2) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (response) {
                    $(`#progress-container`).hide();
                    let headers = response.headers;
                    create_options(headers , 'year');
                    create_options(headers , 'semester');
                    create_options(headers , 'student_id');
                    create_options(headers , 'student_name');
                    create_options(headers , 'course_id');
                    create_options(headers , 'course_name');
                    create_options(headers , 'major_id');
                    create_options(headers , 'major_name');
                },
                error: function (error) {
                    // Handle error, if needed
                    console.error(error);
                    $('#progress-container').hide();
                }
            });
        }
    }
</script>
@endsection
