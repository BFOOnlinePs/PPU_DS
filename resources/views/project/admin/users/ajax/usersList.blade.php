@if ($data->isEmpty())
    <h1 class="alert alert-danger">لا يوجد مستخدمين لعرضهم</h1>
@else
<<<<<<< HEAD
    <thead>
        <tr>
            <th>الاسم الكامل</th>
            <th>اسم المستخدم</th>
            <th>رقم الجوال</th>
            <th>حالة الحساب</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key)
            <tr id="user-row-{{ $key->id }}">
                <td>{{$key->name}}</td>
                <td>{{$key->u_username}}</td>
                <td>{{$key->phone1}}</td>
                @if ($key->u_status == 0)
                    <td class="bg-danger text-white" id="td-{{$key->id}}">
                            غير مفعل
                    </td>
                @else
                    <td class="bg-success text-white" id="td-{{$key->id}}">
                        مفعل
                    </td>
                @endif
                <td>
                    <button class="btn btn-primary edit-user" data-toggle="modal" data-target="#edit-user-modal" data-userid="{{$key->id}}">تعديل الحساب</button>
                    @if ($key->status == 1)
                        <button class="btn btn-danger" onclick="clickToChangeStatusButton({{$key->id}})" id="btn-{{$key->id}}">تعطيل الحساب</button>
                    @else
                            <button class="btn btn-success" onclick="clickToChangeStatusButton({{$key->id}})" id="btn-{{$key->id}}">تفعيل الحساب</button>
                    @endif
                    <button class="btn btn-primary edit-password-user" data-toggle="modal" data-target="#reset-password-user-modal" data-userid="{{$key->id}}">تغيير كلمة المرور</button>
                </td>
            </tr>
        @endforeach
    </tbody>
=======
<thead>
    <tr>
        <th>الاسم الكامل</th>
        <th>اسم المستخدم</th>
        <th>رقم الجوال</th>
        <th>حالة الحساب</th>
        <th>العمليات</th>
    </tr>
</thead>
<tbody>
    @foreach($data as $key)
        <tr id="user-row-{{ $key->id }}">
            <td>{{$key->name}}</td>
            <td>{{$key->u_username}}</td>
            <td>{{$key->phone1}}</td>
            @if ($key->u_status == 0)
                <td class="bg-danger text-white" id="td-{{$key->id}}">
                        غير مفعل
                </td>
            @else
                <td class="bg-success text-white" id="td-{{$key->id}}">
                    مفعل
                </td>
            @endif
            <td>
                <button class="btn btn-primary" onclick="edit_user({{ $key->u_id }})"><span class="fa fa-edit"></span></button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#edit-user-modal" data-userid="{{$key->id}}"><span class="fa fa-search"></span></button>
            </td>
        </tr>
    @endforeach
</tbody>
>>>>>>> 8eed44ad1dbcc0537ec54d010ec699c510f864bb
@endif

