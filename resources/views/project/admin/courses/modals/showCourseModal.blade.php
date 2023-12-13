<div class="modal fade show" id="ShowCourseModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">

                        <div class="col-md-4 text-center" style="margin: auto">


                                <h1><span class="fa fa-list" style="text-align: center; font-size:80px; "></span></h1>


                                <h1>استعراض مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك استعراض البيانات الخاصة بالمساقات </p>


                        </div>

                        <div class="col-md-8">

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_name" name="c_name" disabled type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_course_code" name="c_course_code" disabled type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">عدد ساعات المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_hours" name="c_hours" disabled type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>






                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">نوع المساق</label>
                                            <div class="col-lg-12">
                                            <select id="show_c_course_type" name="c_course_type" disabled class="form-control btn-square">
                                                <option value="-1">اختيار</option>
                                                <option value="0">نظري</option>
                                                <option value="1">عملي</option>
                                                <option value="2">نظري - عملي</option>
                                            </select>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">نوع المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_course_type" name="c_course_type" disabled type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div> --}}



                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للمساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_reference_code" name="c_reference_code" disabled type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                            <div class="col-lg-12">
                                                <textarea id="show_c_description" name="c_description" disabled type="text"
                                                class="form-control btn-square input-md" rows="6">
                                                </textarea>

                                            </div>
                                        </div>
                                    </div>

                                </div>


                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                </div>

        </div>
    </div>
</div>
