<<<<<<< HEAD
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
                {{ session('success') }}
=======
<<<<<<< HEAD
<form id="edit-form">
=======
<form id="edit_form">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
<<<<<<< HEAD
                <input type="hidden" class="form-control" name="u_id" value="{{$user->u_id}}">
=======
                <input type="hidden" class="form-control" name="u_id" value="{{$user->u_id}}" id="edit_form_u_id">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
=======
                <input type="text" class="form-control" name="name" value="{{$user->name}}" id="edit_form_name">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_username">اسم المستخدم</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="u_username" value="{{$user->u_username}}">
=======
                <input type="text" class="form-control" name="u_username" value="{{$user->u_username}}" id="edit_form_u_username" onkeyup="user_email(this.value)">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
=======
                <input type="text" class="form-control" name="email" value="{{$user->email}}" id="edit_form_email" readonly>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_phone1">رقم الجوال</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="u_phone1" value="{{$user->u_phone1}}">
=======
                <input type="text" class="form-control" name="u_phone1" value="{{$user->u_phone1}}" id="edit_form_u_phone1">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_phone2">رقم جوال احتياطي</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="u_phone2" value="{{$user->u_phone2}}">
=======
                <input type="text" class="form-control" name="u_phone2" value="{{$user->u_phone2}}" id="edit_form_u_phone2">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_address">عنوان السكن</label>
<<<<<<< HEAD
                <input type="text" class="form-control" name="u_address" value="{{$user->u_address}}">
=======
                <input type="text" class="form-control" name="u_address" value="{{$user->u_address}}" id="edit_form_u_address">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_date_of_birth">تاريخ الميلاد</label>
<<<<<<< HEAD
                <input type="date" class="form-control" name="u_date_of_birth" value="{{$user->u_date_of_birth}}">
=======
                <input type="date" class="form-control" name="u_date_of_birth" value="{{$user->u_date_of_birth}}" id="edit_form_u_date_of_birth">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
            </div>
        </div>
        @if ($user->u_role_id == 2)
            <div class="col-md-4">
                <div class="form-group">
                    <label for="u_major_id">التخصص</label>
<<<<<<< HEAD
                    <input type="text" class="form-control" name="u_major_id" value="{{$user->u_major_id}}">
=======
                    <input type="text" class="form-control" name="u_major_id" value="{{$user->u_major_id}}" id="edit_form_u_major_id">
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
                </div>
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.users.update') }}" class="card" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="u_id" value="{{ $user->u_id }}">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">تعديل معلومات المستخدم | {{ $user->u_username }}</h4>
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
                                    <label class="form-label">الاسم</label>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">اسم المستخدم</label>
                                    <input class="form-control" type="text" name="u_username" value="{{ $user->u_username }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">البريد الإلكتروني</label>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">تاريخ الميلاد</label>
                                    <input class="form-control" type="date" name="u_date_of_birth"
                                        value="{{ $user->u_date_of_birth }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">كلمة السر</label>
                                    <input class="form-control" type="password" name="password" placeholder="...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">رقم الجوال</label>
                                    <input class="form-control" type="text" name="u_phone1" value="{{ $user->u_phone1 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">رقم جوال احتياطي</label>
                                    <input class="form-control" type="text" name="u_phone2" value="{{ $user->u_phone2 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="media">
                                        <label class="col-form-label m-r-10">تفعيل أو تعطيل الحساب</label>
                                        <div class="media-body text-end">
                                          <label class="switch">
                                            <input type="checkbox" name="u_status" @if($user->u_status == 1) checked @endif><span class="switch-state"></span>
                                          </label>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group m-t-15 custom-radio-ml">
                                    <label class="form-label">الجنس</label>
                                    <div class="radio radio-primary">
                                        <input id="radio1" type="radio" name="u_gender" value="0" {{ $user->u_gender == 0 ? 'checked' : '' }}>
                                        <label for="radio1" style="padding-right: 2px">ذكر</label>
                                        <input id="radio2" type="radio" name="u_gender" value="1" style="margin: 10px;" {{ $user->u_gender == 1 ? 'checked' : '' }}>
                                        <label for="radio2" style="padding-right: 2px">أنثى</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">الدور</label>
                                    <input class="form-control" type="text" name="u_role_id" value="{{ $user->u_role_id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">التخصص</label>
                                    <input class="form-control" type="text" name="u_major_id" value="{{ $user->u_major_id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">عنوان السكن</label>
                                    <input class="form-control" type="text" name="u_address" value="{{ $user->u_address }}">
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>
@endsection
=======
<<<<<<< HEAD
    <button class="btn btn-primary btn-sm" type="submit" id="serialize-button">حفظ التعديلات</button>
=======
    <button class="btn btn-primary" type="submit" onclick="update_user()">حفظ التعديلات</button>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
</form>
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477

@section('script')
<!-- Add your JavaScript code here if needed -->
@endsection
