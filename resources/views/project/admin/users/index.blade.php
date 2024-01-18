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
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('navbar')
<div class="row p-2">
    @if (isset($u_role_id))
        <h1 class="text-center" id="r_name">
            @if ($role_name == 'أدمن')
                {{__('translate.Administrator')}} {{-- أدمن --}}
            @elseif($role_name == 'طالب')
                {{__('translate.Student')}} {{-- طالب --}}
            @elseif($role_name == 'مشرف أكاديمي')
                {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
            @elseif($role_name == 'مساعد إداري')
                {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
            @elseif($role_name == 'مسؤول متابعة وتقييم')
                {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
            @elseif($role_name == 'مدير شركة')
                {{__('translate.Company manager')}} {{-- مدير شركة --}}
            @elseif($role_name == 'مسؤول تدريب')
                {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
            @elseif($role_name == 'مسؤول التواصل مع الشركات')
                {{__('translate.Communications manager with companies')}} {{-- مسسؤول التواصل مع الشركات --}}
            @endif
        </h1>
    @endif
    <div class="container">
        <div class="container-fluid">
            <div class="col-md-12 row p-2 text-center">
                @foreach ($roles as $role)
                        @if ($role->r_name == 'أدمن')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Administrator')}}">
                            {{__('translate.Admin')}} {{-- أدمن --}}
                        @elseif($role->r_name == 'طالب')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Student')}}">
                            {{__('translate.Student')}} {{-- طالب --}}
                        @elseif($role->r_name == 'مشرف أكاديمي')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Academic supervisor')}}">
                            {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                        @elseif($role->r_name == 'مساعد إداري')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Supervisor assistant')}}">
                            {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                        @elseif($role->r_name == 'مسؤول متابعة وتقييم')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Monitoring and evaluation officer')}}">
                            {{__('translate.M&E')}} {{-- مسؤول متابعة وتقييم --}}
                        @elseif($role->r_name == 'مدير شركة')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Company manager')}}">
                            {{__('translate.Company manager')}} {{-- مدير شركة --}}
                        @elseif($role->r_name == 'مسؤول تدريب')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Training officer')}}">
                            {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                        @elseif($role->r_name == 'مسؤول التواصل مع الشركات')
                            <a class="col m-1 p-1 btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}" title="{{__('translate.Communications manager with companies')}}">
                            {{__('translate.Communications officer')}} {{-- مسسؤول التواصل مع الشركات --}}
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-sm-12" id="main">
    <div class="card">
        <div class="card-body">
            @if (isset($u_role_id) && $u_role_id != 6)
                @if ($role_name == 'أدمن')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Administrator')}}"><span class="fa fa-plus"></span>
                        {{__('translate.Add')}} {{-- إضافة --}}
                        {{__('translate.admin')}}{{-- أدمن --}}
                @elseif($role_name == 'طالب')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Student')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.student')}} {{-- طالب --}}
                @elseif($role_name == 'مشرف أكاديمي')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Academic supervisor')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.academic supervisor')}} {{-- مشرف أكاديمي --}}
                @elseif($role_name == 'مساعد إداري')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Supervisor assistant')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.supervisor assistant')}} {{-- مساعد إداري --}}
                @elseif($role_name == 'مسؤول متابعة وتقييم')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Monitoring and evaluation officer')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.M&E')}} {{-- مسؤول متابعة وتقييم --}}
                @elseif($role_name == 'مسؤول تدريب')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Training officer')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.training officer')}} {{-- مسؤول تدريب --}}
                @elseif($role_name == 'مسؤول التواصل مع الشركات')
                    <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" title="{{__('translate.Communications officer')}}"><span class="fa fa-plus"></span>
                    {{__('translate.Add')}} {{-- إضافة --}}
                    {{__('translate.communications officer')}} {{-- مسسؤول التواصل مع الشركات --}}
                @endif
                </button>
            @else
                <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" style="display: none"><span class="fa fa-plus"></span></button>
            @endif
            <input class="form-control mb-2 " id="search_input" onkeyup="user_search(this.value)" type="search" placeholder="{{__('translate.Search')}}"> {{-- البحث --}}
            <div id="user-table">
                @include('project.admin.users.ajax.usersList')
            </div>
        </div>
    </div>
    @include('project.admin.users.modals.add')
    @include('project.admin.users.modals.loading')
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        function close_add_modal()
        {
            document.getElementById('addUserForm').reset();
            document.getElementById('email_duplicate_message').style.display = 'none';
            const errorContainer = document.getElementById('error-container');
            errorContainer.innerHTML = '';
            $('#u_major_id').val(null).trigger('change');
        }
        $(document).ready(function() {
            const table = document.getElementById('users_table');
            if(table === null) {
                document.getElementById('search_input').style.display = 'none';
            }
            else {
                document.getElementById('search_input').style.display = '';
            }
        });
        let username = document.getElementById('u_username');
        let email = document.getElementById('email');
        username.addEventListener("change" , function() {
            email.value = username.value + "@ppu.edu.ps";
        });
        let AddUserForm = document.getElementById("addUserForm");
        AddUserForm.addEventListener("submit", (e) => {
            e.preventDefault();
            data = $('#addUserForm').serialize();
            $.ajax({
                beforeSend: function(){
                    // $('#AddUserModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.create')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: data,
                success: function(response) {
                    $('#AddUserModal').modal('hide');
                    document.getElementById('addUserForm').reset();
                    $('#user-table').html(response.html);
                    document.getElementById('search_input').style.display = '';
                    const errorContainer = document.getElementById('error-container');
                    errorContainer.innerHTML = ''; // Clear previous errors
                    $('#u_major_id').val(null).trigger('change');
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    const errorContainer = document.getElementById('error-container');
                    errorContainer.innerHTML = ''; // Clear previous errors

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;

                        Object.values(errors).forEach(errorMessage => {
                            const errorDiv = document.createElement('div');
                            errorDiv.style = 'color: red';
                            errorDiv.textContent = '• ' + errorMessage;
                            errorContainer.appendChild(errorDiv);
                        });
                    } else {
                        const errorDiv = document.createElement('div');
                        errorDiv.textContent = 'Error: ' + error;
                        errorContainer.appendChild(errorDiv);
                    }
                }
            });
        });
        function user_search(data)
        {
            u_role_id = document.getElementById('u_role_id').value;
            $.ajax({
                url: "{{route('admin.users.search')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'data':{
                        'data': data,
                        'u_role_id':u_role_id
                    }
                },
                success: function(response) {
                    $('#user-table').html(response.html);
                },
                error: function() {

                }
            });
        }
        function check_email_not_duplicate()
        {
            let email = document.getElementById('email').value;
            $.ajax({
                url: "{{route('users.add.check_email_not_duplicate')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'email': email
                },
                success: function(response) {
                    let btn = document.getElementById('button_add_user_in_modal');
                    if(response.status === 'true') {
                        btn.setAttribute('disabled', true);
                        document.getElementById('email_duplicate_message').style.display = '';
                    }
                    else {
                        btn.removeAttribute('disabled');
                        document.getElementById('email_duplicate_message').style.display = 'none';
                    }
                },
                error: function(xhr, status, error) {

                }
            });
        }
    </script>
@endsection
