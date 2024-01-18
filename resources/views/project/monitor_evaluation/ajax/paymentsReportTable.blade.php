<div id="paymentsReportTable">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th scope="col">الشركة</th>
                    <th scope="col">الطالب</th>
                    <th scope="col">تاريخ الدفعة</th>
                    <th scope="col">قيمة الدفعة</th>
                    <th scope="col">حالة الدفعة</th>

                </tr>
            </thead>
            <tbody>
                @if ($payments->isEmpty())
                <tr>
                    <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
                @else
                    @foreach ($payments as $key)
                    <tr>
                        <td>{{$key->payments->c_name}}</td>
                        <td>{{$key->userStudent->name}}</td>
                        <td>{{ \Carbon\Carbon::parse($key->created_at)->format('Y-m-d') }}</td>
                        <td>{{$key->currency->c_symbol}} {{ $key->p_payment_value}}</td>
                        <td  >@if ($key->p_status == 0) <span class="badge rounded-pill badge-danger">غير مؤكدة</span>  @else <span class="badge rounded-pill badge-primary">مؤكدة</span> @endif</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
