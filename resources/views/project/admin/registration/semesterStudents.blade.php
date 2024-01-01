@extends('layouts.app')
@section('title')
    طلاب الفصل الحالي
@endsection
@section('header_title')
    طلاب الفصل الحالي
@endsection
@section('header_title_link')
    التسجيل
@endsection
@section('header_link')
    طلاب الفصل الحالي
@endsection

@section('style')

@endsection

@section('content')


<div>
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.registration.index")}}"'><span class="fa fa-book"></span> مساقات الفصل الحالي</button>
    {{-- <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.companies_categories.index")}}"'><span class="fa fa-users"></span> طلاب الفصل الحالي</button> --}}
</div>

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">رقم الطالب الجامعي</th>
                            <th scope="col">اسم الطالب</th>
                            {{-- <th scope="col">رقم المساق</th>
                            <th scope="col">اسم المساق</th> --}}
                            <th scope="col">تفاصيل الطالب</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center"><span>لا توجد بيانات</span></td>
                        </tr>
                    @else
                        @foreach ($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->r_id }}</td>
                                <td>{{ $key->users->u_username }}</td>
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
            </div>
        </div>



    </div>





</div>


@endsection
@section('script')

@endsection
