@extends('layouts.app')
@section('title')
{{--المستخدمين--}} {{__("translate.Users")}}
@endsection
@section('header_title_link')
{{--المستخدمين--}} {{__("translate.Users")}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection
@section('header_link')
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
                @include('project.company_manager.students.includes.studentsList')
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script>
    $(document).ready(function() {
        let table = $('#students').DataTable();
    });
</script>
@endsection

