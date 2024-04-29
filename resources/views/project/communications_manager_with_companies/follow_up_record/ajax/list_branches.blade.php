<table class="table table table-sm table-bordered">
    <thead>
        <tr>
            <th>عنوان فرع الشركة</th>
            <th>رقم الهاتف</th>
            <th>رقم مدير الفرع</th>
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
                    <td>{{ $key->company->c_name }}</td>
                    <td>{{ $key->b_phone1 }}</td>
                    <td>{{ $key->user->name }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
