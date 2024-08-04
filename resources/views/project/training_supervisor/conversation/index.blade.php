@extends('layouts.app')
@section('title')
    المراسلات
@endsection
@section('header_title')
    المراسلات
@endsection
@section('header_title_link')
    المراسلات
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">{{__('translate.Training Places')}} {{-- أماكن التدريب --}}</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('training_supervisor.conversation.add') }}" class="btn btn-primary btn-sm">اضافة مراسلة جديدة</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>عنوان الرسالة</th>
{{--                                <th>الشخص المرسل اليه</th>--}}
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center">لا توجد مراسلات</td>
                                </tr>
                            @else
                                @foreach($data as $key)
                                    <tr>
                                        <td>{{ $key->c_name }}</td>
{{--                                        <td>{{ $key->user->name }}</td>--}}
                                        <td>
                                            <a href="{{ route('training_supervisor.conversation.details',['id'=>$key->c_id]) }}" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
