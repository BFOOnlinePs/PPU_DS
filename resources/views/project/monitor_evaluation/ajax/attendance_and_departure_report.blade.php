<table class="table table-bordered">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>رقم التدريب</th>
            <th>وقت الحضور</th>
            <th>وقت المغادرة</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <th colspan="4" class="text-center">لا توجد نتائج</th>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->user->name }}</td>
                    <td>{{ $key->company->c_name }}</td>
                    <td>{{ $key->sa_in_time }}</td>
                    <td>{{ $key->sa_out_time }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>