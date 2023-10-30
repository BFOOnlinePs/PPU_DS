@if ($student_attendances->isEmpty())
    <h6 class="alert alert-danger">لا يوجد سجلات لعرضها</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اسم الشركة</th>
                <th>وقت الدخول</th>
                <th>وقت المغادرة</th>
                <th>التفاصيل</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student_attendances as $student_attendance)
                <tr>
                    <td>{{$student_attendance->training->company->c_name}}</td>
                    <td>{{$student_attendance->sa_in_time}}</td>
                    <td>{{$student_attendance->sa_out_time}}</td>
                    <td>
                        <button class="btn btn-primary custom-btn fa fa-map-marker" onclick="map({{$student_attendance->sa_start_time_latitude}} , {{$student_attendance->sa_start_time_longitude}} , {{$student_attendance->sa_end_time_latitude}} , {{$student_attendance->sa_end_time_longitude}})" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض موقع الطالب عند تسجيل الحضور و المغادرة"></button>
                        <button class="btn btn-primary custom-btn fa fa-file-text" onclick="report({{$student_attendance->sa_id}})" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض تقرير الطالب"></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif


