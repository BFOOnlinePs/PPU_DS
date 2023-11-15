@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
@endsection
@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="col-xl-12">
            <form class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title mb-0">سِجل الحضور و المغادرة</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @include('project.admin.users.modals.loading')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <select autofocus class="js-example-basic-single col-sm-12" id="sc_id">
                                @if (isset($student_company->company->c_name))
                                <option value="{{$student_company->sc_id}}">{{$student_company->company->c_name}} @if (isset($student_company->companyBranch->b_address)) | العنوان : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | الدائرة : {{$student_company->companyDepartment->d_name}} @endif</option>
                                <option value="">جميع الشركات</option>
                                @foreach ($student_companies as $student_company)
                                <option value="{{$student_company->sc_id}}">{{$student_company->company->c_name}} @if (isset($student_company->companyBranch->b_address)) | العنوان : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | الدائرة : {{$student_company->companyDepartment->d_name}} @endif</option>
                                @endforeach
                                @else
                                <option value="">جميع الشركات</option>
                                @foreach ($student_companies as $student_company)
                                <option value="{{$student_company->sc_id}}">{{$student_company->company->c_name}} @if (isset($student_company->companyBranch->b_address)) | العنوان : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | الدائرة : {{$student_company->companyDepartment->d_name}} @endif</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3">
                                <input type="date" class="form-control digits" id="from">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control digits" id="to">
                            </div>
                        </div>
                    <hr style="background: white">
                    <div class="row" id="error" style="display: none">
                        <h6 class="alert alert-danger">لا يوجد سجلات لعرضها</h6>
                    </div>
                    <div class="row" id="content">
                        @include('project.student.attendance.ajax.attendanceList')
                    </div>
                </div>
            </form>
            @include('project.student.attendance.ajax.loading')
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        $(document).ready(function () {
            let nextPageUrl = "{{ route('students.attendance.ajax_company_from_to') }}";
            loadMoreStudentAttendances();
            // Function to load more student attendances
            function loadMoreStudentAttendances() {
                let sc_id = $('#sc_id').val();
                let from = $('#from').val();
                let to = $('#to').val();
                $.ajax({
                    url: nextPageUrl,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                        nextPageUrl = '';
                        document.getElementById('loading').style.display = '';
                    },
                    data: {
                        'sc_id': sc_id,
                        'from': from,
                        'to': to
                    },
                    success: function (data) {
                        nextPageUrl = data.nextPageUrl;
                        if(data.html == '') {
                            document.getElementById('error').style.display = '';
                            document.getElementById('content').style.display = 'none';
                            document.getElementById('loading').style.display = 'none';
                        }
                        else {
                            document.getElementById('error').style.display = 'none';
                            document.getElementById('content').style.display = '';
                            $('table tbody').append(data.html);
                            document.getElementById('loading').style.display = 'none';
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading more student attendances:", error);
                        document.getElementById('loading').style.display = 'none';
                    }
                });
            }
            // Initialize Select2
            $('#sc_id').select2();
            // Listen for Select2 select event
            $('#sc_id').on("select2:select", function (e) {
                // Your onchange logic goes here
                $('table tbody').empty();
                nextPageUrl = "{{ route('students.attendance.ajax_company_from_to') }}";
                loadMoreStudentAttendances();
            });
            $('#to, #from').change(function () {
                // Your action when the date changes goes here
                $('table tbody').empty();
                nextPageUrl = "{{ route('students.attendance.ajax_company_from_to') }}";
                loadMoreStudentAttendances();
            });
            // Scroll event listener for loading more data
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMoreStudentAttendances();
                    }
                }
            });
        });

        // Put 1 / 1 / current_year in input from
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const defaultDateString = `${currentYear}-01-01`;
        document.getElementById('from').value = defaultDateString;

        // Put current date in input to
        const today = new Date();
        const formattedDate = today.toISOString().slice(0, 10);
        document.getElementById('to').value = formattedDate;
    </script>
@endsection
