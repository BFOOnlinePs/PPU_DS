<table class="table table-sm table-hover">
    <thead>
    <tr>
        <th>اسم الطالب</th>
        {{-- <th>الشركة</th> --}}
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $key)
        <tr>
            <td>{{ $key->student_name ?? 'غير متوفر' }}</td>
            {{-- <td>{{ $key->company_name ?? 'غير متوفر' }}</td> --}}
            <td>
                @if(!empty($key->r_student_id))
                    <a href="{{ route('admin.users.details', ['id' => $key->r_student_id]) }}" class="btn btn-xs btn-primary">
                        <span class="fa fa-search"></span>
                    </a>
                @else
                    <span class="text-muted">لا يوجد بيانات</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="2" class="text-center text-muted">لا يوجد طلاب</td>
        </tr>
    @endforelse
    </tbody>
</table>
