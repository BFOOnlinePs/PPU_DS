@if ($payments->isEmpty())
    <h6 class="alert alert-danger">لا يوجد دفعات لهذا الطالب</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__("translate.Student's name")}} {{-- اسم الطالب --}}</th>
                <th>اسم المستخدم الَّذي قام بإضافة دفعة</th>
                <th>قيمة المبلغ</th>
                <th>الرقم المرجعي</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{$payment->userStudent->name}}</td>
                    <td>{{$payment->userInsertedById->name}}</td>
                    <td>{{$payment->p_payment_value}} {{$payment->currency->c_symbol}}</td>
                    <td>{{$payment->p_reference_id}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

