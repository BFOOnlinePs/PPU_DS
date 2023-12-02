<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>وقت الحضور</th>
            <th>وقت المغادرة</th>
            <th>عرض التقرير</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($records))
            @include('project.company_manager.records.ajax.foreachRecordsList')
        @endif
    </tbody>
</table>

