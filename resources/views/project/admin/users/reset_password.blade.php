<div class="modal fade" id="reset-password-user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تغيير كلمة المرور</h4>
                <button type="button" class="close" data-dismiss="modal" style="border: none;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="reset-password-user-form">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="id_reset_password" name="name_reset_password">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">كلمة المرور:</label>
                                <input type="password" class="form-control" id="user_reset_password_modal" name="password" required>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="reset_password()">تحديث كلمة المرور</button>
                </div>
            </div>
        </div>
    </div>
</div>
