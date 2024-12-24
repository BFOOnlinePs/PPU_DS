<div class="modal fade" id="add_faq_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <form method="post" action="{{ route('admin.faq_category.create') }}" class="modal-content">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">اكتب السؤال</label>
                            <textarea name="faq_question" id="" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">اضافة</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
