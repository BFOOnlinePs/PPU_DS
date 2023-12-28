@extends('layouts.app')
@section('title')
{{__('translate.Profile')}} {{-- الملف الشخصي --}}
@endsection
@section('header_title')
@endsection
@section('header_title_link')
@endsection
@section('header_link')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin.users.update') }}" class="card" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="u_id" value="{{ $user->u_id }}">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">{{__('translate.Profile')}} {{-- الملف الشخصي --}}</h4>
                            <div class="card-options">
                                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                                    <i class="fe fe-chevron-up"></i>
                                </a>
                                <a class="card-options-remove" href="#" data-bs-toggle="card-remove">
                                    <i class="fe fe-x"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Name')}} {{-- الاسم --}}</label>
                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Username')}} {{-- اسم المستخدم --}}</label>
                                        <input class="form-control" type="text" name="u_username" value="{{ $user->u_username }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Email')}} {{-- البريد الإلكتروني --}}</label>
                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Birth date')}} {{-- تاريخ الميلاد --}}</label>
                                        <input class="form-control" type="date" name="u_date_of_birth" value="{{ $user->u_date_of_birth }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Phone number')}} {{-- رقم الجوال --}}</label>
                                        <input class="form-control" type="text" name="u_phone1" value="{{ $user->u_phone1 }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Reserve phone number')}} {{-- رقم جوال احتياطي --}}</label>
                                        <input class="form-control" type="text" name="u_phone2" value="{{ $user->u_phone2 }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">{{__('translate.Gender')}}{{-- الجنس --}}</label>
                                    @if ($user->u_gender == 0)
                                        <input class="form-control" type="text" value="ذكر" readonly>
                                    @else
                                        <input class="form-control" type="text" value="أنثى" readonly>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Home address')}} {{-- عنوان السكن --}}</label>
                                        <input class="form-control" type="text" name="u_address" value="{{ $user->u_address }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Majors')}} {{-- التخصص --}}</label>
                                        <input class="form-control" type="text" value="{{$major_id->m_name}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

