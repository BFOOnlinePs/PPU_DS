@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مستخدمين لعرضهم</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>الاسم الكامل</th>
            <th>اسم المستخدم</th>
            <th>رقم الجوال</th>
            <th>حالة الحساب</th>
            <th>عرض التفاصيل</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key)
        <tr id="user-row-{{ $key->id }}">
            <td>{{$key->name}}</td>
            <td>{{$key->u_username}}</td>
            <td>{{$key->u_phone1}}</td>
            @if ($key->u_status == 0)
            <td class="text-danger" id="td-{{$key->id}}">غير مفعل</td>
            @else
            <td class="text-success" id="td-{{$key->id}}">مفعل</td>
            @endif
            <td><a href="{{route('admin.users.details' , ['id'=>$key->u_id])}}" title="عرض تفاصيل" class="fa fa-edit btn btn-primary"></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

