<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
            <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
            <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
            <th>{{__('translate.View report')}} {{-- عرض التقرير --}}</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($records))
            @include('project.company_manager.records.ajax.foreachRecordsList')
        @endif
    </tbody>
</table>

