@extends('layouts.app')
@section('title')
    {{ __('translate.Training Places') }} {{-- أماكن التدريب --}}
@endsection
@section('header_title')
    {{ __('translate.Training Places') }} {{-- أماكن التدريب --}}
@endsection
@section('header_title_link')
    <a href="{{ route('home') }}">{{ __('translate.Main') }}{{-- الرئيسية --}}</a>
@endsection
@section('header_link')
    <a href="{{ route('supervisors.companies.index') }}">{{ __('translate.Training Places') }} {{-- أماكن التدريب --}}</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" onkeyup="list_companies()" class="form-control" id="company_name" placeholder="اسم الشركة">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" onkeyup="list_companies()" class="form-control" id="student_name" placeholder="اسم الطالب">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="user-table">
                        {{-- @include('project.supervisor.companies.tables.companies') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            list_companies();
        })
        function list_companies() {
            $.ajax({
                url: "{{ route('supervisors.companies.list_companies') }}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'student_name': $('#student_name').val(),
                    'company_name': $('#company_name').val(),
                },
                success: function(response) {
                    $('#user-table').html(response.view);
                },
                error: function(error) {
                    alert(error);
                }
            });
        }
    </script>
@endsection
