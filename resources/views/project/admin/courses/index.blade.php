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
    <div class="card" style="padding-left:0px; padding-right:0px;">
        <div class="card-header bg-primary d-flex justify-content-between align-items-center">
            <h5 class="text-white">المساقات</h5>

            {{-- <div class="row mt-5">
                <div class="col-md-5 mx-auto">
                    <div class="input-group">
                        <input class="form-control border rounded-pill" type="search" value="search" id="example-search-input">
                    </div>
                </div>
            </div> --}}

            <div class="form-group mb-0 col-md-4">

                <input class="form-control " onkeyup="courseSearch(this.value)" type="search" placeholder="البحث">

            </div>

            <button class="btn btn-light active txt-dark" onclick="$('#AddCourseModal').modal('show')" type="button"><i
                    data-feather="plus"></i>
            </button>
        </div>

        <div class="card-body" >

            <div class="table-responsive" id="showTable">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">اسم المساق</th>
                            <th scope="col">رمز المساق</th>
                            <th scope="col">ساعات المساق</th>
                            <th scope="col">نوع المساق</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->c_id }}</td>
                                <td>{{ $key->c_name }}</td>
                                <td>{{ $key->c_course_code }}</td>
                                <td>{{ $key->c_hours }}</td>
                                <td>{{ $key->c_course_type }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button style="background-color: transparent; border: none;"
                                                onclick="$('#ShowCourseModal').modal('show')"><i
                                                    data-feather="external-link"></i></button>
                                        </div>
                                        <div class="col-md-6">
                                            <button style="background-color: transparent; border: none;"
                                                onclick="showEditCourseModal({{ $key }})"><i
                                                    data-feather="edit"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

        <div class="modal fade bd-example-modal-xl" id="AddCourseModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">إضافة مساق</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

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
                                        <label class="col-lg-12 form-label " for="textinput">عدد ساعات المساق</label>
                                        <div class="col-lg-12">
                                            <input id="c_hours" name="c_hours" type="text"
                                                class="form-control btn-square input-md">

                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-12 form-label " for="textinput">نوع المساق</label>
                                        <div class="col-lg-12">
                                            <input id="c_course_type" name="c_course_type" type="text"
                                                class="form-control btn-square input-md">

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
                                        <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للمساق</label>
                                        <div class="col-lg-12">
                                            <input id="c_reference_code" name="c_reference_code" type="text"
                                                class="form-control btn-square input-md">

                                        </div>
                                    </div>


                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">إضافة مساق</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-xl" id="EditCourseModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">تعديل مساق</h4>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

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
                                        <label class="col-lg-12 form-label " for="textinput">عدد ساعات المساق</label>
                                        <div class="col-lg-12">
                                            <input id="edit_c_hours" name="c_hours" type="text"
                                                class="form-control btn-square input-md">

                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-12 form-label " for="textinput">نوع المساق</label>
                                        <div class="col-lg-12">
                                            <input id="edit_c_course_type" name="c_course_type" type="text"
                                                class="form-control btn-square input-md">

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
                                        <label class="col-lg-12 form-label " for="textinput">الرمز المرجعي للمساق</label>
                                        <div class="col-lg-12">
                                            <input id="edit_c_reference_code" name="c_reference_code" type="text"
                                                class="form-control btn-square input-md">

                                        </div>
                                    </div>

                                    <input id="edit_c_id" name="c_id" hidden type="text"
                                        class="form-control btn-square input-md">

                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary">تعديل مساق</button>
                            <button type="submit" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        </form>

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

        editCourseForm.addEventListener("submit", (e) => {
            e.preventDefault();
            data = $('#editCourseForm').serialize();
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
                url: "{{ route('admin.courses.update') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#EditCourseModal').modal('hide');
                    $('#showTable').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

        });

    function courseSearch(data){
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
                'search':data,
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
