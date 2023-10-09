<div class="modal fade" id="add-user-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">إضافة مستخدم</h4>
                <button type="button" class="close" data-dismiss="modal" style="border: none;">&times;</button>
            </div>
            <div class="modal-body">
                <form id="add-user-form">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" class="form-control" id="user-name-modal" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني:</label>
                                <input type="email" class="form-control" id="user-email-modal" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password">كلمة المرور:</label>
                                <input type="password" class="form-control" id="user_password_modal" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5"> 
                            <div class="form-group">
                                <label for="phone1">رقم الجوال:</label>
                                <input type="tel" class="form-control" id="phone1" name="phone1">
                            </div>
                        </div>
                        <div class="col-md-4"> <!-- Second Column -->
                            <div class="form-group">
                                <label for="phone2">رقم جوال الاحتياطي :</label>
                                <input type="tel" class="form-control" id="phone2" name="phone2">
                            </div>
                        </div>
                        <div class="col-md-3"> <!-- First Column -->
                            <div class="form-group">
                                <label for="dob">عنوان السكن:</label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="dob">تاريخ الميلاد:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>الجنس:</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="male" name="gender" class="custom-control-input" value="male" checked>
                                    <label class="custom-control-label" for="male">ذكر</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="female" name="gender" class="custom-control-input" value="female">
                                    <label class="custom-control-label" for="female">أنثى</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="address">التخصص:</label>
                                <input type="text" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="dob">الدور</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" onclick="add_user()">إضافة</button>
            </div>
        </div>
    </div>
</div>
