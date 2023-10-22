@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مساقات مسجلة</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم الشركة</th>
            <th>الفرع</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $studentCompany)
            <tr>
                <td>{{$studentCompany->sc_company_id}}</td>
                <td>{{$studentCompany->sc_branch_id}}</td>
                <td>
                    <button class="btn btn-danger" onclick="delete_training_place_for_student({{$studentCompany->sc_id}})" type="button">حذف التدريب</button>
                    @if ($studentCompany->sc_agreement_file != null)
                        <a href="{{ asset($studentCompany->sc_agreement_file) }}" class="btn btn-primary" download>تنزيل ملف الموافقة</a>
                        <a class="btn btn-primary" onclick="viewAttachment('{{ asset($studentCompany->sc_agreement_file) }}')">عرض ملف الموافقة</a>
                    @else
                        <form action="your_upload_endpoint" method="post" enctype="multipart/form-data">
                            <label for="agreementFileInput" class="btn btn-primary">
                                إضافة مرفق
                            </label>
                            <input type="file" id="agreementFileInput" name="agreementFile" style="display: none">
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif


