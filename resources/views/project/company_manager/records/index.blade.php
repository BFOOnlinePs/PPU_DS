@extends('layouts.app')
@section('title')
المستخدمين
@endsection
@section('header_title_link')
المستخدمين
@endsection
@section('header_link')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title mb-0">سِجل المتابعة لجميع متدربي الشركة</h4>
            </div>
            <div class="row card-body">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="searchByName">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control digits" id="from">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control digits" id="to">
                </div>
            </div>
            <div id="error" style="display: none">
                <h6 class="alert alert-danger">لا يوجد سجلات لعرضها</h6>
            </div>
            <div class="card-body" id="content">
                @include('project.company_manager.records.includes.recordsList')
            </div>
        </div>
        @include('project.company_manager.students.reports.modals.reportModal')
    </div>
    @include('project.student.attendance.ajax.loading')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            let nextPageUrl = "{{route('company_manager.records.search')}}";
            loadMoreRecords();
            // Function to load more records
            function loadMoreRecords(searchByName = null) {
                let from = $('#from').val();
                let to = $('#to').val();
                $.ajax({
                    url: nextPageUrl,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function () {
                        nextPageUrl = '';
                        document.getElementById('loading').style.display = '';
                    },
                    data: {
                        'searchByName': searchByName,
                        'from': from,
                        'to': to
                    },
                    success: function (data) {
                        nextPageUrl = data.nextPageUrl;
                        if(data.html == '') {
                            document.getElementById('error').style.display = '';
                            document.getElementById('content').style.display = 'none';
                            document.getElementById('loading').style.display = 'none';
                        }
                        else {
                            document.getElementById('error').style.display = 'none';
                            document.getElementById('content').style.display = '';
                            $('table tbody').append(data.html);
                            document.getElementById('loading').style.display = 'none';
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error loading more student attendances:", error);
                        document.getElementById('loading').style.display = 'none';
                    }
                });
            }
            document.getElementById('searchByName').addEventListener('keyup', function(event) {
                $('table tbody').empty();
                nextPageUrl = "{{ route('company_manager.records.search') }}";
                loadMoreRecords(this.value);
            });
            $('#to, #from').change(function () {
                // Your action when the date changes goes here
                $('table tbody').empty();
                nextPageUrl = "{{ route('company_manager.records.search') }}";
                loadMoreRecords();
            });
            // Scroll event listener for loading more data
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                    if (nextPageUrl) {
                        loadMoreRecords();
                    }
                }
            });
        });
        function openReportModal(report_sr_id) {
            document.getElementById('report_sr_id').value = report_sr_id;
            $.ajax({
                beforeSend: function(){
                },
                url: "{{route('company_manager.students.reports.showReport')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'report_sr_id' : report_sr_id,
                },
                success: function(response) {
                    document.getElementById('sr_report_text').value = response.sr_report_text;
                    if(response.sr_attached_file != null){
                        document.getElementById('sr_attached_file').href = `{{asset('storage/student_reports/${response.sr_attached_file}')}}`;
                        document.getElementById('sr_attached_file').style.display = '';
                    }
                },
                complete: function(){

                },
                error: function(jqXHR) {

                }
            });
            $('#StudentReportModal').modal('show');
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

