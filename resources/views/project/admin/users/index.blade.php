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
@section('navbar')
<div class="row">
    @if (isset($u_role_id))
        <h1 class="text-center" id="r_name">{{$role_name}}</h1>
    @else
        <h1 class="text-center" id="r_name">كل المستخدمين</h1>
    @endif
    <div class="col-md-12 p-2 text-center">
        @foreach ($roles as $role)
            <a class="btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}">{{$role->r_name}}</a>
        @endforeach
    </div>
</div>
@endsection
@section('content')
<div class="col-sm-12" id="main">
    @if (isset($u_role_id))
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user"><span class="fa fa-plus"></span> إضافة {{$role_name}}</button>
    @else
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" style="display: none"><span class="fa fa-plus"></span></button>
    @endif
    <div class="card">
        <div class="card-body">
            <input class="form-control " onkeyup="user_search(this.value)" type="search" placeholder="ابحث هنا...">
            <table class="table table-bordered table-hover" id="user-table">
                @include('project.admin.users.ajax.usersList')
            </table>
        </div>
    </div>
    @include('project.admin.users.modals.add')
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       let AddUserForm = document.getElementById("addUserForm");
        AddUserForm.addEventListener("submit", (e) => {
            e.preventDefault();
            data = $('#addUserForm').serialize();
            $.ajax({
                url: "{{route('admin.users.create')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: data,
                success: function(response) {
                    $('#AddUserModal').modal('hide');
                    $('#user-table').html(response.html);
                },
                error: function() {
                    alert('Error fetching user data.');
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
                    alert('Error fetching user data.');
                }
            });
        }
    </script>
@endsection
