<div class="modal fade" id="update_faq_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form method="post" action="{{ route('admin.faq_category.update') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="faq_category_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">اسم الفئة</label>
                            <input type="text" name="c_name" id="c_name" required class="form-control" placeholder="اكتب اسم الفئة">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">تعديل</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
