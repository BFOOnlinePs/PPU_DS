<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اليوم</th>
            <th>التاريخ</th>
            <th>وقت الحضور</th>
            <th>وقت المغادرة</th>
        </tr>
    </thead>
    <tbody>
        @include('project.company_manager.students.attendance.includes.foreachAttendanceList')
    </tbody>
</table>
