@extends('layouts.app')
@section('title')
    التسليم النهائي
@endsection
@section('header_title')
    التسليم النهائي
@endsection
@section('header_title_link')
    <a href="{{ route('home') }}">{{ __('translate.Main') }}{{-- الرئيسية --}}</a>
@endsection
@section('header_link')
    التسليم النهائي
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('students.final_reports.create') }}" class="row" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اضافة التقرير النهائي</label>
                                    <input type="file" class="form-control" name="final_file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                @if (!empty($registration->final_file))
                                    <a class="btn btn-primary btn-sm mb-2"
                                        href="{{ asset('public/storage/uploads/' . $registration->final_file) }}"
                                        download="finale_file">تحميل
                                        الملف
                                        السابق</a>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-success">تسليم التقرير</button>
                            </div>
                        </form>
                        {{-- @if (!empty($registration->final_file))
                            <h4>تم تسليم التقرير بنجاح</h4>
                        @elseif (empty($registration->final_file))
                            <form action="{{ route('students.final_reports.create') }}" class="row" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">اضافة التقرير النهائي</label>
                                        <input type="file" class="form-control" name="final_file">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-success">تسليم التقرير</button>
                                </div>
                            </form>
                        @else
                            <h3>التسليم النهائي غير متاح</h3>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
