<div class="modal fade show" id="editMajorModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header" style="height: 73px;">
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row p-3 m-5">

                                <div class="col-md-4 text-center" >


                                <h1><span class="fa fa-edit" style="text-align: center; font-size:80px; "></span></h1>


                                        <h1>تعديل التخصص</h1>

                                        <hr>
                                        <p>في هذا القسم يمكنك تعديل التخصص المراد</p>


                                </div>

                                <div class="col-md-8">
                                    <form id="editMajorForm" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Text input-->
                                                <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">اسم التخصص</label>
                                                    <div class="col-lg-12">
                                                       <input id="edit_m_name" type="text"  tabindex="1" class="form-control @error('edit_m_name') is-invalid @enderror btn-square input-md"
                                                              name="m_name" value="{{ old('m_name') }}" required  autofocus>
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
                                                    <input id="edit_m_description" type="text"  tabindex="2" class="form-control @error('m_description') is-invalid @enderror btn-square input-md" name="m_description"
                                                         value="{{ old('m_description') }}" required>
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
                                                      <input id="edit_m_reference_code"   tabindex="3" type="text" class="form-control @error('m_reference_code') is-invalid @enderror btn-square input-md"
                                                        name="m_reference_code" value="{{ old('m_reference_code') }}" required>
                                                              @error('m_reference_code')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                    </div>
                                                </div>

                                                <input id="edit_m_id" name="m_id" hidden type="text"
                                                    class="form-control btn-square input-md">




                                            </div>
                                          

                                        </div>


                                </div>

                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-primary">تعديل التخصص</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

      