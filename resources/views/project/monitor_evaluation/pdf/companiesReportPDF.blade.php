@extends('layouts.styleForPDF')
@section('title')
    تقرير فصل
@endsection
@section('content')

    <h4 class="text-center">جامعة بوليتكنك فلسطين</h4>
    <h4 class="text-center">كلية الدراسات الثنائية</h4>
    <hr>
    <br>

    <div id="companiesReportTable">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
                        <th scope="col">{{__('translate.Manager of the company')}}{{-- مدير الشركة --}}</th>
                        <th scope="col">{{__('translate.Company category')}}{{-- تصنيف الشركة --}}</th>
                        <th scope="col">{{__('translate.Type of company')}}{{-- نوع الشركة --}}</th>
                        <th scope="col">إجمالي الطلاب</th>

                    </tr>
                </thead>
                <tbody>
                @if ($data->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                    </tr>
                @else
                    @foreach ($data as $key)
                        <tr>
                            <td>{{ $key->c_name }}</td>
                            <td>{{ $key->manager->name }}</td>
                            <td>{{ $key->companyCategories->cc_name}}</td>
                            @if( $key->c_type == 1) <td>{{__('translate.Public sector')}}{{-- قطاع عام --}}</td>@endif
                            @if( $key->c_type == 2) <td>{{__('translate.Private sector')}}{{-- قطاع خاص --}}</td>@endif
                            <td>
                              {{$key->studentsTotal}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            </table>
        </div>
    </div>


@endsection
