<div id="paymentsReportTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th scope="col">{{__('translate.Company')}} {{-- الشركة --}}</th>
                            <th scope="col">{{__('translate.The student')}} {{-- الطالب --}}</th>
                            <th scope="col">{{__('translate.Payment Date')}} {{-- تاريخ الدفعة --}}</th>
                            <th scope="col">{{__('translate.Payment Amount')}} {{-- قيمة الدفعة --}}</th>
                            <th scope="col">{{__('translate.Payment Status')}} {{-- حالة الدفعة --}} </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($payments->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span> {{__('translate.No available data')}} {{-- لا توجد بيانات  --}}</span></td>
                        </tr>
                        @else
                            @foreach ($payments as $key)
                            <tr>
                                <td>{{$key->payments->c_name}}</td>
                                <td>{{$key->userStudent->name}}</td>
                                <td>{{ \Carbon\Carbon::parse($key->created_at)->format('Y-m-d') }}</td>
                                <td>{{$key->currency->c_symbol}} {{ $key->p_payment_value}}</td>
                                <td  >@if ($key->p_status == 0) <span class="badge rounded-pill badge-danger">{{__('translate.Not Confirmed')}} {{-- غير مؤكدة --}}</span>  @else <span class="badge rounded-pill badge-primary">{{__('translate.Confirmed')}} {{-- مؤكدة --}}</span> @endif</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>