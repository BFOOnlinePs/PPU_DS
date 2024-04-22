@extends('layouts.app')
@section('title')
    {{__('translate.files')}}{{-- الرئيسية --}}
@endsection
@section('header_title')
    {{__('translate.files')}}{{-- الرئيسية --}}
@endsection
@section('header_title_link')
    <a href="{{route('home')}}">{{__('translate.Main')}}{{-- الرئيسية --}}</a>
@endsection
@section('header_link')
    <a href="{{route('home')}}">{{__('translate.Main')}}{{-- الرئيسية --}}</a>
@endsection
@section('style')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button data-bs-toggle="modal" data-bs-target="#add_attachment_modal" class="btn btn-primary">{{ __('translate.add_file') }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>{{ __('translate.file') }}</th>
                                            <th>{{ __('translate.Notes') }}</th>
                                            <th>
                                                {{ __('translate.Operations') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">لا توجد بيانات</td>
                                            </tr>
                                        @else
                                            @foreach($data as $key)
                                                <tr>
                                                    <td>
                                                        <a href="{{ asset('storage/monitor_trainer/'. $key->mea_file ) }}" target="_blank">{{ $key->mea_file }}</a>
                                                    </td>
                                                    <td>{{ $key->mea_description }}</td>
                                                    <td>
                                                        <button onclick="add_version_model({{ $key->mea_id }})" class="btn btn-sm btn-success"><span class="fa fa-file"></span></button>
                                                        <button onclick="list_versions_modal({{ $key->versions }})" class="btn btn-sm btn-dark"><span class="fa fa-search"></span></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('project.monitor_evaluation.files.modals.add_attchment_model')
        @include('project.monitor_evaluation.files.modals.add_version_model')
        @include('project.monitor_evaluation.files.modals.list_versions_modal')
    </div>
@endsection
@section('script')
    <script>
        function add_version_model(mea_attachment_id) {
            $('#add_version_model').modal('show');
            $('#mea_attachment_id').val(mea_attachment_id);
        }
        function list_versions_modal(versions) {
            $('#list_versions_modal').modal('show');
            var file_table = $('#file_table');
            file_table.empty();
            if (versions.length === 0) {
                file_table.append(`
        <tr>
            <td colspan="3" class="text-center">لا توجد بيانات</td>
        </tr>
    `);
            } else {
                $.each(versions, function(index, value) {
                    src = '{{ asset('storage/files') }}' + '/' + value.mea_file;
                    file_table.append(`
            <tr>
                <td>
                    <a target="_blank" href="${src}">${src}</a>
                </td>
                <td>${value.mea_description}</td>
                <td>${value.created_at}</td>
            </tr>
        `);
                });
            }
        }
    </script>
@endsection
