@if ($student_attendances->isEmpty())
    <h6 class="alert alert-danger">لا يوجد سجلات لعرضها</h6>
@else

<div class="container-fluid">
    <div class="row ui-sortable" id="draggableMultiple">
        @foreach($student_attendances as $student_attendance)
            <div class="col-sm-12 col-xl-6">
                <div class="card b-r-0">
                    <div class="card-header pb-0">
                        <a href="{{route('students.report.edit' , ['sa_id' => $student_attendance->sa_id])}}" class="fa fa-edit" style="font-size: x-large;" data-bs-original-title="" title=""><span></span></a>
                        <h6>{{strftime('%A', strtotime($student_attendance->sa_in_time))}}</h6>
                        <h6>{{date("Y-m-d", strtotime($student_attendance->sa_in_time))}}</h6>
                    </div>
                    <div class="card-body">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    {{-- <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اليوم</th>
                <th>التاريخ</th>
                <th>رفع ملف التقرير</th>
                <th>كتابة ملاحظات عن تقرير اليوم</th>
                <th>تسجيل مغادرة</th>
                <th>عرض ملاحظات المشرف</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student_attendances as $student_attendance)
                <tr>
                    <td>{{strftime('%A', strtotime($student_attendance->sa_in_time))}}</td>
                    <td>{{$student_attendance->sa_in_time}}</td>
                    <td>
                        <div id="progress-container{{$student_attendance->sa_id}}" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar{{$student_attendance->sa_id}}" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span id="progress-text{{$student_attendance->sa_id}}">Uploading...</span>
                            </div>
                            <label for="file_report{{$student_attendance->sa_id}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-upload"></i>
                            </label>
                            <input type="file" name="file_report_student{{$student_attendance->sa_id}}" onchange="submitFile(this, {{$student_attendance->sa_id}})" id="file_report{{$student_attendance->sa_id}}" style="display: none;">
                    </td>
                    <td></td>
                    @if (!isset($student_attendance->sa_out_time))
                        <td><button class="btn btn-primary fa fa-sign-out" onclick="confirm_departure({{$student_attendance->sa_id}})" type="button"></button></td>
                    @else
                        <td><span class="fa fa-check"></span></td>
                    @endif
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
@endif


