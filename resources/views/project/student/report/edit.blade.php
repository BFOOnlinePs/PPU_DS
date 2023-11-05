@extends('layouts.app')
@section('content')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
@endsection
<div class="container-fluid">
    <div class="email-wrap">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="email-right-aside">
                    <div class="card email-body">
                        <div class="email-profile">
                            <div class="email-body">
                                <div class="email-compose">
                                    <div class="email-top compose-border">
                                        <div class="compose-header">
                                            <h4>تسليم التقرير</h4>
                                        </div>
                                    </div>
                                    <div class="email-wrapper">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <form action="{{route('students.attendance.report.submit')}}" class="theme-form" method="post" enctype="multipart/form-data" id="myForm">
                                            @csrf
                                            <input type="hidden" id="latitude" name="latitude">
                                            <input type="hidden" id="longitude" name="longitude">
                                            <input type="text" value="{{$student_report->sr_id}}" name="sr_id" id="sr_id" hidden>
                                            <div class="form-group">
                                                <label class="col-form-label pt-0" for="text-box">ملاحظات عن التقرير</label>
                                                <textarea name="sr_report_text" id="text-box">{{$student_report->sr_report_text}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="dropzone digits text-center dz-clickable" id="singleFileUpload">
                                                    <input type="file" onchange="submitFile(this, {{$student_report->sr_id}})" id="input-file" name="file" hidden>
                                                    <div class="dz-message needsclick">
                                                        <i class="icon-cloud-up"></i>
                                                        <h6>قم بسحب الملف هنا أو انقر للرفع</h6>
                                                    </div>
                                                    <div id="progress-container" style="display: none;">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <span id="progress-text">Uploading...</span>
                                                    </div>
                                                    @if (isset($student_report->sr_attached_file))
                                                        <button class="btn-close" type="button" onclick="remove_file()" id="remove_button"></button>
                                                        <a href="{{ asset('storage/student_reports/'.$student_report->sr_attached_file) }}" id="downloadLink" download>{{$student_report->sr_attached_file}}</a>

                                                    @else
                                                        <button class="btn-close" type="button" onclick="remove_file()" style="display: none" id="remove_button"></button>
                                                        <a href="" id="downloadLink" style="display: none" download></a>
                                                    @endif
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-secondary" id="submitButton"><i class="fa fa-paper-plane me-2"></i>تسليم التقرير</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
    <script src="{{asset('assets/js/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/editor/ckeditor/adapters/jquery.js')}}"></script>
    <script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
    <script src="{{asset('assets/js/email-app.js')}}"></script>

    <script>
        const dropArea = document.getElementById('singleFileUpload');
        const inputFile = document.getElementById('input-file');

        dropArea.addEventListener("dragover", function(e) {
            e.preventDefault();
        });
        dropArea.addEventListener("drop", function(e) {
            e.preventDefault();
            inputFile.files = e.dataTransfer.files;
            submitFile(inputFile, document.getElementById('sr_id').value);
        });
        function remove_file() {
            let sr_id = document.getElementById('sr_id').value;
            $.ajax({
                    url: "{{ route('students.attendance.report.remove_file') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'sr_id': sr_id
                    },
                    success: function (response) {
                        $("#downloadLink").attr("href" , "");
                        $('#downloadLink').text("");
                        $("#downloadLink").css("display", "none");
                        $("#remove_button").css("display", "none");
                        inputFile.value = null;
                    },
                    error: function (error) {
                        // Handle error, if needed
                        console.error(error);
                        $('#progress-container').hide();
                    }
                });
        }
        function submitFile(input, sr_id) {
            let file = input.files[0];
            if (file) {
                let formData = new FormData();
                formData.append('sr_id', sr_id);
                formData.append('input-file', file);
                $(`#progress-container`).show();
                // Make an AJAX request to submit the file
                $.ajax({
                    url: "{{ route('students.attendance.report.upload') }}",
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
                        $("#downloadLink").attr("href", `{{ asset('storage/student_reports/${response.newHref}') }}`);
                        $("#downloadLink").attr("href", `{{ asset('storage/student_reports/${response.newHref}') }}`);
                        $('#downloadLink').text(response.newHref);
                        $("#downloadLink").css("display", "");
                        $("#remove_button").css("display", "");
                    },
                    error: function (error) {
                        // Handle error, if needed
                        console.error(error);
                        $('#progress-container').hide();
                    }
                });
            }
        }








        var submitButton = document.getElementById('submitButton');
        function showPosition(position) {
            document.querySelector('#latitude').value = position.coords.latitude;
            document.querySelector('#longitude').value = position.coords.longitude;
            document.getElementById('myForm').submit();
        }
        submitButton.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the form from submitting (optional)

            navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                // Check the state of geolocation permission
                if (permissionStatus.state === 'granted') {
                    // Geolocation is allowed
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
                else if(permissionStatus.state === 'denied') {
                    alert('To submit your report, you need to allow access to your location. Please go to the : \n \'chrome://settings/content/location\' \n to enable location access in your browser settings:\n(Or you can manually enable it by going to "Settings" -> "Privacy and security" -> "Site settings" -> "Permissions" -> "Location")');
                }
                else {
                    // Geolocation is denied or prompt is blocked
                    // Handle accordingly
                    alert('To submit your report, you need to allow access to your location.');
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            });
        });
        </script>
@endsection
