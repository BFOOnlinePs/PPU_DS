@if ($students->isEmpty())
    <span class="text-center">لا يوجد متدربين في هذه الشركة</span>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
                <th>{{__('translate.Branch')}} {{-- الفرع --}}</th>
                <th>{{__('translate.The section')}} {{-- القسم --}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->users->name}}</td>

                    <td>
                        @if (isset($student->companyBranch->b_address))
                            {{$student->companyBranch->b_address}}
                        @else
                            {{__('translate.Branch unspecified')}} {{-- الفرع غير محدد --}}
                        @endif
                    </td>
                    <td>
                        @if (isset($student->companyDepartment->d_name))
                            {{$student->companyDepartment->d_name}}
                        @else
                            {{__('translate.Section unspecified')}} {{-- القسم غير محدد --}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
