@extends('layouts.app')
@section('title')
    إدارة الشركات
@endsection
@section('header_title')
    إدارة الشركات
@endsection
@section('header_title_link')
    إدارة الشركات
@endsection
@section('header_link')
    استعراض الشركات
@endsection

@section('content')

<div>
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.companies.company")}}"'><span class="fa fa-plus"></span> إضافة شركة</button>
</div>

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >
        <div class="form-outline">
            <input type="search" onkeyup="companySearch(this.value)" class="form-control mb-2" placeholder="البحث"
                aria-label="Search" />
        </div>
        <div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">اسم الشركة</th>
                            <th scope="col">مدير الشركة</th>
                            <th scope="col">نوع الشركة</th>
                            <th scope="col">تصنيف الشركة</th>
                            <th scope="col">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($data as $key)
                        <tr>
                            <td style="display:none;">{{ $key->c_id }}</td>
                            <td>{{ $key->c_name }}</td>
                            <td>{{ $key->manager->name }}</td>
                            <td>{{ $key->companyCategories->cc_name}}</td>
                            @if( $key->c_type == 1) <td>قطاع عام</td>@endif
                            @if( $key->c_type == 2) <td>قطاع خاص</td>@endif
                            <td>
                                <button class="btn btn-info" onclick=""><i class="fa fa-search"></i></button>
                                <button class="btn btn-primary" onclick=""><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                </table>
            </div>
        </div>

    </div>



</div>

@endsection


@section('script')
@endsection
