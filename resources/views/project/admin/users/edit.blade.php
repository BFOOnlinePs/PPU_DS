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
            </div>
        @endif
        <div class="col-md-4">
            <div class="form-group">
                <label>الجنس:</label>
                <div class="custom-control custom-radio">
                    @if ($user->u_gender == 0)
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="0" checked>
                    @else
                        <input type="radio" id="male" name="gender" class="custom-control-input" value="0">
                    @endif
                    <label class="custom-control-label" for="male">ذكر</label>
                </div>
                <div class="custom-control custom-radio">
                    @if ($user->u_gender == 1)
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="1" checked>
                    @else
                        <input type="radio" id="female" name="gender" class="custom-control-input" value="1">
                    @endif
                    <label class="custom-control-label" for="female">أنثى</label>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    <button class="btn btn-primary btn-sm" type="submit" id="serialize-button">حفظ التعديلات</button>
=======
    <button class="btn btn-primary" type="submit" onclick="update_user()">حفظ التعديلات</button>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
</form>

