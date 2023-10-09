@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
عرض المستخدمين
@endsection
@section('content')
<div class="col-sm-12">
    <button  data-toggle="modal" data-target="#add-user-modal">
        إضافة مستخدم
    </button>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover" id="user-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الايميل</th>
                        <th>رقم الجوال</th>
                        <th>رقم جوال احتياطي</th>
                        <th>عنوان السكن</th>
                        <th>تاريخ الميلاد</th>
                        <th>الجنس</th>
                        <th>التخصص</th>
                        <th>الدور</th>
                        <th>حالة الحساب</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key)
                        <tr id="user-row-{{ $key->id }}">
                            <td>{{$key->name}}</td>
                            <td>{{$key->email}}</td>
                            <td>{{$key->phone1}}</td>
                            <td>{{$key->phone2}}</td>
                            <td>{{$key->address}}</td>
                            <td>{{$key->date_of_birth}}</td>
                            <td>{{$key->gender}}</td>
                            <td>{{$key->major_id}}</td>
                            <td>{{$key->role_id}}</td>
                            @if ($key->status == 0)
                                <td class="bg-danger text-white" id="td-{{$key->id}}">
                                        غير مفعل
                                </td>
                            @else
                                <td class="bg-success text-white" id="td-{{$key->id}}">
                                    مفعل
                                </td>
                            @endif
                            {{-- <td>
                                <button class="btn btn-primary edit-user" data-toggle="modal" data-target="#myModal" data-userid="{{ $key->id }}" >تعديل الحساب</button>
                                @if ($key->status == 1)
                                    <button class="btn btn-danger" onclick="clickToDeactivateButton({{$key->id}})" id="btn-{{$key->id}}">تعطيل الحساب</button>
                                @else
                                     <button class="btn btn-success" onclick="clickToDeactivateButton({{$key->id}})" id="btn-{{$key->id}}">تفعيل الحساب</button>
                                @endif
                                <button class="btn btn-danger" onclick="delete_account({{$key->id}})" id="delete-btn-{{$key->id}}">حذف الحساب</button>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('project.admin.users.add')
</div>
@endsection
@section('javascript')
    <script>
        function sayHello() {
            alert("Hello!");
        }
    </script>
@endsection
