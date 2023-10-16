<div class="modal fade show" id="AddCourseModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">

                        <div class="col-md-4 text-center" >


                                <h1><span class="fa fa-plus" style="text-align: center; font-size:80px; "></span></h1>


                                <h1>إضافة مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك إضافة مساق جديد</p>


                        </div>

                        <div class="col-md-8">
                            <form class="form-horizontal" id="addCourseForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">



                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                            <div class="col-lg-12">
                                                <input id="c_name"  tabindex="1" name="c_name" type="text"
                                                    class="form-control btn-square input-md" autofocus>

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                            <div class="col-lg-12">
                                                <input id="c_course_code" tabindex="3" name="c_course_code" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        {{-- <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">عدد ساعات المساق</label>
                                            <div class="col-lg-12">
                                                <input id="c_hours" tabindex="5" name="c_hours" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div> --}}

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">عدد ساعات المساق</label>
                                            <div class="col-lg-12">
                                            <select tabindex="5" id="c_hours" name="c_hours" class="form-control btn-square">
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
                                            <select id="c_course_type" tabindex="2" name="c_course_type" class="form-control btn-square">
                                                <option value="-1">--نوع المساق--</option>
                                                <option value="0">نظري</option>
                                                <option value="1">عملي</option>
                                                <option value="2">نظري - عملي</option>
                                            </select>
                                            </div>
                                        </div>


                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                            <div class="col-lg-12">
                                                <input id="c_description" tabindex="4" name="c_description" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للمساق</label>
                                            <div class="col-lg-12">
                                                <input id="c_reference_code" tabindex="6" name="c_reference_code" type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>
                                    </div>

                                </div>


                        </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">إضافة مساق</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
