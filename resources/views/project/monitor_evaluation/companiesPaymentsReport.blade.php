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
    تقرير دفعات الشركات
@endsection

@section('style')

<style>
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35); /* خلفية شفافة لشاشة التحميل */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* يجعل شاشة التحميل فوق جميع العناصر الأخرى */
    }
</style>

@endsection

@section('content')

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <!--loading whole page-->
        <div class="loader-container loader-box" id="loaderContainer" hidden>
            <div class="loader-3"></div>
        </div>
        <!--//////////////////-->

        <h4 class="text-center" id="companiesPaymentsReportTitle"></h4>
        <hr>

        <form id="companiesPaymentsReportSearchForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">الشركة</label>
                        <div class="col-lg-12">
                            <select id="company" name="company" class="form-control btn-square">
                                <option selected="" value="0">--اختيار--</option>
                                @foreach($companies as $key)
                                <option value={{$key->c_id}}> {{$key->c_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Semester')}}{{-- الفصل الدراسي --}}</label>
                        <div class="col-lg-12">
                            <select id="semester" name="semester" class="form-control btn-square">
                                {{-- <option value="0">جميع الفصول</option> --}}
                                <option value="1" @if($semester==1) selected @endif>{{__('translate.First')}}</option>
                                <option value="2" @if($semester==2) selected @endif>{{__('translate.Second')}}</option>
                                <option value="3" @if($semester==3) selected @endif>{{__('translate.Summer')}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">العام الدراسي</label>
                        <div class="col-lg-12">
                            <select id="year" name="year" class="form-control btn-square">
                                @foreach($years as $key)
                                <option value={{$key}} @if($key == $year) selected @endif> {{$key}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </form>

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
                                    @foreach ($key->paymentsTotalCollection as $item)
                                        @if($item["total"] != 0)
                                        <span class="badge rounded-pill badge-danger">{{$item["symbol"]}} {{$item["total"]}}</span>
                                        @endif
                                    @endforeach

                                </td>
                                <td>
                                    @foreach ($key->approvedPaymentsTotalCollection as $item)
                                    @if($item["total"] != 0)
                                    <span class="badge rounded-pill badge-danger">{{$item["symbol"]}} {{$item["total"]}}</span>
                                    @endif
                                    @endforeach
                                </td>



                                <td>
                                    <form id="testForm" action="{{route('monitor_evaluation.companyPaymentDetailes')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
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


    </div>




</div>

@endsection
@section('script')

<script>

window.addEventListener("load", (event) => {



    // reportTitle=""
    // if(semester==1){
    //     reportTitle = `تقرير الشركات للفصل الدراسي الأول`
    // }else if(semester==2){
    //     reportTitle = `تقرير الشركات للفصل الدراسي الثاني`
    // }else if(semester==3){
    //     reportTitle = `تقرير الشركات للفصل الدراسي الصيفي`
    // }
    // $('#companiesReportTitle').html(reportTitle);

    $('#companiesPaymentsReportSearchForm').find('select').each(function() {
        element = `${$(this)[0].id}`
        document.getElementById(`${element}`).addEventListener("change", function() {
            //console.log($(this).value)
            data = $('#companiesPaymentsReportSearchForm').serialize();
            console.log(data)
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            //Send an AJAX request
            $.ajax({
                beforeSend: function(){
                    document.getElementById('loaderContainer').hidden = false;
                },
                type: 'POST',
                url: "{{ route('monitor_evaluation.companiesPaymentsSearch') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    //console.log("all has done")
                    document.getElementById('loaderContainer').hidden = true;
                    // semester = document.getElementById('semester').value;
                    // document.getElementById('test').value = response.data;
                    // reportTitle=""
                    // if(semester==0){
                    //     reportTitle = `تقرير الشركات لجميع الفصول`
                    // }else if(semester==1){
                    //     reportTitle = `تقرير الشركات للفصل الدراسي الأول`
                    // }else if(semester==2){
                    //     reportTitle = `تقرير الشركات للفصل الدراسي الثاني`
                    // }else if(semester==3){
                    //     reportTitle = `تقرير الشركات للفصل الدراسي الصيفي`
                    // }
                    // $('#companiesReportTitle').html(reportTitle);

                    console.log(response);

                    $('#companiesPaymentsReportTable').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
    })
})
</script>


@endsection