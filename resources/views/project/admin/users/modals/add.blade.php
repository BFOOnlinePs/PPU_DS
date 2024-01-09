<div class="modal fade show" id="AddUserModal"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header" style="height: 73px;">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close" onclick="close_add_modal()"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3 m-5">
                        <div class="col-md-4 text-center" >
                            <h1><span class="fa fa-user-plus" style="text-align: center; font-size:80px; "></span></h1>
                            <h1 id="title_modal_add_user">
                                {{__('translate.Add')}} {{-- إضافة --}}
                                @if ($role_name == 'أدمن')
                                    {{__('translate.Administrator')}} {{-- أدمن --}}
                                @elseif($role_name == 'طالب')
                                    {{__('translate.Student')}} {{-- طالب --}}
                                @elseif($role_name == 'مشرف أكاديمي')
                                    {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                                @elseif($role_name == 'مساعد إداري')
                                    {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                                @elseif($role_name == 'مسؤول متابعة وتقييم')
                                    {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
                                @elseif($role_name == 'مدير شركة')
                                    {{__('translate.Company manager')}} {{-- مدير شركة --}}
                                @elseif($role_name == 'مسؤول تدريب')
                                {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                                @endif
                            </h1>
                            <hr>
                            <p id="p_modal_add_user">
                                {{__('translate.In this section, you can add')}} {{-- في هذا القسم يمكنك إضافة --}}
                                @if (app()->getLocale() == 'en')
                                    {{__('translate.new')}} {{-- جديد --}}
                                @endif
                                @if ($role_name == 'أدمن')
                                    {{__('translate.Administrator')}} {{-- أدمن --}}
                                @elseif($role_name == 'طالب')
                                    {{__('translate.Student')}} {{-- طالب --}}
                                @elseif($role_name == 'مشرف أكاديمي')
                                    {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                                @elseif($role_name == 'مساعد إداري')
                                    {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                                @elseif($role_name == 'مسؤول متابعة وتقييم')
                                    {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
                                @elseif($role_name == 'مدير شركة')
                                    {{__('translate.Company manager')}} {{-- مدير شركة --}}
                                @elseif($role_name == 'مسؤول تدريب')
                                    {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                                @endif
                                @if (app()->getLocale() == 'ar')
                                    {{__('translate.new')}} {{-- جديد --}}
                                @endif
                                </p>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal" id="addUserForm" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <input type="hidden" id='u_role_id' name="u_role_id" value="{{$u_role_id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label" for="textinput">{{__('translate.Name')}}* {{-- الاسم --}} </label>
                                            <div class="col-lg-12">
                                                <input id="name" name="name" type="text" class="form-control btn-square input-md" tabindex="1" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">{{__('translate.Username')}}* {{-- اسم المستخدم --}} </label>
                                            <div class="col-lg-12">
                                                <input id="u_username" name="u_username" type="text" class="form-control btn-square input-md" tabindex="4" required onblur="check_email_not_duplicate()">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">{{__('translate.Password')}}* {{-- كلمة المرور --}} </label>
                                            <div class="col-lg-12">
                                                <input id="password" name="password" type="password" class="form-control btn-square input-md" tabindex="7" required pattern=".{8,}">
                                            </div>
                                        </div>
                                        @if ($u_role_id == 2)
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="selectbasic"> {{__('translate.Major')}} {{-- التخصص --}}</label>
                                                <div class="col-lg-12">
                                                    <select autofocus class="js-example-basic-single col-sm-12" id="u_major_id" name="u_major_id" tabindex="10" required>
                                                        <option value=""></option>
                                                        @foreach ($major as $item)
                                                            <option value="{{$item->m_id}}">{{$item->m_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">{{__('translate.Birth date')}}* {{-- تاريخ الميلاد --}}</label>
                                            <div class="col-lg-12">
                                                <input id="u_date_of_birth" name="u_date_of_birth" type="date" class="form-control btn-square input-md" tabindex="2" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">{{__('translate.Email')}}* {{-- البريد الإلكتروني --}}</label>
                                            <div class="col-lg-12">
                                                <input @if ($u_role_id >= 1 && $u_role_id <= 5) id="email" @endif name="email" type="email" class="form-control btn-square input-md" tabindex="5" required onblur="check_email_not_duplicate()">
                                                <label for="" id="email_duplicate_message" style="color: red; display:none;"> {{__('translate.The email already exists')}} {{-- البريد الإلكتروني موجود بالفعل --}}</label>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label" for="textinput"> {{__('translate.Home address')}} {{-- عنوان السكن --}}</label>
                                            <div class="col-lg-12">
                                                <input id="u_address" name="u_address" type="text" class="form-control btn-square input-md" tabindex="8">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput">{{__('translate.Phone number')}}*  {{-- رقم الجوال --}}</label>
                                            <div class="col-lg-12">
                                                <input id="u_phone1" name="u_phone1" type="text" class="form-control btn-square input-md" tabindex="3" required pattern="[0-9]{10}" minlength="10" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-12 form-label " for="textinput"> {{__('translate.Reserve phone number')}} {{-- رقم جوال احتياطي --}}</label>
                                            <div class="col-lg-12">
                                                <input id="u_phone2" name="u_phone2" type="text" class="form-control btn-square input-md" tabindex="6" pattern="[0-9]{10}" minlength="10" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="form-group m-t-15 custom-radio-ml">
                                                <label class="form-label">{{__('translate.Gender')}}* {{-- الجنس --}}</label>
                                                <div class="radio radio-primary">
                                                    <input id="male" type="radio" name="u_gender" value="0" tabindex="9" checked>
                                                    <label for="male" style="padding-right: 2px">{{__('translate.Male')}} {{-- ذكر --}}</label>
                                                    <input id="female" type="radio" name="u_gender" value="1" style="margin: 10px;">
                                                    <label for="female" style="padding-right: 2px">{{__('translate.Female')}} {{-- أنثى --}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="error-container">

                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" id="button_add_user_in_modal">
                        {{__('translate.Add')}} {{-- إضافة --}}
                        @if ($role_name == 'أدمن')
                            {{__('translate.Administrator')}} {{-- أدمن --}}
                        @elseif($role_name == 'طالب')
                            {{__('translate.Student')}} {{-- طالب --}}
                        @elseif($role_name == 'مشرف أكاديمي')
                            {{__('translate.Academic supervisor')}} {{-- مشرف أكاديمي --}}
                        @elseif($role_name == 'مساعد إداري')
                            {{__('translate.Supervisor assistant')}} {{-- مساعد إداري --}}
                        @elseif($role_name == 'مسؤول متابعة وتقييم')
                            {{__('translate.Monitoring and evaluation officer')}} {{-- مسؤول متابعة وتقييم --}}
                        @elseif($role_name == 'مدير شركة')
                            {{__('translate.Company manager')}} {{-- مدير شركة --}}
                        @elseif($role_name == 'مسؤول تدريب')
                            {{__('translate.Training officer')}} {{-- مسؤول تدريب --}}
                        @elseif($role_name == 'مسؤول التواصل مع الشركات')
                            {{__('translate.Communications manager with companies')}} {{-- مسسؤول التواصل مع الشركات --}}
                        @endif
                    </button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="close_add_modal()">
                        {{__('translate.Cancel')}} {{-- إلغاء --}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
