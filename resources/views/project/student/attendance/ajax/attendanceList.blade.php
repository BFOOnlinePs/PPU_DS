<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('translate.Day')}}{{-- اليوم --}}</th>
            <th>{{__('translate.Date')}}{{-- التاريخ --}}</th>
            <th>{{__('translate.Arrival time')}} {{-- وقت الوصول --}}</th>
            <th>{{__('translate.Departure time')}} {{-- وقت المغادرة --}}</th>
            <th>{{__('translate.The company')}}{{-- الشركة --}}</th>
            <th>{{__('translate.View supervisor notes')}}{{-- عرض ملاحظات المشرف --}}</th>
            <th>{{__('translate.Report submission')}}{{-- تسليم التقرير --}}</th>
        </tr>
    </thead>
    <tbody>
        @include('project.student.attendance.ajax.foreachAttendanceList')
    </tbody>
</table>


