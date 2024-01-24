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
                    <p>{{__('translate.Upload Excel File')}}{{-- رفع ملف إكسل --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-database"></i></div>
                    <p>{{__('translate.Columns Selection')}}{{-- تحديد الأعمدة --}}</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-refresh"></i></div>
                    <p>{{__('translate.Synchronization')}}{{-- مزامنة --}}</p>
                </div>
            </div>
            <fieldset>
                <div id="errorPageOne">
                </div>
                <div class="row" id="step1">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="f1-first-name">{{__('translate.Upload Excel File')}}:{{-- رفع ملف إكسل --}}</label>
                            <div class="input-container">
                                <input class="form-control" type="file" id="excel_file" name="excel_file" required="" onchange="upload_excel_file(this)" accept=".xlsx, .xls">
                                <input type="hidden" id="name_file_hidden">
                            </div>
                            <div id="progress-container" style="display: none;">
                                <div class="progress">
                                    <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span id="progress-text">{{__('translate.Uploading')}}...{{-- جارٍ التحميل --}}</span>
                            </div>
                            <br>
                            <div class="card" style="background-color: #fff891">
                                <ul>
                                    <li>
                                        {{__('translate.You must upload Excel file contains the following headings')}}{{-- يجب رفع ملف إكسل تحتوي على العناوين التالية --}} :
                                    </li>
                                    <ul style="list-style-type: circle">
                                        <li>{{__('translate.Year')}}{{-- السنة --}}</li>
                                        <li>{{__('translate.The semester (1 means first semester, 2 means second semester, 3 means summer semester)')}}{{-- الفصل (1 تعني الفصل الأول ، 2 تعني الفصل الثاني ، 3 تعني الفصل الصيفي) --}}</li>
                                        <li>{{__('translate.Student University ID')}}{{-- الرقم الجامعي للطالب --}}</li>
                                        <li>{{__("translate.Student Name")}}{{-- اسم الطالب --}}</li>
                                        <li>{{__('translate.Course ID')}}{{-- رقم المساق --}}</li>
                                        <li>{{__('translate.Course Name')}}{{-- اسم المساق --}}</li>
                                        <li>{{__('translate.Major ID')}}{{-- رقم التخصص --}}</li>
                                        <li>{{__("translate.Major Name")}}{{-- اسم التخصص --}}</li>
                                    </ul>
                                </ul>
                            </div>
                            <a href="{{ asset('storage/excel/samplesData.xlsx') }}" download>{{__('translate.Download Example File')}}{{--تحميل مثال لملف--}}</a>
                            <br><br>
                            <ul>
                                <li>
                                    {{__('translate.Example')}}{{-- مثال --}} :
                                    @if (app()->getLocale() == 'en')
                                        <img src="{{asset('storage/excel/excelEn.PNG')}}" alt="">
                                    @else
                                        <img src="{{asset('storage/excel/excelAr.PNG')}}" alt="">
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" onclick="validate_step_one()" type="button" id="next1">{{__('translate.Next')}}{{-- التالي --}}</button>
                </div>
            </fieldset>
            <fieldset>
                <div class="row" id="step2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Year')}}{{-- السنة --}}</label>
                            <select id="year" name="year"  class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Student University ID')}}{{-- رقم الطالب الجامعي --}}</label>
                            <select id="student_id" name="student_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Course ID')}}{{-- رقم المساق --}}</label>
                            <select id="course_id" name="course_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Major ID')}}{{-- رقم التخصص --}}</label>
                            <select id="major_id" name="major_id" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Semester')}}{{-- الفصل الدراسي--}}</label>
                            <select id="semester" name="semester" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__("translate.Student Name")}}{{-- اسم الطالب --}}</label>
                            <select id="student_name" name="student_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Course Name')}}{{-- اسم المساق --}}</label>
                            <select id="course_name" name="course_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="f1-last-name">{{__("translate.Major Name")}}{{-- اسم التخصص --}}</label>
                            <select id="major_name" name="major_name" class="js-example-basic-single col-sm-12">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" type="button" onclick="nextStep()">{{__('translate.Next')}}{{-- التالي --}}</button>
                </div>
            </fieldset>
            <fieldset>
                <div class="row p-3 m-5 mt-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h6>{{__("translate.In this section, clicking on 'Synchronize' will update the fields, establishing a seamless integration between the database and the Excel file")}}{{-- في هذا القسم عند الضغط على مزامنة يتم مزامنة الحقول وعمل تكامل ما بين قاعدة البيانات وملف إكسل --}}</h6>
                                    <div id="progress" style="height: 200px; background-color: #fff891 ;overflow: scroll; ">
                                    </div>
                                    <div id="summary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('project.admin.users.modals.loading')
                <div class="f1-buttons">
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
    function validate_step_one()
    {
        let file = document.getElementById('excel_file').files[0];
        let nextButton = document.getElementById('next1');
        if (file) {
            let formData = new FormData();
            formData.append('input-file', file);
            $.ajax({
                url: "{{ route('integration.validateStepOne') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status === 0) {
                        nextButton.disabled = true;
                        document.getElementById('errorPageOne').innerHTML = `
                            <div class="alert alert-danger">
                                يُرجى اختيار ملف إكسل فقط
                            </div>
                        `;
                    }
                    else {
                        nextButton.disabled = false;
                        document.getElementById('errorPageOne').innerHTML = ``;
                    }
                },
                error: function (error) {
                }
            });
        }
        else {
            nextButton.disabled = true;
            document.getElementById('errorPageOne').innerHTML = `
                <div class="alert alert-danger">
                    يُرجى اختيار ملف إكسل فقط
                </div>
            `;
        }
    }
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
        let name_file_hidden = document.getElementById('name_file_hidden').value;
        if (file) {
            let formData = new FormData();
            formData.append('input-file', file);
            formData.append('data' , data);
            formData.append('name_file_hidden' , name_file_hidden);
            $.ajax({
                beforeSend: function() {
                    $('#confirmIntegrationModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{ route('integration.submitForm') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#LoadingModal').modal('hide');
                    const locale = "{{ app()->getLocale() }}";
                    let progress = '';
                    let courses_array = response.courses_array;
                    let majors_array = response.majors_array;
                    let students_numbers = response.students_numbers_array;
                    let students_names = response.students_names_array;
                    let registration_array = response.registration_array;
                    if(locale === 'ar') {
                        document.getElementById("summary").innerHTML = `
                        <div class="alert alert-success">
                        تم إضافة عدد ${response.user_object} من الطلاب
                        </div>
                        <div class="alert alert-success">
                            تم إضافة عدد ${response.course_object} من المساقات
                        </div>
                        <div class="alert alert-success">
                            تم إضافة عدد ${response.major_object} من التخصصات
                        </div>
                        <div class="alert alert-success">
                            تم تسجيل ${response.registration_object} من الطلاب
                        </div>
                        `;
                        for(let i = 0; i < courses_array.length; i += 2) {
                            progress += `<p>تم تسجيل مساق ${courses_array[i + 1]} ، رقمه ${courses_array[i]}</p>`;
                        }
                        for(let i = 0; i < majors_array.length; i += 2) {
                            progress += `<p>تم تسجيل تخصص ${majors_array[i + 1]} ، رقمه ${majors_array[i]}</p>`;
                        }
                        for(let i = 0; i < students_numbers.length; i++) {
                            progress += `<p>تم إضافة طالب اسمه ${students_names[i]} ، و رقمه الجامعي هو ${students_numbers[i]}</p>`;
                        }
                        for(let i = 0; i < registration_array.length; i += 5) {
                            let semester = `الصيفي`;
                            if(registration_array[i + 3] == 1) {
                                semester = `الأول`;
                            }
                            else if(registration_array[i + 3] == 2) {
                                semester = `الثاني`;
                            }
                            progress += `<p>تم تسجيل الطالب ${registration_array[i]} الّذي يحمل الرقم الجامعي ${registration_array[i + 1]} ، في مساق ${registration_array[i + 2]} لسنة ${registration_array[i + 4]} في الفصل ${semester}</p>`;
                        }
                        document.getElementById('progress').innerHTML = progress;
                    }
                    else {
                        document.getElementById("summary").innerHTML = `
                        <div class="alert alert-success">
                            Added ${response.user_object} students
                        </div>
                        <div class="alert alert-success">
                            Added ${response.course_object} courses
                        </div>
                        <div class="alert alert-success">
                            Added ${response.major_object} majors
                        </div>
                        <div class="alert alert-success">
                            Registered ${response.registration_object} students
                        </div>
                        `;
                        for (let i = 0; i < courses_array.length; i += 2) {
                            progress += `<p>A course with number ${courses_array[i]} titled ${courses_array[i + 1]} has been registered.</p>`;
                        }
                        for (let i = 0; i < majors_array.length; i += 2) {
                            progress += `<p>A major with number ${majors_array[i]} titled ${majors_array[i + 1]} has been registered.</p>`;
                        }
                        for (let i = 0; i < students_numbers.length; i++) {
                            progress += `<p>A student named ${students_names[i]} with university ID ${students_numbers[i]} has been added.</p>`;
                        }
                        for (let i = 0; i < registration_array.length; i += 5) {
                            let semester = `Summer`;
                            if (registration_array[i + 3] == 1) {
                                semester = `First`;
                            } else if (registration_array[i + 3] == 2) {
                                semester = `Second`;
                            }
                            progress += `<p>Student ${registration_array[i]} with university ID ${registration_array[i + 1]} has been registered in course ${registration_array[i + 2]} for the year ${registration_array[i + 4]} in the ${semester} semester.</p>`;
                        }
                        document.getElementById('progress').innerHTML = progress;
                    }
                },
                error: function (error) {
                    $('#LoadingModal').modal('hide');
                }
            });
        }

    }
    function create_options(headers , id) {
        let selectOptions = document.getElementById(id) , cnt = 0;
        selectOptions.innerHTML = '';
        let option = document.createElement('option');
        option.value = -1;
        option.text = `{{__('translate.Choose Field')}}`; // اختر الحقل
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
        let nextButton = document.getElementById('next1');
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
                    if(response.status === 0) {
                        nextButton.disabled = true;
                        document.getElementById('errorPageOne').innerHTML = `
                            <div class="alert alert-danger">
                                يُرجى اختيار ملف إكسل فقط
                            </div>
                        `;
                    }
                    else {
                        nextButton.disabled = false;
                        document.getElementById('errorPageOne').innerHTML = ``;
                    }
                    $(`#progress-container`).hide();
                    document.getElementById('name_file_hidden').value = response.name_file_hidden;
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
                    $('#progress-container').hide();
                }
            });
        }
    }
</script>
@endsection
