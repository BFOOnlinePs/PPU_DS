@if ($students_company->isEmpty())
    <h6 class="alert alert-danger">لا يوجد طلاب متدربين في هذه الشركة</h6>
@else
<div class="card">
    <table class="table table-bordered table-striped" id="students">
            <thead>
                <tr>
                    <th>اسم الطالب</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students_company as $student_company)
                    <tr>
                        <td>
                            {{$student_company->users->name}}
                        </td>
                        <td>
                            <a href="{{route('company_manager.students.reports.index' , ['id' => $student_company->sc_student_id])}}" class="btn btn-primary fa fa-file-text"></a>
                            <a href="{{route('company_manager.students.attendance.index' , ['id' => $student_company->sc_student_id])}}" class="btn btn-primary fa fa-check"></a>
                            <a href="{{route('company_manager.students.payments.index' , ['id' => $student_company->sc_student_id , 'name_student' => $student_company->users->name])}}" class="btn btn-primary fa fa-dollar"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
