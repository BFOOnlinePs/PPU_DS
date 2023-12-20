@if ($data->isEmpty())
    <h6 class="alert alert-danger">لا يوجد مساقات مسجلة</h6>
@else

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>اسم المساق</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $registration)
            <tr>
                <td>{{$registration->courses->c_name}}</td>
                <td><button class="btn btn-danger" onclick="delete_course_for_student({{$registration->r_course_id}})" type="button"><span class="fa fa-trash"></span></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script>
    function add_course()
    {
        data = $('#addCoursesStudentForm').serialize();
        $.ajax({
                beforeSend: function(){
                    $('#AddCoursesStudentModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.users.courses.student.add')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'data' : data ,
                    'id' : id
                },
                success: function(response) {
                    $('#AddCoursesStudentModal').modal('hide');
                    $('#content').html(response.html);
                    $('#add_courses_student').html(response.modal);
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(jqXHR) {
                    alert(jqXHR.responseText);
                    alert('Error fetching user data.');
                }
            });
    }
</script>
