<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>نص السؤال</th>
            <th>اضيف بواسطة</th>
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
                    <td onclick="open_answer_details({{ $key }})">{{ $key->faq_question }}</td>
                    <td>{{ $key->added_by->name }}</td>
                    <td>
                        <a href="{{ route('admin.faq.edit', ['id' => $key->faq_id]) }}" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
