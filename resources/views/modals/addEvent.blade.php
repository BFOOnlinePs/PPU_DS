<div class="modal fade show" id="AddEventModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="clear_function()"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center" >
                            <h1><span class="fa fa-calendar" style="text-align: center; font-size:80px; "></span></h1>
                            <h3>إضافة حدث</h3>
                            <hr>
                            <p>في هذا القسم يمكنك إضافة حدث للتقويم</p>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal" id="addEventForm" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="e_title" name="e_title">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">لون الحدث</label>
                                        <input type="color" class="form-control" id="e_color" name="e_color">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">الوصف</label>
                                        <textarea type="text" class="form-control" id="e_description" name="e_description"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">الفئة التي سيظهر لها الحدث</label>
                                        <select autofocus class="js-example-basic-single col-sm-12" name="e_type" id="e_type" onchange="action_listener_when_choose_option(this.value , 'e_id_type')">
                                            <option value="0">الجميع</option>
                                            <option value="1">طلاب تخصص معين</option>
                                            <option value="2">طلاب مساق معين</option>
                                            <option value="3">متدربين شركة معينة</option>
                                            <option value="4">لكل المشرفين الأكادميين</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label" id="label_e_id_type">تحديد الفئة</label>
                                        <select autofocus class="js-example-basic-single col-sm-12" name="e_id_type" id="e_id_type" style="disabled">
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">من</label>
                                        <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="e_start_date" name="e_start_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">إلى</label>
                                        <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="e_end_date" name="e_end_date">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">إضافة حدث</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="clear_function()">{{__('translate.Cancel')}} {{-- إلغاء --}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
