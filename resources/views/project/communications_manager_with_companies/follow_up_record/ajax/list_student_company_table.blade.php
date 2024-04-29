<table class="table table table-sm table-bordered">
    <thead>
    <tr>
        <th>اسم الطالب</th>
        <th>رقم فرع الشبكة</th>
        <th>ملف المتابعة</th>
    </tr>
    </thead>
    <tbody>
    @if($data->isEmpty())
        <tr>
            <td colspan="3" class="text-center">لا توجد بيانات</td>
        </tr>
    @else
        @foreach($data as $key)
            <tr>
                <td>{{ $key->student->name }}</td>
                <td>{{ $key->company_branches->b_address }}</td>
                <td>
                    <a target="_blank" href="{{ route('admin.users.students.attendance',['id'=> $key->student->u_id ]) }}" class="btn btn-primary btn-sm"><span class="fa fa-file"></span></a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
