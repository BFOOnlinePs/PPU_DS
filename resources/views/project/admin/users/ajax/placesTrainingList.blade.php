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
                            <a href="{{ asset($studentCompany->sc_agreement_file) }}" class="btn btn-primary fa fa-download custom-btn"  type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="تنزيل ملف الموافقة" download></a>
                            <a onclick="viewAttachment('{{ asset($studentCompany->sc_agreement_file) }}')" class="btn btn-primary fa fa-file custom-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض ملف الموافقة"></a>
                            <a  href="{{route('admin.users.training.place.delete.file_agreement' , ['sc_id' => $studentCompany->sc_id])}}" class="btn btn-danger fa fa-trash custom-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="حذف ملف الموافقة"></a>
                        @else
                            <input type="file" name="file_company_student" onchange="submitFile(this, {{$studentCompany->sc_id}})">
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


