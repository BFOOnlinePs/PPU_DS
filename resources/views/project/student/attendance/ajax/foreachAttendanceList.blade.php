@foreach($student_attendances as $student_attendance)
    <tr>
        @php
            function arabicDay($englishDay) {
                $englishDays = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                $arabicDays = ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
                return str_replace($englishDays, $arabicDays, $englishDay);
            }
        @endphp
        <td>{{arabicDay(strftime('%A', strtotime($student_attendance->sa_in_time)))}}</td>
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
