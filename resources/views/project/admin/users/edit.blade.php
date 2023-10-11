<form id="edit-form">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="hidden" class="form-control" name="u_id" value="{{$user->u_id}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_username">اسم المستخدم</label>
                <input type="text" class="form-control" name="u_username" value="{{$user->u_username}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_phone1">رقم الجوال</label>
                <input type="text" class="form-control" name="u_phone1" value="{{$user->u_phone1}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_phone2">رقم جوال احتياطي</label>
                <input type="text" class="form-control" name="u_phone2" value="{{$user->u_phone2}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_address">عنوان السكن</label>
                <input type="text" class="form-control" name="u_address" value="{{$user->u_address}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="u_date_of_birth">تاريخ الميلاد</label>
                <input type="date" class="form-control" name="u_date_of_birth" value="{{$user->u_date_of_birth}}">
            </div>
        </div>
        @if ($user->u_role_id == 2)
            <div class="col-md-4">
                <div class="form-group">
                    <label for="u_major_id">التخصص</label>
                    <input type="text" class="form-control" name="u_major_id" value="{{$user->u_major_id}}">
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
    <button class="btn btn-primary btn-sm" type="submit" id="serialize-button">حفظ التعديلات</button>
</form>

