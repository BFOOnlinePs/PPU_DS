<table class="table table-bordered table-hover" id="user-table">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>الرقم الجامعي</th>
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
                <td>{{$key->u_full_name}}</td>
                <td>{{$key->u_username}}</td>
                <td>{{$key->email}}</td>
                <td>{{$key->u_phone1}}</td>
                <td>{{$key->u_phone2}}</td>
                <td>{{$key->u_address}}</td>
                <td>{{$key->u_date_of_birth}}</td>
                <td>{{$key->u_gender}}</td>
                <td>{{$key->u_major_id}}</td>
                <td>{{$key->u_role_id}}</td>
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
</table>
