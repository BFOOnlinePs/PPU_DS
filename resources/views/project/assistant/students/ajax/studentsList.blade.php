<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
            <th>{{__('translate.Username')}} {{-- اسم المستخدم --}}</th>
            <th>{{__('translate.Majors')}} {{-- التخصص --}}</th>
            <th>{{__('translate.View details')}} {{-- عرض تفاصيل --}}</th>
        </tr>
    </thead>
    <tbody>
        @if ($students->isEmpty())
            <tr>
                <td colspan="4" class="text-center"><span>{{__('translate.No users to display')}}{{-- لا يوجد مستخدمين لعرضهم --}}</span></td>
            </tr>
        @else
                @foreach($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->u_username}}</td>
                    <td>{{$student->major->m_name}}</td>
                    <td><a href="{{route('admin.users.details' , ['id'=>$student->u_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>        </tr>
                @endforeach
        @endif
    </tbody>
</table>

