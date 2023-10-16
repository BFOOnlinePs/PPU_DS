@extends('layouts.app')
@section('title')
    تصنيف الشركات
@endsection
@section('header_title')
    تصنيف الشركات
@endsection
@section('header_title_link')
    الرئيسية
@endsection
@section('header_link')
    تصنيف الشركات
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')

    <div>
        <button class="btn btn-primary  mb-2 btn-s" onclick="$('#AddCompaniesCategoriesModal').modal('show')" type="button"><span
                class="fa fa-plus"></span> إضافة تصنيف الشركات</button>
    </div>

    <div class="card" style="padding-left:0px; padding-right:0px;">
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
                                <th scope="col">تصنيف الشركة</th>
                                <th scope="col">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center"><span>لا توجد بيانات</span></td>
                                </tr>
                                @else
                                @foreach ($data as $key)
                                <tr>
                                    <td>{{ $key->cc_name }}</td>
                                    <td>
                                        <button onclick="editCompaniesCategories({{ $key }})" class="btn btn-info" onclick="showCourseModal({{ $key }})"><i class="fa fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('project.admin.companies_categories.modal.AddCompaniesCategoriesModal')
        @include('project.admin.companies_categories.modal.EditCompaniesCategoriesModal')
        @include('layouts.loader')
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

    <script>
        document.getElementById("CompaniesCategories").addEventListener("submit", (e) => {
            e.preventDefault();
           data =$('#CompaniesCategories').serialize();
           var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#AddCompaniesCategoriesModal').modal('hide');
            $('#LoadingModal').modal('show');
           // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.companies_categories.create') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#LoadingModal').modal('hide');
                    $('#showTable').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error("error"+error);
                }
            });
    });

    function editCompaniesCategories(data){
        $('#EditCompaniesCategoriesModal').modal('show');
        document.getElementById('edit_cc_name').value = data.cc_name;
        document.getElementById('edit_cc_id').value = data.cc_id;
    }

    document.getElementById("EditCompaniesCategories").addEventListener("submit", (e) => {
            e.preventDefault();
           data =$('#EditCompaniesCategories').serialize();
           var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#EditCompaniesCategoriesModal').modal('hide');
            $('#LoadingModal').modal('show');
           // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.companies_categories.update') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#LoadingModal').modal('hide');
                    $('#showTable').html(response.view);
                },
                error: function(xhr, status, error) {
                    console.error("error"+error);
                }
            });
    });

    </script>
@endsection
