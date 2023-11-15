@if ($students_company->isEmpty())
    <h6 class="alert alert-danger">لا يوجد طلاب لعرضهم</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>عرض معلومات عن الطالب</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students_company as $student)
            <tr>
                <td>{{$student->users->name}}</td>
                <td><a href="{{route('admin.users.details' , ['id'=>$student->sc_student_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

