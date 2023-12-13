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
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
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
                        <th scope="col">المشرف</th>
                        <th scope="col">العمليات</th>

                    </tr>
                </thead>
                <tbody>

                @if ($data->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center"><span>لا توجد بيانات</span></td>
                    </tr>
                @else
                    @foreach ($data as $major)
                        <tr>
                            <td  style="display:none;">{{ $major->m_id }}</td>
                            <td>{{ $major->m_name }}</td>
                            <td>{{ $major->m_description }}</td>
                            <td>{{ $major->m_reference_code }}</td>
                                <td>
                        <select  class="js-example-basic-single col-sm-12" id="supervisor_{{ $major->m_id }}"  multiple="multiple"  onchange="showSuperVisorModal({{$major}})" >
                        @foreach ($superVisors as $super)
                            <option @foreach ($major->majorSupervisors as $majorSupervisor) @if($super->u_id ==  $majorSupervisor->users->u_id) selected @endif  @endforeach value="{{$super->u_id }}">{{$super->name}}</option>
                            @endforeach
                        </select>

                            </td>
                                                <td>
                                <button class="btn btn-info" onclick="showMajorModal({{ $major }})"><i class="fa fa-search"></i></button>
                                <button class="btn btn-primary" onclick="showEditModal({{ $major }})"><i class="fa fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
            </table>
        </div>
    </div>

@include('project.admin.majors.modals.addMajorModal')

@include('project.admin.majors.modals.editMajorModal')

@include('project.admin.majors.modals.selectSuperVisorModal')

@include('project.admin.majors.modals.showMajorModal')

@include('layouts.loader')

</div>

</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script>

    let AddMajorForm = document.getElementById("addMajorForm");
    let EditMajorForm = document.getElementById("editMajorForm");
    let AddSuperVisorForm = document.getElementById("AddSuperVisorForm");

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

    console.log("data");
    console.log(data.major_supervisors.users);
    console.log( document.getElementById('edited_supervisor'));
    document.getElementById('edit_m_id').value = data.m_id
    document.getElementById('edit_m_name').value = data.m_name
    document.getElementById('edit_m_description').value = data.m_description
    document.getElementById('edit_m_reference_code').value = data.m_reference_code

    // document.getElementById('edited_supervisor').value = data

    $('#editMajorModal').modal('show')
  }
    function showSuperVisorModal(data){
       superVisor = [];
       const selectElement =  document.getElementById("supervisor_"+data.m_id);
        for (const option of selectElement.options) {
            if (option.selected) {
              superVisor.push(option.value);
             }
        }

        var url;
        if(data.major_supervisors.length == 0)
        {
            url = "{{ route('admin.majors.addSuperVisor')}}";
        }
       else
       {
        url = "{{ route('admin.majors.updateSuperVisor') }}";
       }
          console.log("eeeeeee")


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

                    $('#LoadingModal').modal('show');
                },
            type: 'POST',
            url: url,
            data: {
                superVisor:superVisor,
                selected_m_id:data.m_id

            },
            dataType: 'json',
            success: function (response) {
                $('#majorsTable').html(response.view);
            },
            complete: function(){

                   $('#LoadingModal').modal('hide');
                },
            error: function (xhr, status, error) {
                console.error("error" + error);
            }
        });
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
            $('#majorsTable').html('<div class="modal-body text-center"><h2 class="title mb-0 text-center mt-4">الرجاء الانتظار...</h2><div class="loader-box"><div class="loader-3" ></div></div></div>');

            $.ajax({
                url: "{{ route('admin.majors.search') }}", // Replace with your own URL
                method: "post",
                data: {
                    'search':data,
                    _token: '{!! csrf_token() !!}',
                }, // Specify the expected data type
                success: function(data) {

                    $('#majorsTable').html(data.view);
                },
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




<!-- end -->
@endsection


