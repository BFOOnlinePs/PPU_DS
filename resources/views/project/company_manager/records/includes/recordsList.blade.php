<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
            <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
            <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
            <th>{{__('translate.View report')}} {{-- عرض التقرير --}}</th>
        </tr>
    </thead>
    <tbody>
        @if ($records->isEmpty())
        <tr>
            <td colspan="4" class="text-center"><span>لا توجد بيانات</span></td>
        </tr>
        @else
            @foreach($records as $record)
                <tr>
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
        @endif
    </tbody>
</table>

