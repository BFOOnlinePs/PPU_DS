<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>{{__('translate.Company Name')}} {{-- اسم الشركة --}}</th>
        <th>{{__('translate.capacity')}}</th>
        <th>{{--الطلاب في هذه الشركة--}} {{__("translate.Company's Interns")}}</th>
        <th>{{__("translate.number_of_registered_students")}}</th>
    </tr>
    </thead>
    <tbody>
    @if ($data->isEmpty())
        <tr>
            <td colspan="4" class="text-center"><span>{{__('translate.No data to display')}}{{--لا توجد بيانات--}}</span></td>
        </tr>
    @else
        @foreach ($data as $students_company)
            <tr>
                {{-- <td>{{$students_company->company->c_name}}</td> --}}
                <td @if(empty($students_company->company->c_status)) @if($students_company->c_status == 0) class="bg-danger" @endif @else class="bg-danger" @endif>
                    @if(app()->isLocale('en') || (app()->isLocale('ar') && empty($key->c_name)))
                        <a @if(empty($students_company->company->c_status)) @if($students_company->c_status == 0) class="text-white" @endif @else class="text-white" @endif href="{{route("admin.companies.edit",['id'=>$students_company->company->c_id ?? $students_company->c_id])}}">{{$students_company->company->c_english_name ?? $students_company->c_english_name}}</a>
                    @elseif(app()->isLocale('ar') || (app()->isLocale('en') && empty($key->c_english_name)))
                        <a @if(empty($students_company->company->c_status)) @if($students_company->c_status == 0) class="text-white" @endif @else class="text-white" @endif href="{{route("admin.companies.edit",['id'=>$students_company->company->c_id ?? $students_company->c_id])}}">{{$students_company->company->c_name}}</a>
                    @endif
                </td>
                <td>
                    {{ $students_company->company->c_capacity ?? $students_company->c_capacity }}
                </td>
                <td>
{{--                    <a href="{{route('communications_manager_with_companies.companies.students' , ['id'=>$students_company->sc_company_id])}}" class="btn btn-primary btn-xs"><span class="fa fa-users"></span></a>--}}
                    @foreach($students_company->users as $key)
                        {{ $key->name }},
                    @endforeach
                </td>
                <td>
                     {{ $students_company->count }}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

