@if ($payments->isEmpty())
    <h6 class="alert alert-danger">{{__('translate.There are no payments for this student')}}{{-- لا يوجد دفعات لهذا الطالب --}}</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.The username that added a payment')}} {{-- اسم المستخدم الَّذي قام بإضافة دفعة --}}</th>
                <th>{{__('translate.Amount value')}} {{-- قيمة المبلغ --}}</th>
                <th>{{__('translate.The reference number')}} {{-- الرقم المرجعي --}}</th>
                <th>{{__('translate.Payment status')}}{{-- حالة الدفعة --}}</th>
                <th>{{__('translate.Company manager notes')}}{{-- ملاحظات مدير الشركة --}}</th>
                <th>{{__('translate.Supervisor notes')}}{{-- ملاحظات المشرف الأكاديمي --}}</th>
                <th>{{__('translate.Student notes')}}{{-- ملاحظات الطالب --}}</th>
                <th>{{__('translate.Confirm receipt of payment')}}{{-- تأكيد استلام الدفعة --}}</th>
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
                            {{__('translate.Receipt confirmed')}}{{-- تم تأكيد الاستلام --}}
                        @else
                            {{__('translate.The student did not confirm its receipt')}}{{-- لم يُؤكد الطالب استلامها --}}
                        @endif
                    </td>
                    <td title="{{$payment->p_company_notes}}" onclick="showAlert(this , '{{__('translate.Company manager notes')}}')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $notes = $payment->p_company_notes;
                            $truncated_notes = str_word_count($notes, 1);
                            $truncated_notes = count($truncated_notes) > 7 ? implode(' ', array_slice($truncated_notes, 0, 7)) . ' ...' : $notes;
                        @endphp
                        {{$truncated_notes}}
                    </td>
                    <td title="{{$payment->p_supervisor_notes}}" onclick="showAlert(this , '{{__('translate.Supervisor notes')}}')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $supervisorNotes = $payment->p_supervisor_notes;
                            $truncatedSupervisorNotes = str_word_count($supervisorNotes, 1);
                            $truncatedSupervisorNotes = count($truncatedSupervisorNotes) > 7 ? implode(' ', array_slice($truncatedSupervisorNotes, 0, 7)) . ' ...' : $supervisorNotes;
                        @endphp
                        {{$truncatedSupervisorNotes}}
                    </td>
                    <td title="{{$payment->p_student_notes}}" onclick="showAlert(this , '{{__('translate.Student notes')}}')" style="cursor: pointer; font-size: smaller;">
                        @php
                            $studentNotes = $payment->p_student_notes;
                            $truncatedStudentNotes = str_word_count($studentNotes, 1);
                            $truncatedStudentNotes = count($truncatedStudentNotes) > 7 ? implode(' ', array_slice($truncatedStudentNotes, 0, 7)) . ' ...' : $studentNotes;
                        @endphp
                        {{$truncatedStudentNotes}}
                    </td>
                    @if ($payment->p_status == 1)
                        <td><span>{{__('translate.Receipt confirmed')}}{{-- تم تأكيد الاستلام --}}</span></td>
                    @else
                        <td><button class="btn btn-primary btn-sm" onclick="showModal({{$payment->p_id}})" type="button" id="confirm_payment_btn_{{$payment->p_id}}"><span class="fa fa-plus"></span>{{__('translate.Confirm receipt of payment')}}{{-- تأكيد استلام الدفعة --}}</button></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

