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
            <div class="card">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>اسم الشركة</th>
                            <th>الفرع</th>
                            <th>الدائرة</th>
                            <th>المدرب المسؤول في الشركة</th>
                            <th>مساعد المشرف في الجامعة</th>
                            <th>سجل الحضور والمغادرة</th>
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
                                <td><a href="{{route('students.company.attendance.index_for_specific_student' , ['id' => $student_company->sc_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-check"></span></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

