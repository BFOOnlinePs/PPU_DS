@extends('layouts.app')
@section('title')
إدارة التخصصات 
@endsection
@section('header_title')
إدارة التخصصات 
@endsection
@section('header_title_link')
إدارة التخصصات 
@endsection
@section('header_link')
التخصصات
@endsection
@section('style')
<style>
    table td,
    table th {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    tbody td {
        font-weight: 500;
        color: #999999;
    }
</style>
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
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddMajorModal').modal('show')" type="button" id="openAddModalButton"><span class="fa fa-plus"></span>  إضافة تخصص</button>
    </div>
   
<div class="card" style="padding-left:0px; padding-right:0px;">

<div class="card-body" >
    <div class="form-outline">
        <input type="search" onkeyup="majorSearch(this.value)" class="form-control mb-2" placeholder="البحث"
            aria-label="Search" />
    </div>
    <div id="majorsTable">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="display:none;">id</th>
                        <th scope="col">اسم التخصص</th>
                        <th scope="col">وصف التخصص</th>
                        <th scope="col">الرمز المرجعي للتخصص</th>
                        <th scope="col">العمليات</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($data as $key)
                    <tr>
                        <td style="display:none;">{{ $key->m_id }}</td>
                        <td>{{ $key->m_name }}</td>
                        <td>{{ $key->m_description }}</td>
                        <td>{{ $key->m_reference_code }}</td>
                        <td>
                            <button class="btn btn-info" onclick="showMajorModal({{ $key }})"><i class="fa fa-search"></i></button>
                            <button class="btn btn-primary" onclick="showEditModal({{ $key }})"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
            </table>
        </div>
    </div>

@include('project.admin.majors.modals.addMajorModal')

@include('project.admin.majors.modals.editMajorModal')

@include('project.admin.majors.modals.showMajorModal')

@include('layouts.loader')

</div>



</div>
@endsection
@section('script')
<script>
    let AddMajorForm = document.getElementById("addMajorForm");
    let EditMajorForm = document.getElementById("editMajorForm");

    AddMajorForm.addEventListener("submit", (e) => {
        e.preventDefault();
        data = $('#addMajorForm').serialize();
        console.log(data)
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
           
                    $('#AddMajorModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
            type: 'POST',
            url: "{{ route('admin.majors.create') }}",
            data: data,
            success: function (response) {
                $('#AddMajorModal').modal('hide');
                $('#majorsTable').html(response.view);
            },
            complete: function(){
                    $('#LoadingModal').modal('hide');
                },
            error: function (xhr, status, error) {
                console.error("error" + error);
            }
        });

    });
    function showEditModal(data){
    console.log(data);
    document.getElementById('edit_m_id').value = data.m_id
    document.getElementById('edit_m_name').value = data.m_name
    document.getElementById('edit_m_description').value = data.m_description
    document.getElementById('edit_m_reference_code').value = data.m_reference_code
  
   

    $('#editMajorModal').modal('show')
  }
    EditMajorForm.addEventListener("submit", (e) => {
        e.preventDefault();
        data = $('#editMajorForm').serialize();
        console.log("data")
        console.log(data)
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
                    $('#editMajorModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
            type: 'POST',
            url: "{{ route('admin.majors.update') }}",
            data: data,
            success: function (response) {
                $('#editMajorModal').modal('hide');
                $('#majorsTable').html(response.view);
            },
            complete: function(){
                    $('#LoadingModal').modal('hide');
                },
            error: function (xhr, status, error) {
                console.error("error" + error);
            }
        });

    });
    function showMajorModal(data) {
            document.getElementById('show_m_name').value = data.m_name;
            document.getElementById('show_m_description').value = data.m_description;
            document.getElementById('show_m_reference_code').value = data.m_reference_code;
           
            $('#showMajorModal').modal('show');
        }
    function majorSearch(data){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                url: "{{ route('admin.majors.search') }}", // Replace with your own URL
                method: "post",
                data: {
                    'search':data,
                    _token: '{!! csrf_token() !!}',
                }, // Specify the expected data type
                success: function(data) {
                    $('#majorsTable').html(data.view);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    // This function is called when there is an error with the request
                    alert('error');
                }
            });
        }
              
</script>
@endsection
