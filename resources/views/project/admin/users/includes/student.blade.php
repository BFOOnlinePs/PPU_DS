@if ($students->isEmpty())
    <span class="text-center">لا يوجد متدربين في هذه الشركة</span>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اسم الطالب</th>
                <th>الفرع</th>
                <th>القسم</th>
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
                            الفرع غير محدد
                        @endif
                    </td>
                    <td>
                        @if (isset($student->companyDepartment->d_name))
                            {{$student->companyDepartment->d_name}}
                        @else
                            القسم غير محددة
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
