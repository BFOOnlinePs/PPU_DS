<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('translate.Day')}}{{-- اليوم --}}</th>
            <th>{{__('translate.Date')}}{{-- التاريخ --}}</th>
            <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
            <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
            <th>{{__('translate.The company')}}{{-- الشركة --}}</th>
            <th>{{__('translate.View supervisor notes')}}{{-- عرض ملاحظات المشرف --}}</th>
            <th>{{__('translate.Report submission')}}{{-- تسليم التقرير --}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($student_attendances as $student_attendance)
        <tr>
            <td>{{strftime('%A', strtotime($student_attendance->sa_in_time))}}</td>
            <td>{{date("Y-m-d", strtotime($student_attendance->sa_in_time))}}</td>
            <td>{{$student_attendance->sa_in_time}}</td>
            @if (!isset($student_attendance->sa_out_time))
                <td>{{__('translate.Did not record departure')}} {{-- لم يسجل مغادرة --}}</td>
            @else
                <td>{{$student_attendance->sa_out_time}}</td>
            @endif
            <td>{{$student_attendance->training->company->c_name}}</td>
            <td></td>
            <td>
                @if ($date_today == date("Y-m-d", strtotime($student_attendance->sa_in_time)))
                    <a href="{{route('students.attendance.report.edit' , ['sa_id' => $student_attendance->sa_id])}}" class="fa fa-edit" style="font-size: x-large;" data-bs-original-title="" title=""><span></span></a>
                @else
                    <a href="{{route('students.attendance.report.edit' , ['sa_id' => $student_attendance->sa_id])}}" class="fa fa-edit" style="font-size: x-large; pointer-events: none; opacity: 0.6;" data-bs-original-title="" title=""><span></span></a>
                    <span class="text-danger">انتهى وقت التسليم</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


