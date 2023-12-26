@if ($student_companies->isEmpty())
    <h6 class="alert alert-danger">لا يوجد شركات مسجل فيها </h6>
@else
<div class="alert alert-danger" style="display: none" id="alert_departure">
    <span>عذرًا لا يُمكن تسجيل المغادرة بسبب انتهاء الوقت</span>
</div>
<div class="card">
    <input type="hidden" id="latitude">
    <input type="hidden" id="longitude">
    <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
                    <th>{{__('translate.Branch')}} {{-- الفرع --}}</th>
                    <th>{{__('translate.The section')}} {{-- القسم --}}</th>
                    <th>المدرب المسؤول في الشركة</th>
                    <th>مساعد المشرف في الجامعة</th>
                    <th>سِجل الحضور والمغادرة</th>
                    <th id="attendance_id">
                        @if ($show_in_buttons)
                            تسجيل حضور
                        @else
                            تسجيل مغادرة
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($student_companies as $student_company)
                    <tr>
                        <td>{{$student_company->company->c_name}}</td>
                        <td>
                            @if (isset($student_company->companyBranch->b_address))
                                {{$student_company->companyBranch->b_address}}
                            @endif
                        </td>

                        <td>
                            @if (isset($student_company->companyDepartment->d_name))
                                {{$student_company->companyDepartment->d_name}}
                            @endif
                        </td>
                        <td>
                            @if (isset($student_company->userMentorTrainer->name))
                                {{$student_company->userMentorTrainer->name}}
                            @endif
                        </td>
                        <td>
                            @if (isset($student_company->userAssistant->name))
                                {{$student_company->userAssistant->name}}
                            @endif
                        </td>
                        <td><a href="{{route('students.company.attendance.index_for_specific_student' , ['id' => $student_company->sc_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-check"></span></a></td>
                        <td>
                            @if ($show_in_buttons)
                                <button class="btn btn-primary btn-sm" onclick="AttendanceRegistration({{$student_company->sc_id}})" type="button"><span class="fa fa-plus"></span> تسجيل حضور</button>
                            @elseif($sa_student_company_id == $student_company->sc_id)
                                <button class="btn btn-primary btn-sm" onclick="DepartureRegistration({{$student_company->sc_id}})" type="button"><span class="fa fa-sign-out"></span> تسجيل مغادرة </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
