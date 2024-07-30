@extends('layouts.app')
@section('title')
    اضافة مراسلة
@endsection
@section('header_title')
    اضافة مراسلة
@endsection
@section('header_title_link')
    اضافة مراسلة
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">{{__('translate.Training Places')}} {{-- أماكن التدريب --}}</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">عنوان المراسلة</label>
                                <input type="text" class="form-control" placeholder="عنوان المراسلة">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">الى المستخدم</label>
                                <select class="form-control" name="" id="">
                                    <option value="">اختر شخص ...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">نص المراسلة</label>
                                <textarea name="" id="" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="row">
                <div class="col-md-12">
                    <span style="font-size: 200px" class="fa fa-comment"></span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
