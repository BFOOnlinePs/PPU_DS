<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">{{ __('translate.Company Name') }}</th>
                <th scope="col">{{ __('translate.Company Manager') }}</th>
                <th scope="col">{{ __('translate.Company Category') }}</th>
                <th scope="col">الطاقة الاستيعابية</th>
                <th scope="col">حالة الشركة</th>
                <th scope="col" style="width: 200px">{{ __('translate.Operations') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($data->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">
                        <span>{{ __('translate.No data to display') }}</span>
                    </td>
                </tr>
            @else
                @foreach ($data as $key)
                    <tr>
                        <td style="display:none;">{{ $key->c_id }}</td>

                        {{-- اسم الشركة --}}
                        <td>
                            @if ($key->manager)
                                <a href="{{ route('admin.users.details', ['id' => $key->manager->u_id]) }}">
                                    {{ app()->isLocale('en') || (app()->isLocale('ar') && empty($key->c_name)) ? $key->c_english_name : $key->c_name }}
                                </a>
                            @else
                                {{ app()->isLocale('en') ? ($key->c_english_name ?? 'No name') : ($key->c_name ?? 'لا يوجد اسم') }}
                            @endif
                        </td>

                        {{-- مدير الشركة --}}
                        @if (auth()->user()->u_role_id == 1)
                            <td>
                                @if ($key->manager)
                                    <a href="{{ route('admin.users.details', ['id' => $key->manager->u_id]) }}">
                                        {{ $key->manager->name ?? 'لا يوجد مدير' }}
                                    </a>
                                @else
                                    <span class="text-danger">لا يوجد مدير</span>
                                @endif
                            </td>
                        @else
                            <td>{{ $key->manager->name ?? 'لا يوجد مدير' }}</td>
                        @endif

                        {{-- تصنيف الشركة --}}
                        <td>
                            @if ($key->companyCategories)
                                <a href="{{ route('admin.companies_categories.index') }}">
                                    {{ $key->companyCategories->cc_name ?? __('translate.Unspecified') }}
                                </a>
                            @else
                                {{ __('translate.Unspecified') }}
                            @endif
                        </td>

                        {{-- الطاقة الاستيعابية --}}
                        <td>
                            <input type="text" onchange="update_capacity_ajax({{ $key->c_id }},this.value)"
                                class="form-control" value="{{ $key->c_capacity ?? '' }}" placeholder="">
                        </td>

                        {{-- حالة الشركة --}}
                        <td>
                            <label class="switch">
                                <input onchange="update_company_status({{ $key->c_id }},this.checked)"
                                    type="checkbox" @if ($key->c_status == 1) checked @endif>
                                <span class="switch-state"></span>
                            </label>
                        </td>

                        {{-- العمليات --}}
                        <td>
                            <div class="dropdown">
                                <span data-feather="more-vertical">العمليات</span>
                                <div class="dropdown-content">
                                    <button class="btn btn-dark btn-sm form-control m-1">
                                        <a class="text-white" style="cursor: pointer; font-size: 10px"
                                           href="{{ route('admin.companies.edit2', ['id' => $key->c_id]) }}">
                                            تعديل
                                        </a>
                                    </button>
                                    <button class="btn btn-dark btn-sm form-control m-1">
                                        <a class="text-white" style="cursor: pointer; font-size: 10px"
                                           onclick='location.href="{{ route('admin.companies.edit', ['id' => $key->c_id]) }}"'>
                                            تفاصيل الشركة
                                        </a>
                                    </button>
                                    <button class="btn btn-dark btn-sm form-control m-1">
                                        <a class="text-white" style="cursor: pointer; font-size: 10px"
                                           onclick='show_student_nomination_modal(@json($key))'>
                                            اقتراحات الطلاب
                                        </a>
                                    </button>
                                    <button class="btn btn-dark btn-sm form-control m-1">
                                        <a class="text-white" style="cursor: pointer; font-size: 10px"
                                           onclick='addAttachmentModal({{ $key->c_id }})'>
                                            اضافة اتفاقية
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
