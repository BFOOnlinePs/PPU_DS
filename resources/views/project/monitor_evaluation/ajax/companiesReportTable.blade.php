<div id="companiesReportTable">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" style="display:none;">id</th>
                    <th scope="col">{{__('translate.Company name')}} {{-- اسم الشركة --}}</th>
                    <th scope="col">{{__('translate.Company Manager')}}{{-- مدير الشركة --}}</th>
                    <th scope="col">{{__('translate.Company Category')}}{{-- تصنيف الشركة --}}</th>
                    <th scope="col">{{__('translate.Company Type')}}{{-- نوع الشركة --}}</th>
                    <th scope="col">إجمالي الطلاب</th>

                </tr>
            </thead>
            <tbody>
            @if ($data->isEmpty())
                <tr>
                    <td colspan="6" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
            @else
                @foreach ($data as $key)
                    <tr>
                        <td style="display:none;">{{ $key->c_id }}</td>
                        <td>{{ $key->c_name }}</td>
                        <td>{{ $key->manager->name }}</td>
                        <td>{{ $key->companyCategories->cc_name}}</td>
                        @if( $key->c_type == 1) <td>{{__('translate.Public Sector')}}{{-- قطاع عام --}}</td>@endif
                        @if( $key->c_type == 2) <td>{{__('translate.Private Sector')}}{{-- قطاع خاص --}}</td>@endif
                        <td>
                          {{$key->studentsTotal}}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
