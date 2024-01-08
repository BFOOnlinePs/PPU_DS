@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title')
المستخدمين
@endsection
@section('header_title_link')
    <a href="{{route('home')}}">الرئيسية</a>
@endsection
@section('header_link')
    <a href="{{route('admin.users.index')}}">إدارة المستخدمين</a>
@endsection
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <div>
                @include('project.communications_manager_with_companies.companies.tables.students')
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
