<div class="modal fade show" id="AddCourseToSemesterModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">

                        <div class="col-md-4 text-center" >


                                <h1><span class="fa fa-plus" style="text-align: center; font-size:80px; "></span></h1>


                                <h3>إضافة مساق إلى الفصل</h3>

                                <hr>
                                <p>في هذا القسم يمكنك إضافة مساق أو عدة مساقات إلى الفصل الحالي</p>


                        </div>


                            <div class="col-md-8">
                                <form class="form-horizontal" id="addCourseToSemesterForm" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="mb-2">
                                    <label class="col-form-label">المساقات "بامكانك اختيار مساق أو عدة مساقات"</label>
                                    <select class="js-example-basic-single col-sm-12" multiple="multiple" id="selectedCourses" multiple>
                                        @foreach($course as $key)
                                        <option value="{{$key->c_id}}">{{$key->c_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <select class="js-example-basic-single col-sm-12">
                                    @foreach($course as $key)
                                        <option value="{{$key->c_id}}">{{$key->c_name}}</option>
                                    @endforeach
                                </select> --}}


                            </div>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">إضافة</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
