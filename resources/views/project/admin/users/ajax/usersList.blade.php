<table class="table table-bordered table-striped" id="users_table">
    <thead>
        <tr>
            <th>{{__('translate.Full Name')}} {{-- الاسم الكامل --}} </th>
            <th>{{__('translate.Username')}} {{-- اسم المستخدم --}}</th>
            <th>{{__('translate.Phone Number')}} {{-- رقم الجوال --}}</th>
            <th>{{__('translate.Account Status')}} {{-- حالة الحساب --}}</th>
            <th>{{__('translate.View Details')}} {{-- عرض تفاصيل --}}</th>
        </tr>
    </thead>
    <tbody>
@if ($data->isEmpty())
    <tr>
        <td colspan="5" class="text-center"><span>{{__('translate.No Users to Display')}}{{-- لا يوجد مستخدمين لعرضهم --}}</span></td>
    </tr>
@else
    @foreach($data as $key)
        <tr id="user-row-{{ $key->id }}">
            <td>{{$key->name}}</td>
            <td>{{$key->u_username}}</td>
            <td>{{$key->u_phone1}}</td>
            @if ($key->u_status == 0)
            <td class="text-danger" id="td-{{$key->id}}">{{__('translate.Deactivated')}} {{-- غير مفعل --}}</td>
            @else
            <td class="text-success" id="td-{{$key->id}}">{{__('translate.Active')}} {{-- مفعل --}}</td>
            @endif
            <td><a href="{{route('admin.users.details' , ['id'=>$key->u_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>
        </tr>
    @endforeach
@endif
    </tbody>
</table>

