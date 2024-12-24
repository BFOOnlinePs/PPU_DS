<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>نص السؤال</th>
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
                    <td>{{ $key->faq_question }}</td>
                    <td>
                        <a href="{{ route('admin.faq.edit', ['id' => $key->faq_id]) }}" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
