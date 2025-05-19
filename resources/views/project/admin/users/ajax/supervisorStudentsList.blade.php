<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{ __('translate.Student Name') }} {{-- اسم الطالب --}}</th>
            <th>{{ __('translate.Username') }} {{-- اسم المستخدم --}}</th>
            <th>{{ __('translate.Major') }} {{-- التخصص --}}</th>
            <th>{{ __('translate.View Details') }} {{-- عرض تفاصيل --}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if ($students->isEmpty())
            <tr>
                <td colspan="4" class="text-center">
                    <span>{{ __('translate.No Students to Display') }}{{-- لا يوجد طلاب لعرضهم --}}</span>
                </td>
            </tr>
        @else
            @foreach ($students as $student)
                <tr>
                    {{-- <td>{{$student->name}}</td> --}}
                    <td><a href="{{ route('admin.users.details', ['id' => $student->u_id]) }}">{{ $student->name }}</a>
                    </td>
                    <td>{{ $student->u_username ?? '' }}</td>
                    <td>{{ $student->major->m_name ?? '' }}</td>
                    <td>
                        <select onchange="add_training_supervisor({{ $student->u_id }} , this.value)" class="form-control"
                            name="" id="">
                            <option value="">اختر المشرف ...</option>

                            @php
                                $registration = App\Models\Registration::where('r_student_id', $student->u_id)
                                    ->where('r_year', App\Models\SystemSetting::first()->ss_year)
                                    ->first();
                            @endphp
                            @foreach ($supervisors as $supervisor)
                                <option onchange="add_training_supervisor({{ $student->u_id }} , this.value)" @if ($registration && $supervisor->u_id == $registration->supervisor_id) selected @endif
                                    value="{{ $supervisor->u_id }}">{{ $supervisor->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><a href="{{ route('admin.users.details', ['id' => $student->u_id]) }}"
                            class="btn btn-primary btn-xs"><span class="fa fa-search"></span></a></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
