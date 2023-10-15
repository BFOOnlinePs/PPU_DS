@extends('layouts.app')
@section('title')
    إدارة المساقات
@endsection
@section('header_title')
    إدارة المساقات
@endsection
@section('header_title_link')
    الرئيسية
@endsection
@section('header_link')
    المساقات
@endsection
@section('content')
    {{-- <div class="alert alert-primary d-flex align-items-center col-md-3" role="alert">
        <span class="fa fa-check col-md-1"></span>
        <div class="col-md-11">
          تمت العملية بنجاح
        </div>
    </div>

    <div class="alert alert-danger d-flex align-items-center col-md-3" role="alert">
        <span class="fa fa-exclamation col-md-1"></span>
        <div class="col-md-11">
          هناك خطأ ! الرجاء المحاولة مرة أخرى
        </div>
    </div> --}}

    <div>
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddCourseModal').modal('show')" type="button"><span
                class="fa fa-plus"></span> إضافة مساق</button>


    </div>

    <div class="card" style="padding-left:0px; padding-right:0px;">

        {{-- <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h5 class="text-white">المساقات</h5>


            <div class="form-group mb-0 col-md-4">

                <input class="form-control " onkeyup="courseSearch(this.value)" type="search" placeholder="البحث">

            </div>

            <button class="btn btn-light active txt-dark" onclick="$('#AddCourseModal').modal('show')" type="button"><i
                    data-feather="plus"></i>
            </button>
        </div> --}}


        <div class="card-body">
            <div class="form-outline">
                <input type="search" onkeyup="courseSearch(this.value)" class="form-control mb-2" placeholder="البحث"
                    aria-label="Search" />
            </div>
            <div id="showTable">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="display:none;">id</th>
                                <th scope="col">اسم المساق</th>
                                <th scope="col">رمز المساق</th>
                                <th scope="col">ساعات المساق</th>
                                <th scope="col">نوع المساق</th>
                                <th scope="col">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $key)
                                <tr>
                                    <td style="display:none;">{{ $key->c_id }}</td>
                                    <td>{{ $key->c_name }}</td>
                                    <td>{{ $key->c_course_code }}</td>
                                    <td>{{ $key->c_hours }}</td>
                                    @if ($key->c_course_type == 0)
                                        <td>نظري</td>
                                    @endif
                                    @if ($key->c_course_type == 1)
                                        <td>عملي</td>
                                    @endif
                                    @if ($key->c_course_type == 2)
                                        <td>نظري - عملي</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-square btn-info btn-xs"
                                            onclick="showCourseModal({{ $key }})"><i
                                                data-feather="external-link"></i></button>
                                        <button class="btn btn-square btn-primary btn-xs"
                                            onclick="showEditCourseModal({{ $key }})"><i
                                                data-feather="edit"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade show" id="EditCourseModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header" style="height: 73px;">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="editModalBody">
                        <div class="row p-3 m-5">

                            <div class="col-md-4 text-center">


                                <h1><span class="fa fa-edit" style="text-align: center; font-size:80px; "></span></h1>


                                <h1 style="font-family: tajwal">تعديل مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك تعديل البيانات الخاصة بالمساقات </p>


                            </div>

                            <div class="col-md-8">
                                <form class="form-horizontal" id="editCourseForm" action="" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="edit_c_name" name="c_name" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="edit_c_course_code" name="c_course_code" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">عدد ساعات
                                                    المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="edit_c_hours" name="c_hours" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>






                                        </div>
                                        <div class="col-md-6">


                                            {{-- <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">نوع المساق</label>
                                                    <div class="col-lg-12">
                                                        <input id="edit_c_course_type" name="c_course_type" type="text"
                                                            class="form-control btn-square input-md">

                                                    </div>
                                                </div> --}}

                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="selectbasic">نوع المساق</label>
                                                <div class="col-lg-12">
                                                    <select id="edit_c_course_type" name="c_course_type"
                                                        class="form-control btn-square">
                                                        <option value="-1">اختيار</option>
                                                        <option value="0">نظري</option>
                                                        <option value="1">عملي</option>
                                                        <option value="2">نظري - عملي</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="edit_c_description" name="c_description" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي
                                                    للمساق</label>
                                                <div class="col-lg-12">
                                                    <input id="edit_c_reference_code" name="c_reference_code"
                                                        type="text" class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <input id="edit_c_id" name="c_id" hidden type="text"
                                                class="form-control btn-square input-md">

                                        </div>

                                    </div>


                            </div>

                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary">تعديل المساق</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="AddCourseModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header" style="height: 73px;">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-3 m-5">

                            <div class="col-md-4 text-center">


                                <h1><span class="fa fa-plus" style="text-align: center; font-size:80px; "></span></h1>


                                <h1 style="font-family: tajwal">إضافة مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك إضافة مساق جديد</p>


                            </div>

                            <div class="col-md-8">
                                <form class="form-horizontal" id="addCourseForm" action="" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="c_name" name="c_name" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="c_course_code" name="c_course_code" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <!-- Text input-->
                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">عدد ساعات
                                                    المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="c_hours" name="c_hours" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>






                                        </div>
                                        <div class="col-md-6">

                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="selectbasic">نوع المساق</label>
                                                <div class="col-lg-12">
                                                    <select id="c_course_type" name="c_course_type"
                                                        class="form-control btn-square">
                                                        <option value="-1">اختيار</option>
                                                        <option value="0">نظري</option>
                                                        <option value="1">عملي</option>
                                                        <option value="2">نظري - عملي</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                                <div class="col-lg-12">
                                                    <input id="c_description" name="c_description" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي
                                                    للمساق</label>
                                                <div class="col-lg-12">
                                                    <input id="c_reference_code" name="c_reference_code" type="text"
                                                        class="form-control btn-square input-md">

                                                </div>
                                            </div>
                                        </div>

                                    </div>


                            </div>

                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-primary">إضافة مساق</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="ShowCourseModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header" style="height: 73px;">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row p-3 m-5">

                            <div class="col-md-4 text-center">


                                <h1><span class="fa fa-list" style="text-align: center; font-size:80px; "></span></h1>


                                <h1 style="font-family: tajwal">استعراض مساق</h1>

                                <hr>
                                <p>في هذا القسم يمكنك استعراض البيانات الخاصة بالمساقات </p>


                            </div>

                            <div class="col-md-8">

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">اسم المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_name" name="c_name" disabled type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">رمز المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_course_code" name="c_course_code" disabled
                                                    type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">عدد ساعات المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_hours" name="c_hours" disabled type="text"
                                                    class="form-control btn-square input-md">

                                            </div>
                                        </div>






                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic">نوع المساق</label>
                                            <div class="col-lg-12">
                                                <select id="show_c_course_type" name="c_course_type" disabled
                                                    class="form-control btn-square">
                                                    <option value="-1">اختيار</option>
                                                    <option value="0">نظري</option>
                                                    <option value="1">عملي</option>
                                                    <option value="2">نظري - عملي</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-3 row">
                                                    <label class="col-lg-12 form-label " for="textinput">نوع المساق</label>
                                                    <div class="col-lg-12">
                                                        <input id="show_c_course_type" name="c_course_type" disabled type="text" class="form-control btn-square input-md">

                                                    </div>
                                                </div> --}}

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">وصف المساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_description" name="c_description" disabled
                                                    type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي
                                                للمساق</label>
                                            <div class="col-lg-12">
                                                <input id="show_c_reference_code" name="c_reference_code" disabled
                                                    type="text" class="form-control btn-square input-md">

                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection


@section('script')
    <script>
        let addCourseForm = document.getElementById("addCourseForm");
        let editCourseForm = document.getElementById("editCourseForm");

        addCourseForm.addEventListener("submit", (e) => {
            e.preventDefault();


            data = $('#addCourseForm').serialize();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.courses.create') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#AddCourseModal').modal('hide');
                    $('#showTable').html(response.view);
                    document.getElementById('c_name').value = "";
                    document.getElementById('c_course_code').value = "";
                    document.getElementById('c_hours').value = "";
                    document.getElementById('c_course_type').value = "";
                    document.getElementById('c_description').value = "";
                    document.getElementById('c_reference_code').value = "";
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });

        function showEditCourseModal(data) {
            document.getElementById('edit_c_id').value = data.c_id;
            document.getElementById('edit_c_name').value = data.c_name;
            document.getElementById('edit_c_course_code').value = data.c_course_code;
            document.getElementById('edit_c_hours').value = data.c_hours;
            document.getElementById('edit_c_course_type').value = data.c_course_type;
            document.getElementById('edit_c_description').value = data.c_description;
            document.getElementById('edit_c_reference_code').value = data.c_reference_code;
            $('#EditCourseModal').modal('show');
        }

        function showCourseModal(data) {
            document.getElementById('show_c_name').value = data.c_name;
            document.getElementById('show_c_course_code').value = data.c_course_code;
            document.getElementById('show_c_hours').value = data.c_hours;
            document.getElementById('show_c_course_type').value = data.c_course_type;
            document.getElementById('show_c_description').value = data.c_description;
            document.getElementById('show_c_reference_code').value = data.c_reference_code;
            $('#ShowCourseModal').modal('show');
        }

        editCourseForm.addEventListener("submit", (e) => {

            e.preventDefault();
            data = $('#editCourseForm').serialize();
            console.log(data);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                //new
                beforeSend: function() {
                    $('#editModalBody').html(
                        '<div class="loader-box"> <div class="loader-3" ></div></div>');
                },
                type: 'POST',
                url: "{{ route('admin.courses.update') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#EditCourseModal').modal('hide');
                    $('#showTable').html(response.view);
                },
                //new
                complete: function() {
                    $('.loader-3').css("visibility", "hidden");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });

        function courseSearch(data) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('admin.courses.courseSearch') }}", // Replace with your own URL
                method: "post",
                data: {
                    'search': data,
                    _token: '{!! csrf_token() !!}',
                }, // Specify the expected data type
                success: function(data) {
                    $('#showTable').html(data.view);
                },
                error: function(xhr, status, error) {
                    // This function is called when there is an error with the request
                    alert('error');
                }
            });
        }
    </script>
@endsection
