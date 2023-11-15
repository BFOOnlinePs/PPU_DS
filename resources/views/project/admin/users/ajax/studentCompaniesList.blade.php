@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        @if ($student_companies->isEmpty())
            <h6 class="alert alert-danger">لا يوجد شركات مسجل فيها </h6>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>اسم الشركة</th>
                        <th>الفرع</th>
                        <th>الدائرة</th>
                        <th>المدرب المسؤول في الشركة</th>
                        <th>مساعد المشرف في الجامعة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student_companies as $student_company)
                        <tr>
                            <td>{{$student_company->company->c_name}}</td>
                            <td>
                                @if (isset($student_company->companyBranch->b_address))
                                    {{$student_company->companyBranch->b_address}}
                                @endif
                            </td>

                            <td>
                                @if (isset($student_company->companyDepartment->d_name))
                                    {{$student_company->companyDepartment->d_name}}
                                @endif
                            </td>
                            <td>
                                @if (isset($student_company->userMentorTrainer->name))
                                    {{$student_company->userMentorTrainer->name}}
                                @endif
                            </td>
                            <td>
                                @if (isset($student_company->userAssistant->name))
                                    {{$student_company->userAssistant->name}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection







{{--
@if ($student_companies->isEmpty())
    <h6 class="alert alert-danger">لا يوجد شركات مسجل فيها </h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اسم الشركة</th>
                <th>الفرع</th>
                <th>الدائرة</th>
                <th>المدرب المسؤول في الشركة</th>
                <th>مساعد المشرف في الجامعة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student_companies as $student_company)
                <tr>
                    <td>{{$student_company->sc_company_id}}</td>
                    <td>{{$student_company->sc_branch_id}}</td>
                    <td>{{$student_company->sc_department_id}}</td>
                    <td>{{$student_company->sc_mentor_trainer_id}}</td>
                    <td>{{$student_company->sc_assistant_id}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif --}}
