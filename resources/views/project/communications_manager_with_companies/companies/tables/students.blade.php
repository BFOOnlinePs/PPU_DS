@if ($students_company->isEmpty())
    <h6 class="alert alert-danger">{{__('translate.No available data')}} {{-- لا توجد بيانات  --}}<</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__("translate.Student Name")}} {{-- اسم الطالب --}}</th>
            <th>حالة التدريب</th>
            <th>{{__('translate.Display Student Information')}} {{-- عرض معلومات عن الطالب --}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students_company as $student)
            <tr>
                <td>{{$student->users->name}}</td>
                <td>
                    @if ($student->sc_status == 1)
                    {{__('translate.Still Trained')}} {{-- لا يزال يتدرب--}} 
                     @elseif($student->sc_status == 2)
                     {{__('translate.Completed')}}{{-- انهى التدريب --}}
                    @else
                   {{__("translate.Deleted")}}  {{--محذوف--}}
                    @endif
                </td>
                <td><a href="{{route('admin.users.details' , ['id'=>$student->sc_student_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

