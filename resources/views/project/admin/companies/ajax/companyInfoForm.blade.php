
<div id="editCompanyForm">
            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-first-name"> {{__('translate.Company name')}} {{-- اسم الشركة --}}</label>

                            <div class="input-container">
                                <i id="ok_icon" class="icon fa fa-check" style="color:#24695c" hidden></i>
                                <i id="search_icon" class="icon_spinner fa fa-spin fa-refresh" hidden></i>
                                <input class="form-control" type="text" id="c_name" name="c_name" value="{{$company->c_name}}" required="" onkeyup="checkCompany(this.value)">
                            </div>

                            <div id="similarCompanyMessage" style="color:#dc3545" hidden>
                                <span>يوجد شركة بنفس الاسم الذي قمت بادخاله،</span>
                                <u><a id="companyLink" style="color:#dc3545">للانتقال إلى التعديل قم بالضغط هنا</a></u>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Owner')}}{{-- الشخص المسؤول --}}</label>
                            <input class="f1-last-name form-control" id="name" type="text" name="name" value="{{$company->manager->name}}" required="">
                        </div>
                    </div>

              <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company phone number')}}{{-- رقم هاتف الشركة --}}</label>
                            <input class="f1-last-name form-control" id="phoneNum" type="text" name="phoneNum" value="{{$company->manager->u_phone1}}" required="">
                        </div>


                </div>

    </div>





    <div class="row">
                <div class="col-md-4">
                        <div class=" mb-3 form-group">
                            <label for="f1-first-name"> {{__('translate.Email')}} {{-- البريد الإلكتروني --}} </label>
                            <input class="form-control" id="email" type="text" name="email" value="{{$company->manager->email}}" required="h">
                        </div>

                 </div>
                       <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Password')}} {{-- كلمة المرور --}}</label>
                            <input class="f1-password form-control" id="password" type="password" name="password" >
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="f1-last-name">{{__('translate.Company address')}}{{-- عنوان الشركة --}}</label>
                                <input class="f1-last-name form-control" id="address" type="text" name="address" value="{{$company->manager->u_address}}" required="">
                            </div>
                    </div>
                </div>



                <div class="row">


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company Type')}}{{-- نوع الشركة --}}</label>
                            <select id="c_type" name="c_type" class="form-control btn-square" value="{{$company->c_type}}">
                                <option @if($company->c_type== 1) selected @endif value="1">{{__('translate.Public sector')}}{{-- قطاع عام --}}</option>
                                <option @if($company->c_type== 2) selected @endif value="2">{{__('translate.Private sector')}}{{-- قطاع خاص --}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company category')}}{{-- تصنيف الشركة --}}</label>
                            <select id="c_category" name="c_category" class="form-control btn-square" value="{{$company->c_category_id}}">
                                @foreach($categories as $key)
                                   <option value="{{$key->cc_id}}" @if($company->c_category_id == $key->cc_id) selected @endif>{{$key->cc_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
   <div class="col-md-4">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Website')}}{{-- الموقع الإلكتروني --}}</label>
                            <input  class="form-control" id="c_website" name="c_website" value="{{$company->c_website}}">
                        </div>
                    </div>


                </div>
                 <div class="row">



                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="f1-last-name">{{__('translate.Company description')}}{{-- وصف الشركة --}}</label>
                            <textarea  class="form-control" id="c_description" name="c_description" rows="6" >{{$company->c_description}}</textarea>
                        </div>
                    </div>



    </div>



                <input hidden id="manager_id" name="manager_id" value="{{$company->manager->u_id}}">
                <input hidden id="c_id" name="c_id" value="{{$company->c_id}}">
</div>

