<div class="modal fade show" id="AddUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center" >
                            <h1><span class="fa fa-user-plus" style="text-align: center; font-size:80px; "></span></h1>
                            <h1 id="title_modal_add_user">إضافة {{$role_name}}</h1>
                            <hr>
                            <p id="p_modal_add_user">في هذا القسم يمكنك إضافة {{$role_name}} جديد</p>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal" id="addUserForm" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" id='u_role_id' name="u_role_id" value="{{$u_role_id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label" for="textinput">الاسم</label>
                                            <div class="col-lg-12">
                                                <input id="name" name="name" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">اسم المستخدم</label>
                                            <div class="col-lg-12">
                                                <input id="u_username" name="u_username" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">البريد الإلكتروني</label>
                                            <div class="col-lg-12">
                                                <input id="email" name="email" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label" for="textinput">عنوان السكن</label>
                                            <div class="col-lg-12">
                                                <input id="u_address" name="u_address" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">التخصص</label>
                                            <div class="col-lg-12">
                                            <select id="u_major_id" name="u_major_id" class="form-control btn-square">
                                                @foreach ($major as $item)
                                                    <option value="{{$item->m_id}}">{{$item->m_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">تاريخ الميلاد</label>
                                            <div class="col-lg-12">
                                                <input id="u_date_of_birth" name="u_date_of_birth" type="date" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">كلمة السر</label>
                                            <div class="col-lg-12">
                                                <input id="password" name="password" type="password" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رقم الجوال</label>
                                            <div class="col-lg-12">
                                                <input id="u_phone1" name="u_phone1" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رقم جوال احتياطي</label>
                                            <div class="col-lg-12">
                                                <input id="u_phone2" name="u_phone2" type="text" class="form-control btn-square input-md" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="form-group m-t-15 custom-radio-ml">
                                                <label class="form-label">الجنس</label>
                                                <div class="radio radio-primary">
                                                    <input id="male" type="radio" name="u_gender" value="0" checked>
                                                    <label for="male" style="padding-right: 2px">ذكر</label>
                                                    <input id="female" type="radio" name="u_gender" value="1" style="margin: 10px;">
                                                    <label for="female" style="padding-right: 2px">أنثى</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" id="button_add_user_in_modal">إضافة {{$role_name}}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
