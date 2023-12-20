<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اليوم</th>
            <th>التاريخ</th>
            <th>وقت الحضور</th>
            <th>وقت المغادرة</th>
            <th>الشركة</th>
            <th>عرض ملاحظات المشرف</th>
            <th>تسليم التقرير</th>
        </tr>
    </thead>
    <tbody>
        @include('project.student.attendance.ajax.foreachAttendanceList')
    </tbody>
</table>


