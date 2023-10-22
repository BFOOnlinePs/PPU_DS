<div class="modal fade show" id="AddPlacesTrainingModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center" >
                            <h1><span class="fa fa-clipboard" style="text-align: center; font-size:80px; "></span></h1>
                            <h3>تسجيل الطالب في تدريب</h3>
                            <hr>
                            <p>في هذا القسم يمكنك تسجيل الطالب في تدريب</p>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal" id="addPlacesTrainingForm" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="">الشركة</label>
                                            <select autofocus class="js-example-basic-single col-sm-12" id="select-companies" onchange="checkSelectedCompany(this.value)" name="company">
                                                <option value=""></option>
                                                @foreach ($companies as $company)
                                                    <option value="{{$company->c_id}}">{{$company->c_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="">الفرع</label>
                                            <select autofocus class="js-example-basic-single col-sm-12" id="select-branches" onchange="checkSelectedBranch(this.value)" name="branch" disabled>
                                                @if ($branches != null)
                                                    <option value=""></option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{$branch->b_id}}">{{$branches->b_address}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="">الدائرة التابعة للفرع</label>
                                            <select autofocus class="js-example-basic-single col-sm-12" id="select-departments" name="department" disabled>
                                                @if ($departments != null)
                                                    <option value=""></option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{$department->d_id}}">{{$department->d_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="textinput">المدرب (من الشركة)</label>
                                            <select autofocus class="js-example-basic-single col-sm-12" id="select-trainers" name="trainer" disabled>
                                                    @if ($trainers != null)
                                                    <option value=""></option>
                                                    @foreach ($trainers as $trainer)
                                                        <option value="{{$trainer->ce_id}}">{{$trainer->ce_id}}</option>
                                                    @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="textinput">المساعد الإداري (من الجامعة)</label>
                                            <select autofocus class="js-example-basic-single col-sm-12" name="manager_assistant">
                                                <option value=""></option>
                                                @foreach ($manager_assistants as $manager_assistant)
                                                    <option value="{{$manager_assistant->u_id}}">{{$manager_assistant->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="approval_file">ملف الموافقة</label>
                                            <input type="file" id="approval_file" name="file">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">تسجيل الطالب في التدريب</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>

