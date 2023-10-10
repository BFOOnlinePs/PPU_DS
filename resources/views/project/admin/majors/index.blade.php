@extends('layouts.app')
@section('title')
الرئيسية
@endsection
@section('header_title')
الرئيسية
@endsection
@section('header_title_link')
الرئيسية
@endsection
@section('header_link')
الرئيسية
@endsection
@section('content')
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
<a onclick="$('#AddMajorModal').modal('show')" id="openAddModalButton" class="btn btn-success">اضافة</a>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="table-responsive bg-white">
                <div id="majorsTable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">اسم التخصص</th>
                                <th scope="col">وصف التخصص</th>
                                <th scope="col">الرمز المرجعي للتخصص </th>
                                <th scope="col">التعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                            <tr>
                                <td>{{ $key->m_id }}</td>
                                <td>{{ $key->m_name }}</td>
                                <td>{{ $key->m_description }}</td>
                                <td>{{ $key->m_reference_code }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-light">Edit</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



</div>

<div class="modal fade bd-example-modal-xl" id="AddMajorModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">اضافة تخصص</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addMajorForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="m_name" class="col-md-4 col-form-label text-md-end">{{ __('اسم التخصص') }}</label>

                        <div class="col-md-6">
                            <input id="m_name" type="text" class="form-control @error('m_name') is-invalid @enderror"
                                name="m_name" value="{{ old('m_name') }}" required autocomplete="m_name" autofocus>

                            @error('m_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="m_description" class="col-md-4 col-form-label text-md-end">{{ __('وصف التخصص')
                            }}</label>

                        <div class="col-md-6">
                            <input id="m_description" type="text"
                                class="form-control @error('m_description') is-invalid @enderror" name="m_description"
                                value="{{ old('m_description') }}" required autocomplete="m_description">

                            @error('m_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="m_reference_code" class="col-md-4 col-form-label text-md-end">{{ __('الرمز المرجعي
                            للتخصص') }}</label>

                        <div class="col-md-6">
                            <input id="m_reference_code" type="text"
                                class="form-control @error('m_reference_code') is-invalid @enderror"
                                name="m_reference_code" value="{{ old('m_reference_code') }}" required
                                autocomplete="m_reference_code" autofocus>

                            @error('m_reference_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('اضافة تخصص ') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-xl" id="AddMajorModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">اضافة تخصص</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addMajorForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="m_name" class="col-md-4 col-form-label text-md-end">{{ __('اسم التخصص') }}</label>

                        <div class="col-md-6">
                            <input id="m_name" type="text" class="form-control @error('m_name') is-invalid @enderror"
                                name="m_name" value="{{ old('m_name') }}" required autocomplete="m_name" autofocus>

                            @error('m_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="m_description" class="col-md-4 col-form-label text-md-end">{{ __('وصف التخصص')
                            }}</label>

                        <div class="col-md-6">
                            <input id="m_description" type="text"
                                class="form-control @error('m_description') is-invalid @enderror" name="m_description"
                                value="{{ old('m_description') }}" required autocomplete="m_description">

                            @error('m_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="m_reference_code" class="col-md-4 col-form-label text-md-end">{{ __('الرمز المرجعي
                            للتخصص') }}</label>

                        <div class="col-md-6">
                            <input id="m_reference_code" type="text"
                                class="form-control @error('m_reference_code') is-invalid @enderror"
                                name="m_reference_code" value="{{ old('m_reference_code') }}" required
                                autocomplete="m_reference_code" autofocus>

                            @error('m_reference_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('اضافة تخصص ') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script>
    let AddUserForm = document.getElementById("addMajorForm");

    AddUserForm.addEventListener("submit", (e) => {
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
            type: 'POST',
            url: "{{ route('admin.majors.create') }}",
            data: data,
            success: function (response) {
                $('#AddMajorModal').modal('hide');
                $('#majorsTable').html(response.view);
            },
            error: function (xhr, status, error) {
                console.error("error" + error);
            }
        });

    });
</script>
@endsection