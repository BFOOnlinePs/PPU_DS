@if ($payments->isEmpty())
    <h6 class="alert alert-danger">لا يوجد دفعات لهذا الطالب</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.The username that added a payment')}} {{-- اسم المستخدم الَّذي قام بإضافة دفعة --}}</th>
                <th>{{__('translate.Amount value')}} {{-- قيمة المبلغ --}}</th>
                <th>{{__('translate.The reference number')}} {{-- الرقم المرجعي --}}</th>
                <th>حالة الدفعة</th>
                <th>ملاحظات مدير الشركة</th>
                <th>ملاحظات المشرف الأكاديمي</th>
                <th>{{__('translate.Student notes')}}{{-- ملاحظات الطالب --}}</th>
                <th>تأكيد استلام الدفعة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{$payment->userInsertedById->name}}</td>
                    <td>{{$payment->p_payment_value}} {{$payment->currency->c_symbol}}</td>
                    <td>{{$payment->p_reference_id}}</td>
                    <td>
                        @if ($payment->p_status == 1)
                            تم تأكيد استلامها
                        @else
                            لم يُؤكد الطالب استلامها
                        @endif
                    </td>
                    <td title="{{$payment->p_company_notes}}" onclick="showAlert(this , 'ملاحظات مدير الشركة')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $notes = $payment->p_company_notes;
                            $truncated_notes = str_word_count($notes, 1);
                            $truncated_notes = count($truncated_notes) > 7 ? implode(' ', array_slice($truncated_notes, 0, 7)) . ' ...' : $notes;
                        @endphp
                        {{$truncated_notes}}
                    </td>
                    <td title="{{$payment->p_supervisor_notes}}" onclick="showAlert(this , 'ملاحظات المشرف الأكاديمي')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $supervisorNotes = $payment->p_supervisor_notes;
                            $truncatedSupervisorNotes = str_word_count($supervisorNotes, 1);
                            $truncatedSupervisorNotes = count($truncatedSupervisorNotes) > 7 ? implode(' ', array_slice($truncatedSupervisorNotes, 0, 7)) . ' ...' : $supervisorNotes;
                        @endphp
                        {{$truncatedSupervisorNotes}}
                    </td>
                    <td title="{{$payment->p_student_notes}}" onclick="showAlert(this , 'ملاحظات الطالب')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $studentNotes = $payment->p_student_notes;
                            $truncatedStudentNotes = str_word_count($studentNotes, 1);
                            $truncatedStudentNotes = count($truncatedStudentNotes) > 7 ? implode(' ', array_slice($truncatedStudentNotes, 0, 7)) . ' ...' : $studentNotes;
                        @endphp
                        {{$truncatedStudentNotes}}
                    </td>
                    @if ($payment->p_status == 1)
                        <td><button class="btn btn-primary btn-sm" onclick="showModal({{$payment->p_id}})" type="button" id="confirm_payment_btn_{{$payment->p_id}}" disabled><span class="fa fa-plus"></span> تأكيد استلام الدفعة</button></td>
                    @else
                        <td><button class="btn btn-primary btn-sm" onclick="showModal({{$payment->p_id}})" type="button" id="confirm_payment_btn_{{$payment->p_id}}"><span class="fa fa-plus"></span> تأكيد استلام الدفعة</button></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

