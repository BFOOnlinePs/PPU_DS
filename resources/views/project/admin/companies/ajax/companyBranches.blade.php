<div id="companyBranches">
<div class="row" >
            @foreach($company->companyBranch as $key)


                    <div class="col-md-6">
                        <div class="ribbon-wrapper card shadow-sm" style="border-radius: 5px;">
                          <div class="card-body">
                            <form id="EditCompanyBranches_{{$key->b_id}}" method="POST">
                            <div class="ribbon ribbon-primary ribbon-right">@if($key->b_main_branch == 1) {{__('translate.Main Branch')}}{{-- الفرع الرئيسي --}} @else {{__('translate.Branch')}} {{ $loop->index  ++  }}@endif</div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone1">{{__('translate.Phone 1')}}{{-- هاتف 1 --}}</label>
                                        <input class="f1-last-name form-control" id="phone1_{{$key->b_id}}" type="text" name="phone1_{{$key->b_id}}" value="{{$key->b_phone1}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone2">{{__('translate.Phone 2')}}{{-- هاتف 2 --}}</label>
                                        <input class="f1-last-name form-control" id="phone2_{{$key->b_id}}"  name="phone2_{{$key->b_id}}"  value="{{$key->b_phone2}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">{{__('translate.Branch Address')}}{{-- عنوان الفرع --}}</label>
                                        <input class="f1-last-name form-control" id="address_{{$key->b_id}}" type="text" name="address_{{$key->b_id}}"   value="{{$key->b_address}}" >
                                    </div>
                                </div>
                                <input hidden id="department_for_1_{{$key->b_id}}" name="department_for_1_{{$key->b_id}}">
                                <input hidden id="c_id_{{$key->b_id}}" name="c_id_{{$key->b_id}}" value="{{$company->c_id}}">
                                <input hidden id="manager_id_{{$key->b_id}}" name="manager_id_{{$key->b_id}}" value="{{$company->c_manager_id}}">
                                <input hidden id="b_id" name="b_id" value="{{$key->b_id}}">
                                <input hidden id="branches" name="branches" value="{{$company->companyBranch}}">
                                <div class="col-md-6">
                                    <div class="form-group" id="departments_group1_{{$key->b_id}}" >
                                        <input hidden id="branchesNumber_{{$key->b_id}}" name="branchedNumber_{{$key->b_id}}" value="{{count($company->companyBranch)}}">
                                        <label for="departments_{{$key->b_id}}">{{__('translate.Branch Departments')}}{{-- أقسام الفرع --}}</label>
                                        <select class="js-example-basic-single col-sm-12" multiple="multiple" id="departments_{{$key->b_id}}"  multiple></select>

                                    </div>
                                </div>



                            </div>
                <div class="f1-buttons" >
                    <button  id="submit_{{$key->b_id}}" onclick="submitEditCompanyBranches({{ $key->b_id}})" class="btn btn-primary">{{__('translate.Edit')}}{{-- تعديل --}}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('translate.Cancel')}}{{-- إلغاء --}}</button>
                                </div>
  </form>
                          </div>
                        </div>

                    </div>



            @endforeach
     </div>



                <div id="branches">

                </div>





    </div>
    </div>

<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
