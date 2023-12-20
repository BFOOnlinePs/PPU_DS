<div class="modal fade show" id="AddBranchModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">

                        <div class="col-md-6 text-center" >


                                <h1><span class="fa fa-plus" style="text-align: center; font-size:80px; "></span></h1>


                                <h1>إضافة فرع</h1>

                                <hr>
                                <p>في هذا القسم يمكنك إضافة فرع جديد</p>


                        </div>

                         <div class="col-md-6">
                            <form class="form-horizontal" id="addBranchForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">



                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">هاتف 1</label>
                                            <div class="col-lg-12">
                                                <input id="phone1"  type="text" name="phone1" tabindex="1"
                                                    class="form-control btn-square input-md" autofocus>

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">هاتف 2</label>
                                            <div class="col-lg-12">
                                                <input  tabindex="3" id="phone2"  name="phone2" 
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">عنوان الفرع</label>
                                            <div class="col-lg-12">
                                                <input  tabindex="4" id="address" type="text" name="address"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        
                                       
                                        <div class="mb-3 row">
                                        <div class="col-lg-12 form-label">
                                    <div class="col-lg-12" id="departments_group1" >
                                        <label for="departments1">أقسام الفرع</label>
                                        <select tabindex="5" class="js-example-basic-single col-sm-12" multiple="multiple" id="departments1" multiple>

                                              @foreach($companyDepartments as $key1)
                                                <option   value="{{$key1->d_id }}" >{{$key1->d_name}}</option>
                                            @endforeach
                                  </select>
                                 
                                    
                                       
                                   
                                    </div>
                                    </div>
                                    </div>
                                


                                        <input hidden id="c_id" name="c_id" value="{{$company->c_id}}">
                                        <input hidden id="manager_id" name="manager_id" value="{{$company->c_manager_id}}">
                                        <input hidden id="departmentsList" name="departmentsList">


                                  
                                  


                                       
                                    </div>

                                </div>


                        </div>
                </div>
                    </div>
               
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary">إضافة فرع</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                </div>
            </form>
        </div>
    </div>
</div>
