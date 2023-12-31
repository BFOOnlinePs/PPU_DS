<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم المشرف الأكاديمي</th>
            <th>حذف المشرف الأكاديمي</th>
        </tr>
    </thead>
    <tbody>
        @if ($supervisors_assistant->isEmpty())
            <tr>
                <td colspan="4" class="text-center"><span>لا يوجد مشرفيين أكادميين لهذا المساعد الإداري</span></td>
            </tr>
        @else
            @foreach($supervisors_assistant as $key)
                <tr>
                    <td>{{$key->supervisorUser->name}}</td>
                    <td>
                        <button class="btn btn-lg" onclick="confirm_delete_supervisor({{$key->sa_id}})" type="button"><span class="fa fa-trash "></span></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
