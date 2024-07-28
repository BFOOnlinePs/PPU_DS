<table class="table table-bordered table-striped" id="users_table">
    <thead>
        <tr>
            <th>{{ __('translate.Student Name') }}</th>
            <th>{{ __('translate.Phone Number') }}</th>
            <th>{{ __('translate.tawjihi_rate') }}</th>
            <th>{{ __('translate.Major') }}</th>
            <th>نوع المستخدم</th>
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
            <td>{{$key->u_phone1}}</td>
            <td>{{$key->u_tawjihi_gpa}}</td>
            <td>{{$key->major->m_name ?? 0}}</td>
            <td>
                @if($key->u_role_id == 1)
                    ادمن
                @elseif($key->u_role_id == 2)
                    طالب
                @elseif($key->u_role_id == 3)
                    مشرف اكاديمي
                @elseif($key->u_role_id == 4)
                    مساعد إداري
                @elseif($key->u_role_id == 5)
                    مسؤول متابعة وتقييم
                @elseif($key->u_role_id == 6)
                    مدير شركة
                @elseif($key->u_role_id == 7)
                    مسؤول تدريب
                @elseif($key->u_role_id == 8)
                    مسؤول التواصل مع الشركات
                @elseif($key->u_role_id == 9)
                    مسؤول المتابعة
                @endif
            </td>
{{--            @if ($key->u_status == 0)--}}
{{--            <td class="text-danger" id="td-{{$key->id}}">{{__('translate.Deactivated')}} --}}{{-- غير مفعل --}}{{--</td>--}}
{{--            <td class="text-success" id="td-{{$key->id}}">{{__('translate.Active')}} --}}{{-- مفعل --}}{{--</td>--}}
{{--            @endif--}}
            <td><a href="{{route('admin.users.details' , ['id'=>$key->u_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>
        </tr>
    @endforeach
@endif
    </tbody>
</table>

