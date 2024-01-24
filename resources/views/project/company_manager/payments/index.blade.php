@extends('layouts.app')
@section('title')
{{__('translate.Users')}}{{-- المستخدمين --}}
@endsection
@section('header_title_link')
{{__('translate.Users')}}{{-- المستخدمين --}}

@endsection
@section('header_link')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @include('project.company_manager.payments.includes.paymentsList')
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

