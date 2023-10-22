<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">تصنيف الشركة</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @if ($data->isEmpty())
                <tr>
                    <td colspan="3" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
                @else
                @foreach ($data as $key)
                    <tr>
                        <td>{{ $key->cc_name }}</td>
                        <td>
                            <button class="btn btn-info" onclick="showCourseModal({{ $key }})"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
