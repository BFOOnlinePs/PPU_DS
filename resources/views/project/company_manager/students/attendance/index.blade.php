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
            <h4 class="card-title mb-0">{{__('translate.Record attendance and departure')}} {{-- سِجل الحضور و المغادرة --}}</h4>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <label class="from-control digits">{{__('translate.From')}}{{-- من --}}:</label>
                <input type="date" class="form-control digits" id="from" onchange="function_to_filltering()">
            </div>
            <div class="col-md-3">
                <label class="from-control digits">{{__('translate.To')}}{{-- إلى --}}:</label>
                <input type="date" class="form-control digits" id="to" onchange="function_to_filltering()">
            </div>
        </div>
        <br>
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
    function function_to_filltering()
    {
        let from = $('#from').val();
        let to = $('#to').val();
        let student_id = document.getElementById('student_id').value;
        $.ajax({
            url: "{{ route('company_manager.students.attendance.index_ajax') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            beforeSend: function () {
                document.getElementById('loading').style.display = '';
            },
            data: {
                'from': from,
                'to': to,
                'student_id': student_id
            },
            success: function (data) {
                if(data.html == '') {
                    document.getElementById('content').style.display = 'none';
                    document.getElementById('loading').style.display = 'none';
                }
                else {
                    document.getElementById('content').style.display = '';
                    $('#content').html(data.html);
                    document.getElementById('loading').style.display = 'none';
                }
            },
            error: function (xhr, status, error) {
            }
        });
    }

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

