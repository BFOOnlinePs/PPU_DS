
<table class="table table-bordered table-hover" id="user-table">
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
                    <button class="btn btn-primary" onclick="edit_user({{ $key->u_id }})" title="تعديل معلومات المستخدم"><span class="fa fa-edit"></span></button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#edit-user-modal" data-userid="{{$key->id}}"><span class="fa fa-search"></span></button>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
