<div class="modal fade show" id="EditCompaniesCategoriesModal" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="EditCompaniesCategories" method="post">
                    <input name="cc_id" id="edit_cc_id" type="text" hidden>
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center">
                            <h1><span class="fa fa-briefcase" style="text-align: center; font-size:80px; "></span></h1>
                            <h3>إضافة تصنيف للشركة</h3>
                            <hr>
                            <p>في هذا القسم يمكنك إضافة تصنيف للشركة</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">تصنيف الشركة</label>
                                        <input autocomplete="off" name="cc_name" id="edit_cc_name" required placeholder="تصنيف الشركة" type="text"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer ">
                <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
            </div>
            </form>
        </div>
    </div>
</div>
