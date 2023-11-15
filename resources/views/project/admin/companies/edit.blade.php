@extends('layouts.app')
@section('title')
    استعراض شركة
@endsection
@section('header_title')
     الشركات
@endsection
@section('header_title_link')
    إدارة الشركات
@endsection
@section('header_link')
    تعديل شركة
@endsection

@section('content')

<label for="f1-last-name">اسم الشركة</label>
<input class="f1-last-name form-control" id="companyName" type="text" name="companyName" value="{{$company->c_name}}" disabled>                    </div>



@endsection


@section('script')
@endsection
