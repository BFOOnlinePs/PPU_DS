<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>اسم التدريب</th>
            <th>اسم المشرف</th>
            <th>تقييم المشرف</th>
            <th>اسم الشركة</th>
            <th>تقييم الشركة</th>
            <th>التاريخ</th>
            <th>العلامة النهائية</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="10" class="text-center"><span>{{ __('translate.No available data') }}
                        {{-- لا توجد بيانات  --}}</span></td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    @if ($data->isEmpty())
                <tr>
                    <td colspan="8" class="text-center">لا يوجد بيانات</td>
                </tr>
            @else
                <tr>
                    <td>{{ $key->users->name }}</td>
                    <td>{{ $key->courses->c_name }}</td>
                    <td>{{ $key->supervisor->name }}</td>
                    <td>{{ $key->university_score }}</td>
                    <td>{{ $key->studentCompany->company->c_name }}</td>
                    <td>{{ $key->company_score }}</td>
                    <td>{{ $key->created_at }}</td>
                    <td>100 / {{ $key->university_score + $key->company_score }}</td>
                </tr>
            @endif
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
