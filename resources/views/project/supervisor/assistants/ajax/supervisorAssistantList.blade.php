@if ($supervisorAssistants->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مساعدين إداريين لهذا المشرف</h6>
@else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{__('translate.Name of the Administrative Assistant')}}{{-- اسم المساعد الإداري --}}</th>
                @if (auth()->user()->u_role_id == 1)
                    <th>
                        {{__('translate.Delete the administrative assistant for this supervisor')}} {{-- حذف المساعد الإداري لهذا المشرف --}}
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($supervisorAssistants as $assistant)
                <tr>
                    <td>{{$assistant->assistantUser->name}}</td>
                    @if (auth()->user()->u_role_id == 1)
                        <th>
                            <button class="btn btn-lg" onclick="showAlertDelete({{$assistant->sa_id}})" type="button"><span class="fa fa-trash "></span></button>
                        </th>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

