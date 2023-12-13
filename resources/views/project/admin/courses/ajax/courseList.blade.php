<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">اسم المساق</th>
                <th scope="col">رمز المساق</th>
                <th scope="col">ساعات المساق</th>
                <th scope="col">نوع المساق</th>
                <th scope="col">العمليات</th>

            </tr>
        </thead>
        <tbody>
            @if ($data->isEmpty())
                <tr>
                    <td colspan="5" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
            @else
                @foreach($data as $key)
                    <tr>
                        <td style="display:none;">{{ $key->c_id }}</td>
                        <td>{{ $key->c_name }}</td>
                        <td>{{ $key->c_course_code }}</td>
                        <td>{{ $key->c_hours }}</td>
                        @if( $key->c_course_type == 0) <td>نظري</td>@endif
                        @if( $key->c_course_type == 1) <td>عملي</td>@endif
                        @if( $key->c_course_type == 2) <td>نظري - عملي</td>@endif
                        <td>
                            <button class="btn btn-info" onclick="showCourseModal({{ $key }})"><i class="fa fa-search"></i></button>
                            <button class="btn btn-primary" onclick="showEditCourseModal({{ $key }})"><i class="fa fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
{{-- <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script> --}}
