<table class="table table table-sm table-bordered">
    <thead>
    <tr>
        <th>الرقم المرجعي</th>
        <th>اسم الطالب</th>
        <th>ملاحظات</th>
        <th>تمت الاضافة بواسطة</th>
        <th>قيمة المبلغ المدفوع</th>
        <th>العملة</th>
    </tr>
    </thead>
    <tbody>
    @if($data->isEmpty())
        <tr>
            <td colspan="5" class="text-center">لا توجد بيانات</td>
        </tr>
    @else
        @foreach($data as $key)
            <tr>
                <td>{{ $key->p_reference_id }}</td>
                <td>{{ $key->student->name }}</td>
                <td>{{ $key->p_student_notes }}</td>
                <td>{{ $key->inserted_by->name }}</td>
                <td class="text-center">{{ $key->p_payment_value }}</td>
                <td>{{ $key->currency->c_name }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
