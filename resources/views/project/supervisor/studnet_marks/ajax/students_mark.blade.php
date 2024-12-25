<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>الاسم</th>
            <th>اسم الشركة</th>
            <th>المشرف الاكاديمي</th>
            <th>علامة الشركة</th>
            <th>علامة المشرف الاكاديمي</th>
            <th>العلامة النهائية</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="6" class="text-center">لا توجد نتائج</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->company }}</td>
                    <td>{{ $key->training_supervisor }}</td>
                    <td>{{ $key->company_marks }}</td>
                    <td>{{ $key->training_supervisor_marks }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
