<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>اسم التدريب</th>
            <th>اسم المشرف</th>
            <th>اسم الشركة</th>
            <th>التاريخ</th>
            <th>تقييم المشرف</th>
            <th>تقييم الشركة</th>
            <th>العلامة النهائية</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="8" class="text-center">
                    <span>{{ __('translate.No available data') }}</span>
                </td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td>{{ $key->users->name ?? 'غير محدد' }}</td>
                    <td>{{ $key->courses->c_name ?? 'غير محدد' }}</td>
                    <td>{{ $key->supervisor->name ?? 'غير محدد' }}</td>
                    <td>{{ $key->studentCompany->company->c_name ?? 'غير محددة' }}</td>
                    <td>{{ $key->created_at ?? '-' }}</td>
                    <td>{{ $key->university_score ?? '-' }}</td>
                    <td>{{ $key->company_score ?? '-' }}</td>
                    <td class="d-flex justify-content-center align-content-center">
                        <span class="w-100">
                            {{ ($key->total_score ?? ($key->university_score ?? 0) + ($key->company_score ?? 0)) }} /
                        </span>
                        <input type="text" onchange="edit_total_score({{ $key->r_id }} , this.value)"
                            class="form-control"
                            value="{{ $key->total_score ?? ($key->university_score ?? 0) + ($key->company_score ?? 0) }}"
                            max="100" min="0">
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
