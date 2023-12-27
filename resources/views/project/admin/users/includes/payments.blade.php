@if ($payments->isEmpty())
    <h6 class="alert alert-danger">لا يوجد دفعات لهذا الطالب</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.The username that added a payment')}} {{-- اسم المستخدم الذي قام بإضافة دفعة --}}</th>
                <th>{{__('translate.Amount value')}} {{-- قيمة المبلغ --}}</th>
                <th>{{__('translate.The reference number')}} {{-- الرقم المرجعي --}}</th>
                <th>{{__('translate.Payment status')}} {{-- حالة الدفعة --}}</th>
                <th>{{__('translate.Student notes')}} {{-- ملاحظات الطالب --}}</th>
                <th>{{__('translate.Company manager notes')}} {{-- ملاحظات مدير الشركة --}}</th>
                <th>{{__('translate.Supervisor notes')}} {{-- ملاحظات المشرف الأكاديمي --}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{$payment->userInsertedById->name}}</td>
                    <td>{{$payment->p_payment_value}} {{$payment->currency->c_symbol}}</td>
                    <td>{{$payment->p_reference_id}}</td>
                    <td>{{$payment->p_status}}</td>
                    <td>{{$payment->p_student_notes}}</td>
                    <td>{{$payment->p_company_notes}}</td>
                    <td>{{$payment->p_supervisor_notes}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

