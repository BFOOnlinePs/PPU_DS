<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('translate.Day')}}{{-- اليوم --}}</th>
            <th>{{__('translate.Date')}}{{-- التاريخ --}}</th>
            <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
            <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
        </tr>
    </thead>
    <tbody>
        @include('project.company_manager.students.attendance.includes.foreachAttendanceList')
    </tbody>
</table>
