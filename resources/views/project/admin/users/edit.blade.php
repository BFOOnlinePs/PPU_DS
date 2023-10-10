<div class="modal fade" id="edit-user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تعديل مستخدم</h4>
                <button type="button" class="close" data-dismiss="modal" style="border: none;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="edit-user-form">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="user_id_modal_edit" name="user_id_modal_edit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" class="form-control" id="user_name_modal_edit" name="name">
                                <span class="error-message" id="name-error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني:</label>
                                <input type="email" class="form-control" id="user_email_modal_edit" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone1">رقم الجوال:</label>
                                <input type="tel" class="form-control" id="user_phone1_modal_edit" name="phone1" pattern="[0-9]{10}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone2">رقم جوال الاحتياطي :</label>
                                <input type="tel" class="form-control" id="user_phone2_modal_edit" name="phone2" pattern="[0-9]{10}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_of_birth">تاريخ الميلاد:</label>
                                <input type="date" class="form-control" id="user_date_of_birth_modal_edit" name="date_of_birth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role_id">الدور:</label>
                                <input type="text" class="form-control" id="user_role_id_modal_edit" name="role_id">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="major_id">التخصص:</label>
                                <input type="text" class="form-control" id="user_major_id_modal_edit" name="major_id">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>الجنس:</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="male_edit" name="gender" class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="male">ذكر</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="female_edit" name="gender" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="female">أنثى</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">عنوان السكن:</label>
                                <textarea class="form-control" id="user_address_modal_edit" name="address" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" onclick="update_user()">تعديل</button>
                </div>
            </div>
        </div>
    </div>
</div>
