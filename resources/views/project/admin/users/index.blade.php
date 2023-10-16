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
<<<<<<< HEAD
    @if (isset($u_role_id))
        <h1 class="text-center" id="r_name">{{$role_name}}</h1>
    @else
        <h1 class="text-center" id="r_name">كل المستخدمين</h1>
    @endif
=======
<<<<<<< HEAD
    <h1 class="text-center">مسؤول النظام</h1>
=======
    <input type="hidden" id='u_role_id'>
    <h1 class="text-center" id="r_name">كل المستخدمين</h1>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
    <div class="col-md-12 p-2 text-center">
        @foreach ($roles as $role)
            <a class="btn btn-primary btn-sm" href="{{route('admin.users.index_id' , ['id'=>$role->r_id])}}">{{$role->r_name}}</a>
        @endforeach
    </div>
</div>
@endsection
@section('content')
<<<<<<< HEAD
<div class="col-sm-12" id="main">
    @if (isset($u_role_id))
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user"><span class="fa fa-plus"></span> إضافة {{$role_name}}</button>
    @else
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddUserModal').modal('show')" type="button" id="button_add_user" style="display: none"><span class="fa fa-plus"></span></button>
    @endif
=======
<div class="col-sm-12">
<<<<<<< HEAD
    <button  class="add_user_class btn btn-success btn-sm" data-toggle="modal" data-target="#add-user-modal">
        إضافة مستخدم
    </button>
=======
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <div class="form-group mb-0 col-md-7">
            <input class="form-control " onkeyup="user_search(this.value)" type="search" placeholder="ابحث هنا...">
        </div>
        <button class="btn btn-light btn-sm" type="button" id="button_add_user" style="display: none"></button>

        {{-- <button class="btn btn-light btn-sm" onclick="$('#AddCourseModal').modal('show')" type="button" data-bs-original-title="" title=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </button> --}}
    </div>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
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
<<<<<<< HEAD
@section('javascript')
    <script>
        $(document).ready(function() {
        // Add a click event listener to the button
            $('#serialize-button').click(function() {
                e.preventDefault();
                alert("Hello");
                //let data = $('#edit-form').serialize();
                //console.log(data);
            })});
        function update_user()
        {
            alert('Update user');
            let data = $('#edit-form').serialize();

            // $.ajax({
            //     url: "{{route('update.user')}}",
            //     method: 'post',
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //     },
            //     data: {
            //         'id':id
            //     },
            //     success: function(response) {
            //         $('#user-table').html(response.html);
            //         console.log(response.user);
            //     },
            //     error: function() {
            //         alert('Error fetching user data.');
            //     }
            // });

=======
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
<<<<<<< HEAD
=======
        function update_user()
        {
            u_id = document.getElementById('edit_form_u_id').value;
            u_username = document.getElementById('edit_form_u_username').value;
            name = document.getElementById('edit_form_name').value;
            email = document.getElementById('edit_form_email').value;
            u_phone1 = document.getElementById('edit_form_u_phone1').value;
            u_phone2 = document.getElementById('edit_form_u_phone2').value;
            u_address = document.getElementById('edit_form_u_address').value;
            u_date_of_birth = document.getElementById('edit_form_u_date_of_birth').value;
            male = document.getElementById('male').checked;
            female = document.getElementById('female').checked;
            u_gender = null;
            if(male == true) {
                    u_gender = 0;
            }
            else {
                u_gender = 1;
            }
            // u_major_id
            data = {
                'u_id' : u_id,
                'u_username' : u_username,
                'name' : name,
                'email' : email,
                'u_phone1' : u_phone1,
                'u_phone2' : u_phone2,
                'u_address' : u_address,
                'u_date_of_birth' : u_date_of_birth,
                'u_gender' : u_gender
            }
            $.ajax({
                url: "{{route('admin.users.update')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'data':data
                },
                success: function(response) {
                    //$('#user-table').html(response.html);
                    $('#user-table').html(response.html);
                    console.log(response.html);
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        }
        function edit_user(id)
        {
            $.ajax({
<<<<<<< HEAD
                url: "{{route('edit.user')}}",
=======
                url: "{{route('admin.users.edit')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id':id
                },
                success: function(response) {
                    $('#user-table').html(response.html);
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
        function index_user(id)
        {
            $.ajax({
<<<<<<< HEAD
                url: "{{route('index.user')}}",
=======
                url: "{{route('admin.users.index_user')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
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
<<<<<<< HEAD
=======
                    document.getElementById('r_name').innerHTML = response.r_name;
                    document.getElementById('button_add_user').style.display = 'block';
                    document.getElementById('button_add_user').innerHTML = "إضافة " + response.r_name;
                    console.log(response.r_name);
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
                },
                error: function (error) {
                   alert("ERROR!! " + error.responseText);
                }
            });
        }
        // $(document).ready(function() {
        //     $(document).on('click', '.add_user_class', function() {
        //         $('#user_password_modal').val(rand(1111111, 9999999));
        //     })});
        // function rand(min, max) {
        //     return Math.floor(Math.random() * (max - min + 1)) + min;
        // }
        // function reset_password()
        // {
        //     let data = $('#reset-password-user-form').serialize();
        //     $.ajax({
<<<<<<< HEAD
        //         url: "{{route('reset.password')}}",
=======
        //         url: "{{route('admin.users.reset.password')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //         method: "post",
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         data: data,
        //         success: function (response) {
        //             let modal = document.getElementById("reset-password-user-modal");
        //             modal.classList.remove("show");
        //             let modalBackdrop = document.querySelector(".modal-backdrop");

        //             // Check if the modal backdrop exists
        //             if (modalBackdrop) {
        //             // Remove the modal backdrop element
        //                 modalBackdrop.remove();
        //             }
        //         },
        //         error: function (error) {
        //            alert("ERROR!! " + error.responseText);
        //         }
        //     });
        // }
        // $(document).ready(function() {
        //     $(document).on('click', '.edit-password-user', function() {
        //         let user_id = $(this).data('userid');
        //         $.ajax({
<<<<<<< HEAD
        //             url: "{{route('id.reset.password')}}",
=======
        //             url: "{{route('admin.users.id.reset.password')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //             method: 'post',
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             data: {
        //                 'id':user_id
        //             },
        //             success: function(response) {
        //                 $('#id_reset_password').val(response.id);
        //             },
        //             error: function() {
        //                 alert('Error fetching user data.');
        //             }
        //         });

        // })});
        // $(document).ready(function() {
        //     $(document).on('click', '.edit-user', function() {
        //         let user_id = $(this).data('userid');
        //         $.ajax({
<<<<<<< HEAD
        //             url: "{{route('edit.user')}}",
=======
        //             url: "{{route('admin.users.edit')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //             method: 'post',
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             data: {
        //                 'id':user_id
        //             },
        //             success: function(response) {
        //                 $('#user_name_modal_edit').val(response.user.name);
        //                 $('#user_email_modal_edit').val(response.user.email);
        //                 $('#user_phone1_modal_edit').val(response.user.phone1);
        //                 $('#user_phone2_modal_edit').val(response.user.phone2);
        //                 $('#user_date_of_birth_modal_edit').val(response.user.date_of_birth);
        //                 $('#user_role_id_modal_edit').val(response.user.role_id);
        //                 $('#user_major_id_modal_edit').val(response.user.major_id);
        //                 if(response.user.gender == '0') {
        //                     $('#male_edit').prop('checked', true);
        //                 }
        //                 else {
        //                     $('#female_edit').prop('checked', true);
        //                 }
        //                 $('#user_address_modal_edit').val(response.user.address);
        //                 $('#user_id_modal_edit').val(response.user.id);

        //             },
        //             error: function() {
        //                 alert('Error fetching user data.');
        //             }
        //         });
        //     });
        //   });
        // let AddUserForm = document.getElementById("add-user-form");
        // AddUserForm.addEventListener("submit", (e) => {
        //     e.preventDefault();
        //     let data = $('#add-user-form').serialize();
        //     $.ajax({
<<<<<<< HEAD
        //         url: "{{route('add.user')}}",
=======
        //         url: "{{route('admin.users.add')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //         method: "post",
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         data: data,
        //         success: function (response) {
        //             $('#user-table').html(response.html);
        //             let modal = document.getElementById("add-user-modal");
        //             modal.classList.remove("show");
        //             let modalBackdrop = document.querySelector(".modal-backdrop");

        //             // Check if the modal backdrop exists
        //             if (modalBackdrop) {
        //             // Remove the modal backdrop element
        //                 modalBackdrop.remove();
        //             }
        //         },
        //         error: function (error) {
        //            alert("ERROR!! " + error.responseText);
        //         }
        //     });
        // });
        // function update_user()
        // {
        //     let data = $('#edit-user-form').serialize();
        //     $.ajax({
<<<<<<< HEAD
        //         url: "{{route('update.user')}}",
=======
        //         url: "{{route('admin.users.update')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //         method: "post",
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         data: data,
        //         success: function (response) {
        //             $('#user-table').html(response.html);
        //             let modal = document.getElementById("edit-user-modal");
        //             modal.classList.remove("show");
        //             let modalBackdrop = document.querySelector(".modal-backdrop");

        //             // Check if the modal backdrop exists
        //             if (modalBackdrop) {
        //             // Remove the modal backdrop element
        //                 modalBackdrop.remove();
        //             }
        //         },
        //         error: function (error) {
        //            alert("ERROR!! " + error.responseText);
        //         }
        //     });
        // }
        // function clickToChangeStatusButton(id)
        // {
        //     $.ajax({
<<<<<<< HEAD
        //         url: "{{route('change.status.account')}}",
=======
        //         url: "{{route('admin.users.change.status.account')}}",
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
        //         method: "post",
        //         headers: {
        //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //         },
        //         data: {
        //             'id': id,
        //         },
        //         success: function (response) {
        //             let td = document.getElementById('td-' + id);
        //             let button = document.getElementById('btn-' + id);
        //             if(response.status === true) {
        //                 td.classList.remove(...td.classList);
        //                 td.classList.add('bg-success','text-white');
        //                 td.textContent = 'مفعل';
        //                 button.classList.remove(...button.classList);
        //                 button.classList.add('btn','btn-danger');
        //                 button.textContent = 'تعطيل الحساب';
        //             }
        //             else {
        //                 td.classList.remove(...td.classList);
        //                 td.classList.add('bg-danger','text-white');
        //                 td.textContent = 'غير مفعل';
        //                 button.classList.remove(...button.classList);
        //                 button.classList.add('btn','btn-success');
        //                 button.textContent = 'تفعيل الحساب';
        //             }
        //         },
        //         error: function (error) {
        //             alert(error.responseText);
        //         }
        //     });
        // }
>>>>>>> 8cc0a8096f6e7114cccf7fe8ae86e8d00f83e477
    </script>
@endsection
