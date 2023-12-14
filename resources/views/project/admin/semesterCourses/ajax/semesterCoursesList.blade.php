<div id="showTable">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" style="display:none;">id</th>
                    <th scope="col"> العام الدراسي</th>
                    <th scope="col"> الفصل</th>
                    <th scope="col">اسم المساق</th>
                    <th scope="col">كود المساق</th>
                    <th scope="col">ساعات المساق</th>
                    <th scope="col">نوع المساق</th>
                    <th scope="col"> العمليات </th>
                </tr>
            </thead>
            <tbody>

            @if ($data->isEmpty())
                <tr>
                    <td colspan="7" class="text-center"><span>لا توجد بيانات</span></td>
                </tr>
            @else
                @foreach ($data as $key)
                    <tr>
                        <td style="display:none;">{{ $key->sc_id }}</td>
                        <td>{{ $key->sc_year }}</td>
                        @if( $key->sc_semester == 1) <td>أول</td>@endif
                        @if( $key->sc_semester == 2) <td>ثاني</td>@endif
                        @if( $key->sc_semester == 3) <td>صيفي</td>@endif
                        <td>{{ $key->courses->c_name }}</td>

                        <td>{{ $key->courses->c_course_code }}</td>
                        <td>{{ $key->courses->c_hours }}</td>
                        @if( $key->courses->c_course_type == 0) <td>نظري</td>@endif
                        @if( $key->courses->c_course_type == 1) <td>عملي</td>@endif
                        @if( $key->courses->c_course_type == 2) <td>نظري - عملي</td>@endif

                        <td>
                            @if($key->sc_semester == $semester && $key->sc_year == $year)
                                    <button class="btn btn-danger" onclick="showDeleteCourseModal({{ $key }})"><i class="fa fa-trash"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
        </table>
    </div>
</div>
