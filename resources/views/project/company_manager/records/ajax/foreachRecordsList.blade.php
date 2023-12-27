@foreach($records as $record)
    <tr>
        <td>{{$record->sa_id}}</td>
        <td>{{$record->training->users->name}}</td>
        <td>{{$record->sa_in_time}}</td>
        @if (!isset($record->sa_out_time))
            <td>{{__('translate.Did not record departure')}}{{-- لم يُسجل مغادرة --}}</td>
        @else
            <td>{{$record->sa_out_time}}</td>
        @endif
        @if (isset($record->report->sr_id))
            <td>
                <button class="btn btn-primary" onclick="openReportModal('{{$record->report->sr_id}}')"><i class="fa fa-file-text"></i></button>
            </td>
        @else
            <td>{{__('translate.The student did not submit the report')}}{{-- لم يُسلم الطالب تقرير --}}</td>
        @endif
    </tr>
@endforeach
