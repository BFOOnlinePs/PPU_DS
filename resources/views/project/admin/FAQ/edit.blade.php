@extends('layouts.app')
@section('title')
    اضافة سؤال
@endsection
@section('header_title')
    اضافة سؤال
@endsection
@section('header_title_link')
    اضافة سؤال
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">{{ __('translate.Training Places') }} {{-- أماكن التدريب --}}</a>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.faq.update') }}" class="row">
                        @csrf
                        <input type="hidden" value="{{ $data->faq_id }}" name="faq_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">نص السؤال</label>
                                <input value="{{ $data->faq_question }}" type="text" class="form-control"
                                    name="faq_question" id="question">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الجواب للويب</label>
                                <textarea name="faq_web_answer" id="editor_web" cols="30" rows="10">{{ $data->faq_web_answer }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الجواب للموبايل</label>
                                <textarea name="faq_mobile_answer" id="editor_mobile" cols="30" rows="10">{{ $data->faq_mobile_answer }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الصلاحيات المتعلقة بالسؤال</label>
                                <div class="row">
                                    @foreach ($roles as $key)
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <input @if (in_array($key->r_id, json_decode($data->faq_target_role_ids))) checked @endif
                                                    id="checkbox{{ $loop->index }}" value="{{ $key->r_id }}"
                                                    name="faq_target_role_ids[]" type="checkbox">
                                                <label for="checkbox{{ $loop->index }}">{{ $key->r_name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        @php
                            $selectedCategories = [];
                            if (isset($data) && isset($data->faq_category_ids)) {
                                $decoded = json_decode($data->faq_category_ids, true);
                                $selectedCategories = is_array($decoded) ? $decoded : [];
                            }
                        @endphp

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الفئات</label>
                                <div class="row">
                                    @foreach ($categories as $key)
                                        <div class="col-md-3">
                                            <div class="checkbox">
                                                <input @if (!empty($selectedCategories) && in_array($key->c_id, $selectedCategories)) checked @endif
                                                    id="category{{ $loop->index }}" value="{{ $key->c_id }}"
                                                    name="faq_category_ids[]" type="checkbox">
                                                <label for="category{{ $loop->index }}">{{ $key->c_name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/styles.js') }}"></script>
    <script src="{{ asset('assets/js/editor/ckeditor/ckeditor.custom.js') }}"></script>

    <script>
        $(document).ready(function() {
            CKEDITOR.replace('editor_web');
            CKEDITOR.replace('editor_mobile');
        });
    </script>
@endsection
