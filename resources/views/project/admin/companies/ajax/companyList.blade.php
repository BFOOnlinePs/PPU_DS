<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">اسم الشركة</th>
                <th scope="col">مدير الشركة</th>
                <th scope="col">نوع الشركة</th>
                <th scope="col">تصنيف الشركة</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>

        @foreach ($data as $key)
            <tr>
                <td style="display:none;">{{ $key->c_id }}</td>
                <td>{{ $key->c_name }}</td>
                <td>{{ $key->manager->name }}</td>
                <td>{{ $key->companyCategories->cc_name}}</td>
                @if( $key->c_type == 1) <td>قطاع عام</td>@endif
                @if( $key->c_type == 2) <td>قطاع خاص</td>@endif
                <td>
                    <button class="btn btn-info" onclick=""><i class="fa fa-search"></i></button>
                    <button class="btn btn-primary" onclick=""><i class="fa fa-edit"></i></button>
                </td>
            </tr>
        @endforeach

    </tbody>
    </table>
</div>