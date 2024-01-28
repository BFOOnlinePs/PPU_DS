@extends('layouts.app')
@section('title')
{{__('translate.Main')}}{{--الرئيسية --}}
@endsection
@section('header_title')
{{__('translate.Companies Management')}}{{--إدارة الشركات--}}
@endsection
@section('header_title_link')
<a href="{{route('home')}}">{{__('translate.Main')}}{{-- الرئيسية --}}</a>
@endsection
@section('header_link')
<a href="{{ route('admin.companies.index') }}">{{__('translate.Display Companies')}}{{--استعراض الشركات--}}
@endsection

@section('content')

<div>
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.companies.company")}}"'><span class="fa fa-plus"></span> {{__('translate.Add Company')}}{{-- إضافة شركة --}}</button>
    <button class="btn btn-primary  mb-2 btn-s" type="button" onclick='location.href="{{route("admin.companies_categories.index")}}"'><span class="fa fa-briefcase"></span> {{__('translate.Companies Categories')}}{{-- تصنيف الشركات --}}</button>
</div>

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >
        @if(!$data->isEmpty())
        <div class="form-outline">
            <input type="search" onkeyup="companySearch(this.value)" class="form-control mb-2" placeholder="{{__('translate.Search')}}"
                aria-label="Search" /> {{-- بحث --}}
        </div>
        @endif
        <div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">{{__('translate.Company Name')}} {{-- اسم الشركة --}}</th>
                            <th scope="col">{{__('translate.Company Manager')}}{{-- مدير الشركة --}}</th>
                            <th scope="col">{{__('translate.Company Category')}}{{-- تصنيف الشركة --}}</th>
                            <th scope="col">{{__('translate.Company Type')}}{{-- نوع الشركة --}}</th>
                            <th scope="col">{{__('translate.Operations')}} {{--  العمليات --}}</th>

                        </tr>
                    </thead>
                    <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span>{{__('translate.No data to display')}}{{--لا توجد بيانات--}}</span></td>
                        </tr>
                    @else
                        @foreach ($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->c_id }}</td>
                                <td>{{ $key->c_name }}</td>
                                <td>{{ $key->manager->name }}</td>
                                <td>{{ $key->companyCategories->cc_name}}</td>
                                @if( $key->c_type == 1) <td>{{__('translate.Public Sector')}}{{-- قطاع عام --}}</td>@endif
                                @if( $key->c_type == 2) <td>{{__('translate.Private Sector')}}{{-- قطاع خاص --}}</td>@endif
                                <td>
                                  <button class="btn btn-info" onclick='location.href="{{route("admin.companies.edit",["id"=>$key->c_id])}}"'><i class="fa fa-search"></i></button>
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

<script>


function companySearch(data){

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Send an AJAX request with the CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
    $('#showTable').html('<div class="modal-body text-center"><div class="loader-box"><div class="loader-3" ></div></div></div>')
    $.ajax({
        url: "{{ route('admin.companies.companySearch') }}",
        method: "post",
        data: {
            'search': data,
            _token: '{!! csrf_token() !!}',
        },
        success: function(data) {
            $('#showTable').html(data.view);
        },
        error: function(xhr, status, error) {
            alert('error');
        }
    });

}

</script>

@endsection
