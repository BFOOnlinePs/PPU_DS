<div id="companiesPaymentsReportTable">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" style="display:none;">id</th>
                    <th scope="col">الشركة</th>
                    <th scope="col">المتدرب</th>
                    <th scope="col">إجمالي الدفعات</th>
                    <th scope="col">إجمالي الدفعات المؤكد عليها</th>
                    <th scope="col">تفاصيل الدفعات</th>

                </tr>
            </thead>
            <tbody>
            @if ($companiesPayments->isEmpty())
                <tr>
                    <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
            @else
                @foreach ($companiesPayments as $key)
                    <tr>
                        <td style="display:none;">{{ $key->p_id }}</td>
                        <td>{{ $key->payments->c_name }}</td>
                        <td>{{ $key->userStudent->name }}</td>
                        <td>
                            @if($key->paymentsShekelTotal != 0){{$key->paymentsShekelTotal}} @endif
                            @if ($key->paymentsDollarTotal != 0)@if($key->paymentsShekelTotal != 0) ,@endif {{$key->paymentsDollarTotal}}  @endif
                            @if ($key->paymentsDinarTotal != 0)@if($key->paymentsDollarTotal != 0 || $key->paymentsShekelTotal != 0) ,@endif {{$key->paymentsDinarTotal}} @endif

                        </td>
                        <td>
                            @if($key->paymentsShekelApprovedTotal != 0){{$key->paymentsShekelApprovedTotal}}@endif
                            @if ($key->paymentsDollarApprovedTotal != 0)@if($key->paymentsShekelApprovedTotal != 0) ,@endif{{$key->paymentsDollarApprovedTotal}} @endif
                            @if ($key->paymentsDinarApprovedTotal != 0)@if($key->paymentsShekelApprovedTotal != 0 || $key->paymentsDollarApprovedTotal != 0) ,@endif{{$key->paymentsDinarApprovedTotal}}  @endif
                            @if($key->paymentsShekelApprovedTotal ==0 && $key->paymentsDinarApprovedTotal == 0 && $key->paymentsDinarApprovedTotal == 0) لا يوجد دفعات مؤكد عليها@endif
                            {{-- {{$key->paymentsApprovedTotal}} --}}
                        </td>



                        <td>
                            <form id="testForm" action="{{route('monitor_evaluation.companyPaymentDetailes')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <input hidden id="test" name="test" value="{{$key}}"> --}}
                                <input hidden id="test" name="test" value="{{base64_encode(serialize($key))}}">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                          </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
