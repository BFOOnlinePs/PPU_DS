@extends('layouts.app')
@section('title')
    تقرير دفعات الشركات
@endsection
@section('header_title')
    تقرير دفعات الشركات
@endsection
@section('header_title_link')
    تقرير دفعات الشركات
@endsection
@section('header_link')
    تفاصيل الدفعة
@endsection

@section('style')

@endsection

@section('content')

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <h5>تفاصيل دفعات شركة: {{$payments[0]->payments->c_name}}، إلى الطالب: {{$payments[0]->userStudent->name}}</h5>
        {{-- <hr> --}}
        {{-- <h6>الشركة</h6> --}}

        <br>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th scope="col">تاريخ الدفعة</th>
                    <th scope="col">قيمة الدفعة</th>
                    <th scope="col">حالة الدفعة</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $key)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($key->created_at)->format('Y-m-d') }}</td>
                    <td>{{$key->currency->c_symbol}}{{ $key->p_payment_value}}</td>
                    <td>@if ($key->p_status == 0) غير مؤكدة @else مؤكدة @endif</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>إجمالي الدفعات</td>
                    <td>@if($trainingPayment->paymentsShekelTotal != 0){{$trainingPayment->paymentsShekelTotal}} @endif
                        @if ($trainingPayment->paymentsDollarTotal != 0)@if($trainingPayment->paymentsShekelTotal != 0) ,@endif {{$trainingPayment->paymentsDollarTotal}}  @endif
                        @if ($trainingPayment->paymentsDinarTotal != 0)@if($trainingPayment->paymentsDollarTotal != 0 || $trainingPayment->paymentsShekelTotal != 0) ,@endif {{$trainingPayment->paymentsDinarTotal}} @endif</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        {{-- <br>
        <div>
            إجمالي الدفعات: @if($trainingPayment->paymentsShekelTotal != 0){{$trainingPayment->paymentsShekelTotal}} @endif
            @if ($trainingPayment->paymentsDollarTotal != 0)@if($trainingPayment->paymentsShekelTotal != 0) ,@endif {{$trainingPayment->paymentsDollarTotal}}  @endif
            @if ($trainingPayment->paymentsDinarTotal != 0)@if($trainingPayment->paymentsDollarTotal != 0 || $trainingPayment->paymentsShekelTotal != 0) ,@endif {{$trainingPayment->paymentsDinarTotal}} @endif</div>
        <div>
            إجمالي الدفعات المؤكد عليها: @if($trainingPayment->paymentsShekelApprovedTotal != 0){{$trainingPayment->paymentsShekelApprovedTotal}}@endif
            @if ($trainingPayment->paymentsDollarApprovedTotal != 0)@if($trainingPayment->paymentsShekelApprovedTotal != 0) ,@endif{{$trainingPayment->paymentsDollarApprovedTotal}} @endif
            @if ($trainingPayment->paymentsDinarApprovedTotal != 0)@if($trainingPayment->paymentsShekelApprovedTotal != 0 || $trainingPayment->paymentsDollarApprovedTotal != 0) ,@endif{{$trainingPayment->paymentsDinarApprovedTotal}}  @endif
            @if($trainingPayment->paymentsShekelApprovedTotal ==0 && $trainingPayment->paymentsDinarApprovedTotal == 0 && $trainingPayment->paymentsDinarApprovedTotal == 0) لا يوجد دفعات مؤكد عليها@endif
            </div>

        <br> --}}


    </div>




</div>

@endsection
@section('script')



@endsection
