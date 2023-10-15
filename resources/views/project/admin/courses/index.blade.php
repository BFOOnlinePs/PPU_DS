@extends('layouts.app')
@section('title')
    إدارة المساقات
@endsection
@section('header_title')
    إدارة المساقات
@endsection
@section('header_title_link')
    إدارة المساقات
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
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddCourseModal').modal('show')" type="button"><span class="fa fa-plus"></span> إضافة مساق</button>
    </div>

    <div class="card" style="padding-left:0px; padding-right:0px;">

        <div class="card-body" >
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
                                @if( $key->c_course_type == 0) <td>نظري</td>@endif
                                @if( $key->c_course_type == 1) <td>عملي</td>@endif
                                @if( $key->c_course_type == 2) <td>نظري - عملي</td>@endif
                                <td>
                                    <button class="btn btn-info" onclick="showCourseModal({{ $key }})"><i class="fa fa-search"></i></button>
                                    <button class="btn btn-primary" onclick="showEditCourseModal({{ $key }})"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    </table>
                </div>
            </div>


            @include('project.admin.courses.modals.editCourseModal')

            @include('project.admin.courses.modals.showCourseModal')

            @include('project.admin.courses.modals.addCourseModal')


            @include('project.admin.courses.modals.loadingModal')

        </div>



    </div>

@endsection


@section('script')
    <script>
        let addCourseForm = document.getElementById("addCourseForm");
        let editCourseForm = document.getElementById("editCourseForm");
        let dataTable;

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
                beforeSend: function(){
                    $('#AddCourseModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
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
                complete: function(){
                    $('#LoadingModal').modal('hide');
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
                beforeSend: function(){
                    $('#EditCourseModal').modal('hide');
                    $('#LoadingModal').modal('show');
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
                complete: function(){
                    $('#LoadingModal').modal('hide');
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

            $('#showTable').html('<div class="modal-body text-center"><h2 class="title mb-0 text-center mt-4">الرجاء الانتظار...</h2><div class="loader-box"><div class="loader-3" ></div></div></div>');


            $.ajax({
                // beforeSend: function(){
                //     $('#showTable').html('<div class="modal-body text-center"><h2 class="title mb-0 text-center mt-4">الرجاء الانتظار...</h2><div class="loader-box"><div class="loader-3" ></div></div></div>');
                // },
                url: "{{ route('admin.courses.courseSearch') }}", // Replace with your own URL
                method: "post",
                data: {
                    'search': data,
                    _token: '{!! csrf_token() !!}',
                }, // Specify the expected data type
                success: function(data) {
                    dataTable = data;
                    $('#showTable').html(data.view);
                },
                // complete: function(){
                //     //$('#LoadingModal').modal('hide');
                //     $('#showTable').html(dataTable.view);
                // },
                error: function(xhr, status, error) {
                    // This function is called when there is an error with the request
                    alert('error');
                }
            });
        }

        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    </script>
@endsection
