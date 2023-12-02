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
    <div class="card p-4" >
        <div class="card-header pb-0">
            <input type="hidden" value="{{$id}}" name="student_id" id="student_id">
            <h4 class="card-title mb-0">سِجل الحضور و المغادرة</h4>
        </div>
        <div class="row">
            <div class="col-md-3">
                <input type="date" class="form-control digits" id="from">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control digits" id="to">
            </div>
        </div>
        <div class="row" id="error" style="display: none">
            <h6 class="alert alert-danger">لا يوجد سجلات لعرضها</h6>
        </div>
        <div id="content">
            @include('project.company_manager.students.attendance.includes.attendanceList')
        </div>
    </div>
</div>
</div>
@include('project.student.attendance.ajax.loading')
@endsection
@section('script')
<script>
    $(document).ready(function () {
        let nextPageUrl = "{{ route('company_manager.students.attendance.index_ajax') }}";
        let student_id = document.getElementById('student_id').value;
        loadMoreStudentAttendances();
        // Function to load more student attendances
        function loadMoreStudentAttendances() {
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
                    'from': from,
                    'to': to,
                    'student_id': student_id
                },
                success: function (data) {
                    nextPageUrl = data.nextPageUrl;
                    // alert(data.x); // alert
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
                    // document.getElementById('loading').style.display = 'none';
                }
            });
        }
        $('#to, #from').change(function () {
            // Your action when the date changes goes here
            $('table tbody').empty();
            nextPageUrl = "{{ route('company_manager.students.attendance.index_ajax') }}";
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

