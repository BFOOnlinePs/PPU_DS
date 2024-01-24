@extends('layouts.app')
@section('title')
{{--المستخدمين--}} {{__("translate.Users")}}
@endsection
@section('header_title_link')
{{--المستخدمين--}} {{__("translate.Users")}}
@endsection
@section('header_link')
@endsection
@section('content')
<div class="container-fluid">
    <div class="edit-profile">
        <div class="col-xl-12">
            <form class="card">
                <div class="card-header pb-0">
                    <h4 class="card-title mb-0">{{__('translate.Attendance Logs')}} {{-- سِجل الحضور و المغادرة --}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @include('project.admin.users.modals.loading')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="from-control digits"></label>
                            <select autofocus class="js-example-basic-single col-sm-12" id="sc_id" onchange="function_to_filltering()">
                                @if (isset($student_company->company->c_name))
                                <option value="{{$student_company->sc_id}}"> {{$student_company->company->c_name}} {{__("translate.Address")}} | @if(isset($student_company->companyBranch->b_address))   {{--العنوان--}} : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | {{__('translate.Section')}} {{-- القسم --}} : {{$student_company->companyDepartment->d_name}} @endif</option>
                                <option value="">{{--جميع الشركات--}} {{__("translate.All Companies")}}</option>
                                @foreach ($student_companies as $student_company)
                                <option value="{{$student_company->sc_id}}">{{$student_company->company->c_name}} @if (isset($student_company->companyBranch->b_address)) | {{__("translate.Address")}} {{--العنوان--}}  : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | {{__('translate.Section')}} {{-- القسم --}} : {{$student_company->companyDepartment->d_name}} @endif</option>
                                @endforeach
                                @else
                                <option value="">{{--جميع الشركات--}} {{__("translate.All Companies")}}</option>
                                @foreach ($student_companies as $student_company)
                                <option value="{{$student_company->sc_id}}">{{$student_company->company->c_name}} @if (isset($student_company->companyBranch->b_address)) | {{__("translate.Address")}} {{--العنوان--}}  : {{$student_company->companyBranch->b_address}} @endif @if (isset($student_company->companyDepartment->d_name)) | {{__('translate.Section')}} {{-- القسم --}} : {{$student_company->companyDepartment->d_name}} @endif</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3">
                                <label class="from-control digits">{{__('translate.From:')}}{{-- من --}}</label>
                                <input type="date" class="form-control digits" id="from" onchange="function_to_filltering()">
                            </div>
                            <div class="col-md-3">
                                <label class="from-control digits">{{__('translate.To:')}}{{-- إلى --}}</label>
                                <input type="date" class="form-control digits" id="to" onchange="function_to_filltering()">
                            </div>
                        </div>
                    <hr style="background: white">
                    <div class="row" id="error" style="display: none">
                        <h6 class="alert alert-danger">{{__('translate.No data to display')}}{{-- لا يوجد سجلات لعرضها --}}</h6>
                    </div>
                    <div class="row" id="content">
                        @include('project.student.attendance.ajax.attendanceList')
                    </div>
                </div>
            </form>
            @include('project.student.attendance.ajax.loading')
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
    <script>
        function function_to_filltering()
        {
            let sc_id = $('#sc_id').val();
            let from = $('#from').val();
            let to = $('#to').val();
            $.ajax({
                url: "{{ route('students.attendance.ajax_company_from_to') }}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    document.getElementById('loading').style.display = '';
                },
                data: {
                    'sc_id': sc_id,
                    'from': from,
                    'to': to
                },
                success: function (data) {
                    if(data.html == '') {
                        document.getElementById('error').style.display = '';
                        document.getElementById('content').style.display = 'none';
                        document.getElementById('loading').style.display = 'none';
                    }
                    else {
                        document.getElementById('error').style.display = 'none';
                        document.getElementById('content').style.display = '';
                        $('#content').html(data.html);
                        document.getElementById('loading').style.display = 'none';
                    }
                },
                error: function (xhr, status, error) {
                    document.getElementById('loading').style.display = 'none';
                }
            });
        }
        // Put 1 / 1 / current_year in input from
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const defaultDateString = `${currentYear}-01-01`;
        document.getElementById('from').value = defaultDateString;

        // Put current date in input to
        const today = new Date();
        const formattedDate = today.toISOString().slice(0, 10);
        document.getElementById('to').value = formattedDate;
    </script>
@endsection
