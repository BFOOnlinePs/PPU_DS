@if ($student_attendances->isEmpty())
    <h6 class="alert alert-danger">{{__('translate.There are no records to display')}}{{-- لا يوجد سجلات لعرضها --}}</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
                <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
                <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
                <th>{{__('translate.Details')}} {{-- التفاصيل --}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student_attendances as $student_attendance)
                <tr>
                    <td>{{$student_attendance->training->company->c_name}}</td>
                    <td>{{$student_attendance->sa_in_time}}</td>
                    @if (!isset($student_attendance->sa_out_time))
                        <td>{{__('translate.Did not record departure')}} {{-- لم يسجل مغادرة --}}</td>
                    @else
                        <td>{{$student_attendance->sa_out_time}}</td>
                    @endif
                    <td>
                        <button class="btn btn-primary fa fa-map-marker" onclick="map({{$student_attendance->sa_start_time_latitude}} , {{$student_attendance->sa_start_time_longitude}} , {{$student_attendance->sa_end_time_latitude}} , {{$student_attendance->sa_end_time_longitude}})" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض موقع الطالب عند تسجيل الحضور و المغادرة"></button>
                        @if (!isset($student_attendance->report->sr_student_attendance_id))
                            {{__('translate.The student did not submit the report')}} {{-- لم يُسلم الطالب تقرير --}}
                        @else
                            <button class="btn btn-primary fa fa-file-text" onclick="report({{$student_attendance->sa_id}})" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="{{__('translate.View student report')}}"></button>{{-- عرض تقرير الطالب --}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif


