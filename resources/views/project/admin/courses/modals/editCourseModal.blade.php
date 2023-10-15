<div class="modal fade show" id="EditCourseModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="row p-3 m-5">

                        <div class="col-md-4 text-center" >


                                <h1><span class="fa fa-edit" style="text-align: center; font-size:80px; "></span></h1>


                                <h1>تعديل مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك تعديل البيانات الخاصة بالمساقات </p>


                        </div>

                        <div class="col-md-8">
                            <form class="form-horizontal" id="editCourseForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                            <div class="col-lg-12">
                                                <input autofocus id="edit_c_name" tabindex="-2" name="c_name" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                            <div class="col-lg-12">
                                                <input tabindex="3" id="edit_c_course_code" name="c_course_code" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">عدد ساعات المساق</label>
                                            <div class="col-lg-12">
                                            <select tabindex="5" id="edit_c_hours" name="c_hours" class="form-control btn-square">
                                                <option value="0">--عدد ساعات المساق--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">نوع المساق</label>
                                            <div class="col-lg-12">
                                            <select tabindex="2" id="edit_c_course_type" name="c_course_type" class="form-control btn-square">
                                                <option value="-1">اختيار</option>
                                                <option value="0">نظري</option>
                                                <option value="1">عملي</option>
                                                <option value="2">نظري - عملي</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                            <div class="col-lg-12">
                                                <input tabindex="4" id="edit_c_description" name="c_description" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للمساق</label>
                                            <div class="col-lg-12">
                                                <input tabindex="6" id="edit_c_reference_code" name="c_reference_code" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <input id="edit_c_id" name="c_id" hidden type="text"
                                            class="form-control btn-square input-md">

                                    </div>

                                </div>


                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">تعديل المساق</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
