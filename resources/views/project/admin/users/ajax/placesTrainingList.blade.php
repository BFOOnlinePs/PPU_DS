<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('translate.Course')}}{{-- المساق --}}</th>
            <th>{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
            <th>{{__('translate.Branch')}} {{-- الفرع --}}</th>
            <th>حالة التدريب</th>
            <th>{{__('translate.Approval file')}} {{-- ملف الموافقة --}}</th>
            <th>{{__('translate.Operations')}} {{-- العمليات --}}</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center"><span>{{__('translate.No recorded trainings')}} {{-- لا يوجد تدريبات مسجلة --}}</span></td>
            </tr>
        @else
            @foreach($data as $studentCompany)
                <tr>
                    <td>{{$studentCompany->registrations[0]->courses->c_name}}</td>
                    <td>{{$studentCompany->company->c_name}}</td>
                    @if ($studentCompany->sc_branch_id == null)
                        <td></td>
                    @else
                        <td>{{$studentCompany->companyBranch->b_address}}</td>
                    @endif
                    <td>
                        @if ($studentCompany->sc_status == 1)
                            نشط
                        @elseif ($studentCompany->sc_status == 2)
                            منتهي
                        @else
                            محذوف
                        @endif
                    </td>
                    <td>
                        @if (!empty($studentCompany->sc_agreement_file))
                            <a href="{{ asset('storage/uploads/'.$studentCompany->sc_agreement_file) }}" class="btn btn-primary fa fa-download btn-xs"  type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="تنزيل ملف الموافقة" download></a>
                            @php
                                $extension = pathinfo($studentCompany->sc_agreement_file, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extension == 'png' || $extension == 'jpg' || $extension == 'pdf')
                                <a onclick="viewAttachment('{{ asset('storage/uploads/'.$studentCompany->sc_agreement_file) }}')" class="btn btn-primary fa fa-file btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="عرض ملف الموافقة"></a>
                            @endif
                            <a  href="{{route('admin.users.training.place.delete.file_agreement' , ['sc_id' => $studentCompany->sc_id])}}" class="btn btn-danger fa fa-trash btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="حذف ملف الموافقة"></a>
                        @else
                            <div id="progress-container{{$studentCompany->sc_id}}" style="display: none;">
                            <div class="progress">
                                <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar{{$studentCompany->sc_id}}" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span id="progress-text{{$studentCompany->sc_id}}">Uploading...</span>
                            </div>
                            <label for="file_agreement{{$studentCompany->sc_id}}" class="btn btn-primary btn-xs">
                                <i class="fa fa-upload"></i>
                            </label>
                            <input type="file" name="file_company_student" onchange="submitFile(this, {{$studentCompany->sc_id}})" id="file_agreement{{$studentCompany->sc_id}}" style="display: none;">
                        @endif
                    </td>
                    <td>
                        @if ($studentCompany->sc_mentor_trainer_id)
                            @if ($studentCompany->sc_department_id)
                                <button class="btn btn-success btn-xs" onclick="open_edit_modal({{$studentCompany}} , '{{$studentCompany->companyBranch->b_address}}' , {{$studentCompany->sc_status}} , '{{$studentCompany->userMentorTrainer->name}}' , '{{$studentCompany->companyDepartment->d_name}}' , '{{$studentCompany->registrations[0]->courses->c_name}}')" type="button"><span class="fa fa-edit"></span></button>
                            @else
                                <button class="btn btn-success btn-xs" onclick="open_edit_modal({{$studentCompany}} , '{{$studentCompany->companyBranch->b_address}}' , {{$studentCompany->sc_status}} , '{{$studentCompany->userMentorTrainer->name}}' , null , '{{$studentCompany->registrations[0]->courses->c_name}}')" type="button"><span class="fa fa-edit"></span></button>
                            @endif
                        @else
                            @if ($studentCompany->sc_department_id)
                                <button class="btn btn-success btn-xs" onclick="open_edit_modal({{$studentCompany}} , '{{$studentCompany->companyBranch->b_address}}' , {{$studentCompany->sc_status}} , null , '{{$studentCompany->companyDepartment->d_name}}' , '{{$studentCompany->registrations[0]->courses->c_name}}')" type="button"><span class="fa fa-edit"></span></button>
                            @else
                                <button class="btn btn-success btn-xs" onclick="open_edit_modal({{$studentCompany}} , '{{$studentCompany->companyBranch->b_address}}' , {{$studentCompany->sc_status}} , null , null , '{{$studentCompany->registrations[0]->courses->c_name}}')" type="button"><span class="fa fa-edit"></span></button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            @endif
    </tbody>
</table>
