<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th scope="col" style="display:none;">id</th>
            <th scope="col">{{__('translate.Student University ID')}}{{-- رقم الطالب الجامعي --}}</th>
            <th scope="col">{{__("translate.Student Name")}}{{-- اسم الطالب --}}</th>
            {{-- <th scope="col">رقم المساق</th>
            <th scope="col">اسم المساق</th> --}}
            <th scope="col">{{__('translate.Student Details')}}{{-- تفاصيل الطالب --}}</th>
        </tr>
    </thead>
    <tbody>
    @if ($data->isEmpty())
        <tr>
            <td colspan="4" class="text-center"><span>{{__('translate.No available data')}}{{-- لا توجد بيانات --}}</span></td>
        </tr>
    @else
        @foreach ($data as $key)
            <tr>
                <td style="display:none;">{{ $key->r_id }}</td>
                {{-- <td>{{ $key->users->u_username }}</td> --}}
                <td><a href="{{route('admin.users.details',['id'=>$key->users->u_id])}}">{{$key->users->name}}</a></td>
                <td>{{ $key->users->name }}</td>
                {{-- <td>{{ $key->courses->c_course_code }}</td>
                <td>{{ $key->courses->c_name }}</td> --}}
                <td>
                    <button class="btn btn-info" onclick='location.href="{{route("admin.users.details" , ["id"=>$key->users->u_id])}}"'><i class="fa fa-search"></i></button>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
