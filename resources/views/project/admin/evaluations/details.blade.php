@extends('layouts.app')
@section('title')
    تفاصيل التقييم
@endsection
@section('header_title')
    تفاصيل التقييم
@endsection
@section('header_title_link')
    تفاصيل التقييم
@endsection
@section('header_link')
    تفاصيل التقييم
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" id="student_name" onkeyup="list_evaluation_details_list()"
                                    class="form-control" placeholder="بحث عن الطالب">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" onchange="list_evaluation_details_list()" name=""
                                    id="course_id">
                                    <option value="">جميع التدريبات</option>
                                    @foreach ($semesters as $key)
                                        <option value="{{ $key->sc_id }}">{{ $key->courses->c_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" placeholder="بحث عن اسم التدريب"> --}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" onchange="list_evaluation_details_list()" name=""
                                    id="supervisor_id">
                                    <option value="">جميع المشرفين</option>
                                    @foreach ($supervisors as $key)
                                        <option value="{{ $key->u_id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" id="supervisor_name" placeholder="اسم المشرف"> --}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" onchange="list_evaluation_details_list()" name=""
                                    id="company_id">
                                    <option value="">جميع الشركات</option>
                                    @foreach ($companies as $key)
                                        <option value="{{ $key->c_id }}">{{ $key->c_name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" placeholder="بحث عن اسم الشركة"> --}}
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
                            <div class="table-responsive" id="evaluation_deatils_table">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            list_evaluation_details_list();
        })

        function list_evaluation_details_list() {
            $.ajax({
                url: '{{ route('admin.evaluations.list_evaluation_details_list') }}',
                datatype: "json",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "student_name": $('#student_name').val(),
                    "course_id": $('#course_id').val(),
                    "supervisor_id": $('#supervisor_id').val(),
                    "company_id": $('#company_id').val(),
                },
                success: function(response) {
                    $('#evaluation_deatils_table').html(response.view);
                },
                error: function(error) {
                    alert(error);
                }
            })
        }
    </script>
@endsection
