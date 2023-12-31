@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد تخصصات مضافة لهذا المشرف لعرضها</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.Majors')}} {{-- التخصص --}}</th>
                <th>{{__('translate.Displaying students of major')}} {{-- عرض طلاب التخصص --}}</th>
                @if (auth()->user()->u_role_id == 1) {{-- Admin --}}
                    <th>
                        {{__('translate.Removing major for the supervisor')}} {{-- حذف التخصص للمشرف --}}
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key)
                <tr>
                    <td>{{$key->majors->m_name}}</td>
                    <td><a href="{{route('supervisors.students.index' , ['id' => $key->ms_super_id , 'ms_major_id' => $key->ms_major_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-users"></span></a></td>
                    @if (auth()->user()->u_role_id == 1) {{-- Admin --}}
                        <th>
                            <button class="btn btn-lg" onclick="delete_major_for_supervisor({{$key->ms_id}})" type="button"><span class="fa fa-trash "></span></button>
                        </th>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

