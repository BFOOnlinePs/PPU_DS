@if ($payments->isEmpty())
    <h6 class="alert alert-danger">لا يوجد دفعات لهذا الطالب</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اسم المستخدم الَّذي قام بإضافة دفعة</th>
                <th>قيمة المبلغ</th>
                <th>الرقم المرجعي</th>
                <th>حالة الدفعة</th>
                <th>ملاحظات الطالب</th>
                <th>ملاحظات مدير الشركة</th>
                <th>ملاحظات المشرف الأكاديمي</th>
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

