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
                            <a href="{{ route('admin.faq_category.index') }}" class="btn btn-primary mb-2 btn-sm">FAQ Category</a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">البحث في الاسئلة الشائعة</label>
                                <input onkeyup="list_faq_ajax()" type="text" id="faq_question_search" class="form-control" placeholder="البحث في الاسئلة الشائعة">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">الصلاحيات</label>
                                <select onchange="list_faq_ajax()" class="js-example-basic-multiple" multiple="multiple" name="" id="faq_target_role_ids">
                                    @foreach ($roles as $key)
                                        <option value="{{$key->r_id}}">{{ $key->r_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">الفئات</label>
                                <select onchange="list_faq_ajax()" class="js-example-basic-multiple" multiple="multiple" name="" id="faq_category_ids">
                                    @foreach ($category as $key)
                                        <option value="{{$key->c_id}}">{{ $key->c_name }}</option>
                                    @endforeach
                                </select>
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
                        <div id="list_faq_ajax" class="col-md-12 table-responsive">

                        </div>
                    </div>

                </div>
            </div>
            @include('project.admin.FAQ.modals.add_faq_model')
            @include('project.admin.FAQ.modals.answer_details')
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
                    'faq_question_search':$('#faq_question_search').val(),
                    'faq_target_role_ids':$('#faq_target_role_ids').val(),
                    'faq_category_ids':$('#faq_category_ids').val(),
                },
                success: function(response) {
                    $('#list_faq_ajax').html(response.view);
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
        function open_answer_details(data) {
            $('#faq_id').val(data.f_id);
            $('#web_answer').html(data.faq_web_answer);
            $('#mobile_answer').html(data.faq_mobile_answer);
            $('#answer_details_modal').modal('show');
        }
    </script>
@endsection
