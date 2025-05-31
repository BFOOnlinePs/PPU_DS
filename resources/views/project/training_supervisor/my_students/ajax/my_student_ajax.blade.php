<table class="table table-sm table-hover">
    <thead>
    <tr>
        <th>اسم الطالب</th>
        {{-- <th>الشركة</th> --}}
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key)
        <tr>
            <td>{{ optional($key->users)->name ?? 'غير متوفر' }}</td>
            {{-- <td>{{ optional($key->company)->c_name ?? 'غير متوفر' }}</td> --}}
            <td>
                @if(optional($key->users)->u_id)
                    <a href="{{ route('admin.users.details',['id'=> $key->users->u_id]) }}" class="btn btn-xs btn-primary">
                        <span class="fa fa-search"></span>
                    </a>
                @else
                    <span class="text-muted">لا يوجد بيانات</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
