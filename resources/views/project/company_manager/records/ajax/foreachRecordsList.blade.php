@foreach($records as $record)
    <tr>
        <td>{{$record->training->users->name}}</td>
        <td>{{$record->sa_in_time}}</td>
        @if (!isset($record->sa_out_time))
            <td>لم يُسجل الطالب مغادرة</td>
        @else
            <td>{{$record->sa_out_time}}</td>
        @endif
        @if (isset($record->report->sr_id))
            <td>
                <button class="btn btn-primary" onclick="openReportModal('{{$record->report->sr_id}}')"><i class="fa fa-file-text"></i></button>
            </td>
        @else
            <td>لم يُسلم تقرير</td>
        @endif
    </tr>
@endforeach
