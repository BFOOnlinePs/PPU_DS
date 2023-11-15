@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
تعديل المستخدم / <a href="{{route('admin.users.details' , ['id'=>$user->u_id])}}">{{$user->name}}</a>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-header pb-1">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="p-2 pt-0 row">
        @include('project.admin.users.includes.menu_student')
    </div>
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-3">
                @include('project.admin.users.includes.information_edit_card_student')
        </div>
        <div class="col-xl-9">
          <form class="card">
            <div class="card-header pb-0">
              <h4 class="card-title mb-0">أماكن التدريب</h4>
              <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
              <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm custom-btn" onclick="$('#AddPlacesTrainingModal').modal('show')" type="button"><span class="fa fa-plus"></span> تسجيل الطالب في تدريب</button>
                        </div>
                    </div>
              </div>
              <div class="row" id="content">
                @include('project.admin.users.ajax.placesTrainingList')
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    @include('project.admin.users.modals.add_places_training')
    @include('project.admin.users.modals.loading')
    @include('project.admin.users.modals.agreement_file')
  </div>
@endsection
@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        function submitFile(input, sc_id) {
            let file = input.files[0];
            if (file) {
                let formData = new FormData();
                formData.append('file_company_student', file);
                formData.append('id_company_student', sc_id);
                formData.append('sc_student_id', document.getElementById('u_id').value);

                $(`#progress-container${sc_id}`).show();

                // Make an AJAX request to submit the file
                $.ajax({
                    url: "{{ route('admin.users.training.place.update.file_agreement') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (event) {
                            if (event.lengthComputable) {
                                var percentComplete = (event.loaded / event.total) * 100;
                                $(`#progress-bar${sc_id}`).css('width', percentComplete + '%');
                                $(`#progress-bar${sc_id}`).attr('aria-valuenow', percentComplete);
                                $(`#progress-text${sc_id}`).text('Uploading: ' + percentComplete.toFixed(2) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        // Handle success, if needed
                        $('#content').html(response.html);
                        $('#progress-container').hide();
                    },
                    error: function (error) {
                        // Handle error, if needed
                        console.error(error);
                        $('#progress-container').hide();
                    }
                });
            }
        }
        function viewAttachment(url) {
            document.getElementById('view_attachment_result').src = url;
            $('#AgreementFileModal').modal('show');
        }
        function delete_training_place_for_student(sc_id) {
            sc_student_id = document.getElementById('u_id').value;
            $.ajax({
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.training.place.delete')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'sc_id':sc_id,
                    'sc_student_id':sc_student_id
                },
                success: function(response) {
                    $('#content').html(response.html);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });
        }
    $(document).ready(function() {
        $('#addPlacesTrainingForm').submit(function(e) {
            e.preventDefault();
            // data = $('#addPlacesTrainingForm').serialize();
            var formData = new FormData(this);
            id = document.getElementById('u_id').value;
            formData.append('id', id);
            $.ajax({
                beforeSend: function(){
                    $('#AddPlacesTrainingModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.places.training.add')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#AddPlacesTrainingModal').modal('hide');
                    $('#content').html(response.html);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });})});
        function checkSelectedBranch(branch_id) {
            $.ajax({
                url: "{{route('admin.users.places.training.departments')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'branch_id': branch_id
                },
                success: function(response) {
                    var selectDepartments = document.getElementById('select-departments');
                    selectDepartments.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectDepartments.firstChild) {
                        selectDepartments.removeChild(selectDepartments.firstChild);
                    }

                    var option = document.createElement('option');
                        option.value = "";
                        option.text = "";
                        selectDepartments.appendChild(option);

                    // Populate the select with departments
                    response.departments.forEach(function(department) {
                        var option = document.createElement('option');
                        option.value = department.d_id;
                        option.text = department.d_name;
                        selectDepartments.appendChild(option);
                    });
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
        function checkSelectedCompany(company_id) {
            $.ajax({
                url: "{{route('admin.users.places.training.branches')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'company_id': company_id
                },
                success: function(response) {
                    var departmentSelect = document.getElementById("select-departments");
                    // Loop through all options and remove them
                    while (departmentSelect.options.length > 0) {
                        departmentSelect.remove(0);
                    }
                    departmentSelect.disabled = true;

                    var selectBranches = document.getElementById('select-branches');
                    selectBranches.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectBranches.firstChild) {
                        selectBranches.removeChild(selectBranches.firstChild);
                    }

                    // Populate the select with branches
                    var option = document.createElement('option');
                        option.value = "";
                        option.text = "";
                        selectBranches.appendChild(option);

                    response.branches.forEach(function(branch) {
                        var option = document.createElement('option');
                        option.value = branch.b_id;
                        option.text = branch.b_address;
                        selectBranches.appendChild(option);
                    });


                    var selectTrainers = document.getElementById('select-trainers');
                    selectTrainers.removeAttribute('disabled'); // Enable the select

                    // Remove existing options
                    while (selectTrainers.firstChild) {
                        selectTrainers.removeChild(selectTrainers.firstChild);
                    }

                    response.trainers.forEach(function(trainer) {
                        var option = document.createElement('option');
                        option.value = trainer.u_id;
                        option.text = trainer.name;
                        selectTrainers.appendChild(option);
                    });
                },
                error: function() {
                    alert('Error fetching user data.');
                }
            });
        }
    </script>
    @endsection
