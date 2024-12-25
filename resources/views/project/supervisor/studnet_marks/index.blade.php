@extends('layouts.app')
@section('title')
    علامات الطلاب
@endsection
@section('header_title')
علامات الطلاب
@endsection
@section('header_title_link')
علامات الطلاب
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">الرئيسية</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" onkeyup="get_student_from_company()" class="form-control" id="student_name" placeholder="اسم الطالب">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" onkeyup="get_student_from_company()" class="form-control" id="company_name" placeholder="اسم التدريب">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="student_marks_table">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            get_student_from_company();
        });
        function get_student_from_company() {
            $.ajax({
                url: "{{route('supervisors.supervisors.list_student_mark_ajax')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'student_name':$('#student_name').val(),
                    'company_name':$('#company_name').val(),
                },
                success: function(response) {
                    $('#student_marks_table').html(response.view);
                },
                error: function (error) {
                    alert(error);
                }
            });
        }
    </script>
@endsection
