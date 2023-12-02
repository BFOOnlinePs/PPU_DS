@foreach($student_attendances as $student_attendance)
    <tr>
        <td>{{strftime('%A', strtotime($student_attendance->sa_in_time))}}</td>
        <td>{{date("Y-m-d", strtotime($student_attendance->sa_in_time))}}</td>
        <td>{{$student_attendance->sa_in_time}}</td>
        @if (!isset($student_attendance->sa_out_time))
            <td>لم يسجل مغادرة</td>
        @else
            <td>{{$student_attendance->sa_out_time}}</td>
        @endif
    </tr>
@endforeach
