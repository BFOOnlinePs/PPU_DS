    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
                <th>{{__('translate.The username that added a payment')}}{{-- اسم المستخدم الَّذي قام بإضافة دفعة --}}</th>
                <th>{{__('translate.Amount value')}} {{-- قيمة المبلغ --}}</th>
                <th>{{__('translate.The reference number')}} {{-- الرقم المرجعي --}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($payments->isEmpty())
                <tr>
                    <td colspan="4" class="text-center"><span>{{__('translate.There are no payments for this student')}}{{-- لا يوجد دفعات لهذا الطالب --}}</span></td>
                </tr>
            @else
                @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->userStudent->name}}</td>
                        <td>{{$payment->userInsertedById->name}}</td>
                        <td>{{$payment->p_payment_value}} {{$payment->currency->c_symbol}}</td>
                        <td>{{$payment->p_reference_id}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

