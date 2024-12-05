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
                        @if ($setting->ss_report_status == 0)
                            <h3>التسليم النهائي غير متاح</h3>
                        @elseif ($setting->ss_report_status == 1)
                        <form action="{{ route('students.final_reports.create') }}" class="row" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">اضافة التقرير النهائي
                                    @if (!empty($registration->final_file))
                                        <a href="{{ asset('public/storage/uploads/'.$registration->final_file) }}" download="{{ $registration->final_file }}"><span class="fa fa-download"></span></a>
                                    @endif
                                </label>
                                <input type="file" class="form-control" name="final_file" multiple>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary">تسليم التقرير</button>
                        </div>
                    </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
