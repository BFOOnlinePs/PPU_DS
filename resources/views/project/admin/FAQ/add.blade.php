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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">نص السؤال</label>
                                <input type="text" class="form-control" name="question" id="question">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الجواب للويب</label>
                                <textarea name="answer_web" id="editor_web" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الجواب للموبايل</label>
                                <textarea name="answer_mobile" id="editor_mobile" cols="30" rows="10"></textarea>
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
                                            <input id="checkbox{{ $loop->index}}" type="checkbox">
                                            <label for="checkbox{{ $loop->index}}">{{ $key->r_name }}</label>
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الفئات</label>
                                <div class="row">
                                    @foreach ($categories as $key)
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <input id="category{{ $loop->index}}" type="checkbox">
                                            <label for="category{{ $loop->index}}">{{ $key->c_name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary">اضافة</button>
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
