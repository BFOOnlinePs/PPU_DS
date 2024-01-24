@if ($reports->isEmpty())
<h6 class="alert alert-danger">{{__('translate.No available data')}} {{-- لا توجد بيانات  --}}</h6>
@else
<div class="card">
    <table class="table table-bordered table-striped" id="students">
            <thead>
                <tr>
                    <th>{{__('translate.Date')}}{{-- التاريخ --}}</th>
                    <th>{{__('translate.Display Report')}} {{-- عرض التقرير --}}</th>
                    <th>كتابة ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>
                            {{date("Y-m-d", strtotime($report->attendance->sa_in_time))}}
                        </td>
                        <td>
                            <button class="btn btn-primary" onclick="openReportModal('{{$report->sr_id}}')"><i class="fa fa-file-text"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-primary mb-2 btn-s" onclick="openNoteModal('{{$report->sr_id}}' , '{{$report->sr_notes_company}}')" type="button"><span class="fa fa-sticky-note"></span></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
