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
            @foreach ($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->company }}</td>
                    <td>
                            {{-- {{ $key->training_supervisor }} --}}
                            {{-- {{ App\Models\Registration::where('r_student_id', $key->u_id)->where('r_year', App\Models\SystemSetting::first()->ss_year)->first()->supervisor->name ?? 'لا يوجد مشرف' }} --}}
                            {{-- {{ $key->training_supervisor }} --}}
                            @if(empty(App\Models\User::where(
                                'u_id',
                                optional(
                                    App\Models\Registration::where('r_student_id', $key->u_id)->where('r_year', App\Models\SystemSetting::first()->ss_year)->first(),
                                )->supervisor_id,
                            )->first()->name))
                                <span class="badge badge-danger">لا يوجد مشرف</span>

                            @else
                                <span class="badge badge-primary">{{ App\Models\User::where(
                                'u_id',
                                optional(
                                    App\Models\Registration::where('r_student_id', $key->u_id)->where('r_year', App\Models\SystemSetting::first()->ss_year)->first(),
                                )->supervisor_id,
                            )->first()->name }}</span>
                            @endif
                        {{-- {{ $key->training_supervisor }} --}}
                    </td>
                    <td>{{ $key->company_marks }}</td>
                    <td>{{ $key->training_supervisor_marks }}</td>
                    <td>
                        {{ $key->company_marks + $key->training_supervisor_marks }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
