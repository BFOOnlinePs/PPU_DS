<div class="table-responsive" id="showTable">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">اسم المساق</th>
                <th scope="col">رمز المساق</th>
                <th scope="col">ساعات المساق</th>
                <th scope="col">نوع المساق</th>
                <th scope="col"></th>

            </tr>
        </thead>
        <tbody>

            @foreach ($data as $key)
                <tr>
                    <td style="display:none;">{{ $key->c_id }}</td>
                    <td>{{ $key->c_name }}</td>
                    <td>{{ $key->c_course_code }}</td>
                    <td>{{ $key->c_hours }}</td>
                    <td>{{ $key->c_course_type }}</td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <button style="background-color: transparent; border: none;"
                                    onclick="$('#ShowCourseModal').modal('show')"><i
                                        data-feather="external-link"></i></button>
                            </div>
                            <div class="col-md-6">
                                <button style="background-color: transparent; border: none;"
                                    onclick="showEditCourseModal({{ $key }})"><i
                                        data-feather="edit"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
