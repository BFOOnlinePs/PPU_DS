@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مساقات مسجلة</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم الشركة</th>
            <th>الفرع</th>
            <th>الملف المرفق</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $studentCompany)
            <tr>
                <td>{{$studentCompany->company->c_name}}</td>
                <td>{{$studentCompany->companyBranch->b_address}}</td>
                <td>
                    @if (!empty($studentCompany->sc_agreement_file))
                    <a href="{{ asset($studentCompany->sc_agreement_file) }}" class="btn btn-primary" download>تنزيل ملف الموافقة</a>
                    <a class="btn btn-primary" onclick="viewAttachment('{{ asset($studentCompany->sc_agreement_file) }}')">عرض ملف الموافقة</a>
                    <a  class="btn btn-danger" href="{{route('admin.users.training.place.delete.file_agreement' , ['sc_id' => $studentCompany->sc_id])}}">حذف الملف المرفق</a>
                    @else
                        <form action="{{route('admin.users.training.place.update.file_agreement')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_company_student" value="{{$studentCompany->sc_id}}">
                            <input type="file" name="file_company_student" onchange="this.form.submit()">
                        </form>
                    @endif
                </td>
                <td>
                    <button class="btn btn-danger" onclick="delete_training_place_for_student({{$studentCompany->sc_id}})" type="button">حذف التدريب</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif


