@if ($students->isEmpty())
    <h6 class="alert alert-danger">لا يوجد طلاب لعرضهم</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>اسم المستخدم</th>
            <th>التخصص</th>
            <th>عرض التفاصيل</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->u_username}}</td>
            <td>{{$student->major->m_name}}</td>
            <td><a href="{{route('admin.users.details' , ['id'=>$student->u_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>        </tr>
        @endforeach
    </tbody>
</table>
@endif

