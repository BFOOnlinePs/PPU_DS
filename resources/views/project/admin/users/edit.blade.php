@extends('layouts.app')

@section('title', 'المستخدمين')
@section('header_title', 'المستخدمين')
@section('header_title_link', 'المستخدمين')
@section('header_link', 'تعديل المستخدم')

@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        @if(session('success'))
            <div class="alert alert-success">
                @if (session('success') == 'تم تعديل بيانات هذا المستخدم بنجاح')
                    {{__('translate.The user data has been successfully edited')}}
                @endif
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.users.update') }}" class="card" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="u_id" value="{{ $user->u_id }}">
                    <div class="card-header pb-0">
                        @if (auth()->user()->u_role_id == 2) {{-- Student --}}
                            <h4 class="card-title mb-0">{{__('translate.Profile')}} {{-- الملف الشخصي --}}</h4>
                        @else
                            <h4 class="card-title mb-0">{{__('translate.User information modification')}} {{-- تعديل معلومات المستخدم --}} | {{ $user->u_username }}</h4>
                        @endif
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
                                    <label class="form-label">{{__('translate.Name')}} {{-- الاسم --}} * </label>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}" required @if (auth()->user()->u_role_id == 2) readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Username')}} {{-- اسم المستخدم --}} * </label>
                                    <input class="form-control" type="text" name="u_username" value="{{ $user->u_username }}" required @if (auth()->user()->u_role_id == 2) readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Email')}} {{-- البريد الإلكتروني --}} * </label>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}" required @if (auth()->user()->u_role_id == 2) readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Birth date')}} {{-- تاريخ الميلاد --}} * </label>
                                    <input class="form-control" type="date" name="u_date_of_birth" value="{{ $user->u_date_of_birth }}" @if (auth()->user()->u_role_id == 2) readonly @endif>
                                </div>
                            </div>
                            @if (auth()->user()->u_role_id != 2) {{-- If the user is student don't able to change or display his password --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Password')}} {{-- كلمة المرور --}} * </label>
                                        <input class="form-control" type="password" name="password" placeholder="...............">
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Phone number')}} {{-- رقم الجوال --}} * </label>
                                    <input class="form-control" type="text" name="u_phone1" value="{{ $user->u_phone1 }}" required @if (auth()->user()->u_role_id == 2) readonly @endif pattern="[0-9]{10}" minlength="10" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Reserve phone number')}} {{-- رقم جوال احتياطي --}}</label>
                                    <input class="form-control" type="text" name="u_phone2" value="{{ $user->u_phone2 }}" @if (auth()->user()->u_role_id == 2) readonly @endif pattern="[0-9]{10}" minlength="10" maxlength="10">
                                </div>
                            </div>
                            @if (auth()->user()->u_role_id != 2)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="media">
                                            <label class="col-form-label m-r-10">{{__('translate.Account activation or deactivation')}} {{-- تفعيل أو تعطيل الحساب --}}</label>
                                            <div class="media-body text-end">
                                            <label class="switch">
                                                <input type="checkbox" name="u_status" @if($user->u_status == 1) checked @endif><span class="switch-state"></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <label class="form-label">{{__('translate.Gender')}} * </label>
                                @if (auth()->user()->u_role_id == 2)
                                    @if ($user->u_gender == 0)
                                        <input class="form-control" type="text" value="{{__('translate.Male')}}" readonly> {{-- ذكر --}}
                                    @else
                                        <input class="form-control" type="text" value="{{__('translate.Female')}}" readonly> {{-- أنثى --}}
                                    @endif
                                    <div class="form-group m-t-15 custom-radio-ml">
                                @else
                                        <div class="form-group m-t-15 custom-radio-ml">
                                        <div class="radio radio-primary">
                                            <input id="radio1" type="radio" name="u_gender" value="0" {{ $user->u_gender == 0 ? 'checked' : '' }}>
                                            <label for="radio1" style="padding-right: 2px">{{__('translate.Male')}} {{-- ذكر --}}</label>
                                            <input id="radio2" type="radio" name="u_gender" value="1" style="margin: 10px;" {{ $user->u_gender == 1 ? 'checked' : '' }}>
                                            <label for="radio2" style="padding-right: 2px">{{__('translate.Female')}} {{-- أنثى --}}</label>
                                        </div>
                                @endif
                                    </div>
                            </div>
                            @if (auth()->user()->u_role_id != 2)
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">{{__('translate.Role')}} {{-- الدور --}}</label>
                                        <select  class="form-control" name="u_role_id" id="">
                                            <option value="{{$role_id->r_id}}">
                                                @if ($role_id->r_name == 'أدمن')
                                                    {{__('translate.Administrator')}} {{-- أدمن --}}
                                                @elseif($role_id->r_name == 'طالب')
                                                    {{__('translate.Student')}} {{-- طالب --}}
                                                @elseif($role_id->r_name == 'مشرف أكاديمي')
                                                    {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                                                @elseif($role_id->r_name == 'مساعد إداري')
                                                    {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                                                @elseif($role_id->r_name == 'مسؤول متابعة وتقييم')
                                                    {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
                                                @elseif($role_id->r_name == 'مدير شركة')
                                                    {{__('translate.Company manager')}} {{-- مدير شركة --}}
                                                @elseif($role_id->r_name == 'مسؤول تدريب')
                                                    {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                                                @endif
                                            </option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->r_id}}">
                                                    @if ($role->r_name == 'أدمن')
                                                        {{__('translate.Administrator')}} {{-- أدمن --}}
                                                    @elseif($role->r_name == 'طالب')
                                                        {{__('translate.Student')}} {{-- طالب --}}
                                                    @elseif($role->r_name == 'مشرف أكاديمي')
                                                        {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                                                    @elseif($role->r_name == 'مساعد إداري')
                                                        {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                                                    @elseif($role->r_name == 'مسؤول متابعة وتقييم')
                                                        {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
                                                    @elseif($role->r_name == 'مدير شركة')
                                                        {{__('translate.Company manager')}} {{-- مدير شركة --}}
                                                    @elseif($role->r_name == 'مسؤول تدريب')
                                                        {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{__('translate.Home address')}} {{-- عنوان السكن --}}</label>
                                    <input class="form-control" type="text" name="u_address" value="{{ $user->u_address }}" @if (auth()->user()->u_role_id == 2) readonly @endif>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    @if ($user->u_role_id == 2)
                                        <label class="form-label">{{__('translate.Major')}} {{-- التخصص --}}</label>
                                        @if (auth()->user()->u_role_id == 2)
                                            <input class="form-control" type="text" value="{{$major_id->m_name}}" readonly>
                                        @else
                                            <select  class="form-control" name="u_major_id" id="">
                                                <option value="{{$major_id->m_id}}">{{$major_id->m_name}}</option>
                                                @foreach ($majors as $major)
                                                    <option value="{{$major->m_id}}">{{$major->m_name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @if (auth()->user()->u_role_id != 2)
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">{{__('translate.Save changes')}} {{-- حفظ التعديلات --}}</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
