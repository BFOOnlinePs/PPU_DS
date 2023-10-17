@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مساقات مسجلة</h6>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم المساق</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key)
            <tr id="user-row-{{$key->c_id}}">
                <td>{{$key->c_name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
