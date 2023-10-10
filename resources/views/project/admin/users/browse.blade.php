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
    <div class="col-md-12">
        @foreach ($roles as $role)
            <button onclick="admin({{$role->r_id}})">{{$role->r_name}}</button>
        @endforeach
    </div>
    <div class="col-md-6">
    </div>
</div>
@endsection
@section('content')
<div class="col-sm-12">
    <button  class="add_user_class" data-toggle="modal" data-target="#add-user-modal">
        إضافة مستخدم
    </button>
    <div class="card">
        <div class="card-body">
            @include('project.admin.users.table_user')
        </div>
    </div>
    @include('project.admin.users.add')
    @include('project.admin.users.edit')
    @include('project.admin.users.reset_password')
</div>
@endsection
@section('javascript')
    <script>

        function admin(id)
        {
            $.ajax({
                url: "{{route('browse.admin')}}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'json',
                data: {
                    'id' : id
                },
                success: function (response) {
                    $('#user-table').html(response.html);
                },
                error: function (error) {
                   alert("ERROR!! " + error.responseText);
                }
            });
        }
        $(document).ready(function() {
            $(document).on('click', '.add_user_class', function() {
                $('#user_password_modal').val(rand(1111111, 9999999));
            })});
        function rand(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        function reset_password()
        {
            let data = $('#reset-password-user-form').serialize();
            $.ajax({
                url: "{{route('reset.password')}}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'json',
                data: data,
                success: function (response) {
                    let modal = document.getElementById("reset-password-user-modal");
                    modal.classList.remove("show");
                    let modalBackdrop = document.querySelector(".modal-backdrop");

                    // Check if the modal backdrop exists
                    if (modalBackdrop) {
                    // Remove the modal backdrop element
                        modalBackdrop.remove();
                    }
                },
                error: function (error) {
                   alert("ERROR!! " + error.responseText);
                }
            });
        }
        $(document).ready(function() {
            $(document).on('click', '.edit-password-user', function() {
                let user_id = $(this).data('userid');
                $.ajax({
                    url: "{{route('id.reset.password')}}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'id':user_id
                    },
                    success: function(response) {
                        $('#id_reset_password').val(response.id);
                    },
                    error: function() {
                        alert('Error fetching user data.');
                    }
                });

        })});
        $(document).ready(function() {
            $(document).on('click', '.edit-user', function() {
                let user_id = $(this).data('userid');
                $.ajax({
                    url: "{{route('edit.user')}}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        'id':user_id
                    },
                    success: function(response) {
                        $('#user_name_modal_edit').val(response.user.name);
                        $('#user_email_modal_edit').val(response.user.email);
                        $('#user_phone1_modal_edit').val(response.user.phone1);
                        $('#user_phone2_modal_edit').val(response.user.phone2);
                        $('#user_date_of_birth_modal_edit').val(response.user.date_of_birth);
                        $('#user_role_id_modal_edit').val(response.user.role_id);
                        $('#user_major_id_modal_edit').val(response.user.major_id);
                        if(response.user.gender == '0') {
                            $('#male_edit').prop('checked', true);
                        }
                        else {
                            $('#female_edit').prop('checked', true);
                        }
                        $('#user_address_modal_edit').val(response.user.address);
                        $('#user_id_modal_edit').val(response.user.id);

                    },
                    error: function() {
                        alert('Error fetching user data.');
                    }
                });
            });
          });
        let AddUserForm = document.getElementById("add-user-form");
        AddUserForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let data = $('#add-user-form').serialize();
            $.ajax({
                url: "{{route('add.user')}}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#user-table').html(response.html);
                    let modal = document.getElementById("add-user-modal");
                    modal.classList.remove("show");
                    let modalBackdrop = document.querySelector(".modal-backdrop");

                    // Check if the modal backdrop exists
                    if (modalBackdrop) {
                    // Remove the modal backdrop element
                        modalBackdrop.remove();
                    }
                },
                error: function (error) {
                   alert("ERROR!! " + error.responseText);
                }
            });
        });
        function update_user()
        {
            let data = $('#edit-user-form').serialize();
            $.ajax({
                url: "{{route('update.user')}}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'json',
                data: data,
                success: function (response) {
                    $('#user-table').html(response.html);
                    let modal = document.getElementById("edit-user-modal");
                    modal.classList.remove("show");
                    let modalBackdrop = document.querySelector(".modal-backdrop");

                    // Check if the modal backdrop exists
                    if (modalBackdrop) {
                    // Remove the modal backdrop element
                        modalBackdrop.remove();
                    }
                },
                error: function (error) {
                   alert("ERROR!! " + error.responseText);
                }
            });
        }
        function clickToChangeStatusButton(id)
        {
            $.ajax({
                url: "{{route('change.status.account')}}",
                method: "post",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id': id,
                },
                success: function (response) {
                    let td = document.getElementById('td-' + id);
                    let button = document.getElementById('btn-' + id);
                    if(response.status === true) {
                        td.classList.remove(...td.classList);
                        td.classList.add('bg-success','text-white');
                        td.textContent = 'مفعل';
                        button.classList.remove(...button.classList);
                        button.classList.add('btn','btn-danger');
                        button.textContent = 'تعطيل الحساب';
                    }
                    else {
                        td.classList.remove(...td.classList);
                        td.classList.add('bg-danger','text-white');
                        td.textContent = 'غير مفعل';
                        button.classList.remove(...button.classList);
                        button.classList.add('btn','btn-success');
                        button.textContent = 'تفعيل الحساب';
                    }
                },
                error: function (error) {
                    alert(error.responseText);
                }
            });
        }
    </script>
@endsection
