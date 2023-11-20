 <div class="modal fade show" id="AddMajorModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header" style="height: 73px;">
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-3 m-5">

                                <div class="col-md-4 text-center" >


                                        <h1><span class="fa fa-plus" style="text-align: center; font-size:80px; "></span></h1>


                                        <h1 >إضافة تخصص</h1>

                                        <hr>
                                        <p>في هذا القسم يمكنك إضافة تخصص جديد</p>


                                </div>

                                <div class="col-md-8">
                                    <form id="addMajorForm" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Text input-->
                                                <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">اسم التخصص</label>
                                                    <div class="col-lg-12">
                                                       <input id="m_name" type="text"  tabindex="1" class="form-control @error('m_name') is-invalid @enderror btn-square input-md"
                                                              name="m_name" value="{{ old('m_name') }}" required autocomplete="m_name" autofocus>
                                                                 @error('m_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                  @enderror
                                                     </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">وصف التخصص</label>
                                                    <div class="col-lg-12">
                                                    <input id="m_description" type="text"  tabindex="2" class="form-control @error('m_description') is-invalid @enderror btn-square input-md" name="m_description"
                                                         value="{{ old('m_description') }}" required autocomplete="m_description">
                                                         @error('m_description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للتخصص</label>
                                                    <div class="col-lg-12">
                                                      <input id="m_reference_code" type="text"  tabindex="3" class="form-control @error('m_reference_code') is-invalid @enderror btn-square input-md"
                                                        name="m_reference_code" value="{{ old('m_reference_code') }}" required autocomplete="m_reference_code">
                                                              @error('m_reference_code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>
                                                </div>

                                        
                                          

                                        </div> 


                                </div>

                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-primary">إضافة تخصص</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>