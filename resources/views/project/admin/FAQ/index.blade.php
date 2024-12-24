@extends('layouts.app')
@section('title')
    فئات الأسئلة الشائعة
@endsection
@section('header_title')
    فئات الأسئلة الشائعة
@endsection
@section('header_title_link')
    فئات الأسئلة الشائعة
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">{{__('translate.Training Places')}} {{-- أماكن التدريب --}}</a>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.faq.add') }}" class="btn btn-primary mb-2 btn-sm" type="button">اضافة سؤال</a>
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
                        <div id="list_faq_category_ajax" class="col-md-12 table-responsive">

                        </div>
                    </div>

                </div>
            </div>
            @include('project.admin.FAQ.modals.add_faq_model')
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        $(document).ready(function () {
            list_faq_ajax();
        });
        function list_faq_ajax() {
            $.ajax({
                url: "{{route('admin.faq.list_faq_ajax')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    company_id : $('#company_id').val(),
                    supervisor_id : $('#supervisor_id').val()
                },
                success: function(response) {
                    $('#list_faq_category_ajax').html(response.view);
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
        function update_faq_category(data) {
            $('#faq_category_id').val(data.c_id);
            $('#c_name').val(data.c_name);
            $('#update_faq_category_modal').modal('show');
        }
    </script>
@endsection
