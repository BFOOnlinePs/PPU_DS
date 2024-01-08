@extends('layouts.app')
@section('title')
    تقرير الشركات
@endsection
@section('header_title')
    تقرير الشركات
@endsection
@section('header_title_link')
    تقرير الشركات
@endsection
@section('header_link')
    تقرير الشركات
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

        <h4 class="text-center" id="companiesReportTitle"></h4>
        <hr>
        {{-- <br> --}}

        <form id="companiesReportSearchForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">



                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Semester')}}{{-- الفصل الدراسي --}}</label>
                        {{-- <input class="form-control" id="semester" name="semester"> --}}
                        <div class="col-lg-12">
                            <select id="semester" name="semester" class="form-control btn-square">
                                <option value="0">جميع الفصول</option>
                                <option value="1" @if($semester==1) selected @endif>{{__('translate.First')}}{{-- أول --}}</option>
                                <option value="2" @if($semester==2) selected @endif>{{__('translate.Second')}}{{-- ثاني --}}</option>
                                <option value="3" @if($semester==3) selected @endif>{{__('translate.Summer')}}{{-- صيفي --}}</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">نوع الشركة</label>
                        <div class="col-lg-12">
                            <select id="companyType" name="companyType" class="form-control btn-square">
                                {{-- <option selected="" disabled="" value="">--اختيار--</option> --}}
                                <option selected="" value="0">--اختيار--</option>
                                <option value="1">{{__('translate.Public sector')}}{{-- قطاع عام --}}</option>
                                <option value="2">{{__('translate.Private sector')}}{{-- قطاع خاص --}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="exampleInputEmail1">تصنيف الشركة</label>
                        <div class="col-lg-12">
                            <select id="companyCategory" name="companyCategory" class="form-control btn-square">
                                {{-- <option selected="" disabled="" value="">--اختيار--</option> --}}
                                <option selected="" value="0">--اختيار--</option>
                                @foreach($categories as $key)
                                    <option value="{{$key->cc_id}}">{{$key->cc_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-md-2 d-flex justify-content-left">
                    <div class="form-group">
                        <div style="margin-top:50%;" style="width: 100%">
                        <button class="btn btn-danger  mb-2 btn-s" style="width: 120px" type="submit">حذف الفلتر بحث</button>
                        <a href="" style="display: block; text-align: left;"><i class="fa fa-times-circle-o"></i> حذف الفلتر</a>
                        </div>
                    </div>
                </div> --}}



            </div>
        </form>


        <div id="companiesReportTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
                            <th scope="col">{{__('translate.Manager of the company')}}{{-- مدير الشركة --}}</th>
                            <th scope="col">{{__('translate.Company category')}}{{-- تصنيف الشركة --}}</th>
                            <th scope="col">{{__('translate.Type of company')}}{{-- نوع الشركة --}}</th>
                            <th scope="col">إجمالي الطلاب</th>

                        </tr>
                    </thead>
                    <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                        </tr>
                    @else
                        @foreach ($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->c_id }}</td>
                                <td>{{ $key->c_name }}</td>
                                <td>{{ $key->manager->name }}</td>
                                <td>{{ $key->companyCategories->cc_name}}</td>
                                @if( $key->c_type == 1) <td>{{__('translate.Public sector')}}{{-- قطاع عام --}}</td>@endif
                                @if( $key->c_type == 2) <td>{{__('translate.Private sector')}}{{-- قطاع خاص --}}</td>@endif
                                <td>
                                  {{$key->studentsTotal}}
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

    //console.log({!! json_encode($data, JSON_HEX_APOS) !!})

    semester = {!! json_encode($semester, JSON_HEX_APOS) !!}
    reportTitle=""
    if(semester==1){
        reportTitle = `تقرير الشركات للفصل الدراسي الأول`
    }else if(semester==2){
        reportTitle = `تقرير الشركات للفصل الدراسي الثاني`
    }else if(semester==3){
        reportTitle = `تقرير الشركات للفصل الدراسي الصيفي`
    }
    $('#companiesReportTitle').html(reportTitle);

    $('#companiesReportSearchForm').find('select').each(function() {
        element = `${$(this)[0].id}`
        document.getElementById(`${element}`).addEventListener("change", function() {
            //console.log($(this).value)
            data = $('#companiesReportSearchForm').serialize();
            // console.log(data)
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
                url: "{{ route('monitor_evaluation.companiesReportSearch') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    //console.log("all has done")
                    document.getElementById('loaderContainer').hidden = true;
                    semester = document.getElementById('semester').value;
                    reportTitle=""
                    if(semester==0){
                        reportTitle = `تقرير الشركات لجميع الفصول`
                    }else if(semester==1){
                        reportTitle = `تقرير الشركات للفصل الدراسي الأول`
                    }else if(semester==2){
                        reportTitle = `تقرير الشركات للفصل الدراسي الثاني`
                    }else if(semester==3){
                        reportTitle = `تقرير الشركات للفصل الدراسي الصيفي`
                    }
                    $('#companiesReportTitle').html(reportTitle);
                    $('#companiesReportTable').html(response.view);
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
