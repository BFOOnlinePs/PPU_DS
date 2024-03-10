<div class="modal fade show" id="DetailsModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center" >
                            <h1><span class="fa fa-book" style="text-align: center; font-size:80px; "></span></h1>
                            <h3>عرض تفاصيل الحضور والمغادرة والتقرير</h3>
                            <hr>
                            <p>في هذا القسم يمكنك عرض تفاصيل الحضور والمغادرة والتقرير</p>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal">
                                @method('post')
                                @csrf
                                <h6>تفاصيل الحضور والمغادرة</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">الاسم</label>
                                            <input type="text" class="form-control" id="name_modal" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">الشركة</label>
                                            <input type="text" class="form-control" id="company_modal" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">وقت الحضور</label>
                                            <input type="text" class="form-control" id="in_time_modal" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">وقت المغادرة</label>
                                            <input type="text" class="form-control" id="out_time_modal" disabled>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
                                <h6>تفاصيل التقرير</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">التقرير</label>
                                            <textarea cols="5" rows="3" class="form-control" id="report_text_modal" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0"></label>
                                            <a id="attachment_file_modal" type="button" download>{{__('translate.Download Report Attachment')}}{{-- تنزيل الملف المرفق مع التقرير --}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">ملاحظات المشرف الأكاديمي</label>
                                            <textarea cols="1" rows="2" class="form-control" id="notes_supervisor_modal" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label  class="col-form-label pt-0">ملاحظات مدير الشركة</label>
                                            <textarea cols="1" rows="2" class="form-control" id="notes_company_modal" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{__('translate.Cancel')}} {{-- إلغاء --}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
