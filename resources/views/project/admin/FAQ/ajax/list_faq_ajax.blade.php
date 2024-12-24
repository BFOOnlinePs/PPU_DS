<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>الاسم</th>
            <th class="w-25">العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="2" class="text-center">لا توجد نتائج</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->c_name }}</td>
                    <td>
                        <button onclick="update_faq_category({{ $key }})" class="btn btn-success btn-xs"><span class="fa fa-edit"></span></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
