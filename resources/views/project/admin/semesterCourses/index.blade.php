@extends('layouts.app')
@section('title')
    مساقات الفصول
@endsection
@section('header_title')
    مساقات الفصول
@endsection
@section('header_title_link')
    مساقات الفصول
@endsection
@section('header_link')
    مساقات الفصل الحالي
@endsection

@section('style')

@endsection

@section('content')


<div>
    <button id="openModal" class="btn btn-primary  mb-2 btn-s" onclick="$('#AddCourseToSemesterModal').modal('show')" type="button"><span class="fa fa-plus"></span>{{__('translate.Add course to current semester')}}{{-- إضافة مساق إلى الفصل الحالي --}}</button>
</div>

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >
            {{-- <div class="form-outline col-md-2">
                <input type="search" onkeyup="courseSearch(this.value)" class="form-control mb-2" placeholder="البحث" aria-label="Search" />
            </div> --}}
            <form id="searchForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">



                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Semester')}}{{-- الفصل الدراسي --}}</label>
                            {{-- <input class="form-control" id="semester" name="semester"> --}}
                            <div class="col-lg-12">
                                <select id="semester" name="semester" class="form-control btn-square">
                                    <option value="0">{{__('translate.All semesters')}}{{-- جميع الفصول --}}</option>
                                    <option value="1" @if($semester==1) selected @endif>{{__('translate.First')}}{{-- أول --}}</option>
                                    <option value="2" @if($semester==2) selected @endif>{{__('translate.Second')}}{{-- ثاني --}}</option>
                                    <option value="3" @if($semester==3) selected @endif>{{__('translate.Summer')}}{{-- صيفي --}}</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="col-form-label pt-0" for="exampleInputEmail1">{{__('translate.Academic year')}}{{-- العام الدراسي --}}</label>
                            <div class="col-lg-12">
                                <select id="year" name="year" class="form-control btn-square">
                                    <option value="0">جميع الأعوام</option>
                                    @foreach($years as $key)
                                    <option value={{$key}} @if($key == $year) selected @endif> {{$key}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 d-flex justify-content-center">
                        <div class="form-group">
                            <div style="margin-top:27px;" style="width: 100%">
                            <button class="btn btn-info  mb-2 btn-s" style="width: 120px" type="submit">{{__('translate.Search')}} {{-- بحث --}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="mb-3">
                <input class="form-control" onkeyup="courseNameSearch(this.value)" id="courseName" name="courseName" placeholder="{{__('translate.Search for course name')}}"> {{-- البحث عن اسم المساق --}}
            </div>

        <div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col"> {{__('translate.Academic year')}}{{-- العام الدراسي --}}</th>
                            <th scope="col">{{__('translate.Term')}}{{-- الفصل --}}</th>
                            <th scope="col">{{__('translate.Course name')}} {{-- اسم المساق --}}</th>
                            <th scope="col">{{__('translate.Course code')}}{{-- رمز المساق --}}</th>
                            <th scope="col">{{__('translate.Course hours')}}{{-- ساعات المساق --}}</th>
                            <th scope="col">{{__('translate.Course type')}}{{-- نوع المساق --}}</th>
                            <th scope="col">{{__('translate.Operations')}} {{--  العمليات --}}</th>
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
                                @if( $key->sc_semester == 1) <td>{{__('translate.First')}}{{-- أول --}}</td>@endif
                                @if( $key->sc_semester == 2) <td>{{__('translate.Second')}}{{-- ثاني --}}</td>@endif
                                @if( $key->sc_semester == 3) <td>{{__('translate.Summer')}}{{-- صيفي --}}</td>@endif
                                <td>{{ $key->courses->c_name }}</td>

                                <td>{{ $key->courses->c_course_code }}</td>
                                <td>{{ $key->courses->c_hours }}</td>
                                @if( $key->courses->c_course_type == 0) <td>{{__('translate.Theoretical')}} {{-- نظري --}}</td>@endif
                                @if( $key->courses->c_course_type == 1) <td>{{__('translate.Practical')}} {{-- عملي --}}</td>@endif
                                @if( $key->courses->c_course_type == 2) <td>{{__('translate.Theoretical - Practical')}} {{-- نظري - عملي --}}</td>@endif


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



    </div>

    @include('project.admin.semesterCourses.modals.addCourseToSemesterModal')
    @include('layouts.loader')
    @include('project.admin.semesterCourses.modals.deleteConfirmationModal')




</div>


@endsection
@section('script')
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

<script>

    let addCourseToSemesterForm = document.getElementById("addCourseToSemesterForm");
    let searchForm = document.getElementById("searchForm");
    let semesterCourseID;

    addCourseToSemesterForm.addEventListener("submit", (e) => {
            e.preventDefault();


            //data = $('#addCourseToSemesterForm').serialize();
            var courses = $('#selectedCourses').val();
            //console.log(values);
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                beforeSend: function(){
                    $('#AddCourseToSemesterModal').modal('hide');
                    //$('#selectedCourses').empty();
                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.semesterCourses.create') }}",
                data: { coursesList: courses },
                dataType: 'json',
                success: function(response) {
                    // $('#AddCourseToSemesterModal').modal('hide');
                    $('#showTable').html(response.view);
                    $('#selectedCourses').empty();
                    $('#selectedCourses').html(response.modal);
                    //$('#selectedCourses').empty().append('@foreach($course as $key)<option value="{{$key->c_id}}">{{$key->c_name}}</option>@endforeach');
                    // document.getElementById('selectedCourses').val = "";
                    //alert(response.data)
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');

                },
                error: function(xhr, status, error) {
                    alert("nooo");
                    console.error(xhr.responseText);
                }
            });

    });

    function showDeleteCourseModal(data) {
        semesterCourseID = data.sc_id;
        $('#deleteModal').modal('show');
    }

    function deleteCourse(){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Send an AJAX request
            $.ajax({
                beforeSend: function(){
                    $('#deleteModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                type: 'POST',
                url: "{{ route('admin.semesterCourses.delete') }}",
                data: { semesterCourse: semesterCourseID },
                dataType: 'json',
                success: function(response) {
                    //$('#AddCourseToSemesterModal').modal('hide');
                    $('#showTable').html(response.view);
                    $('#selectedCourses').empty();
                    $('#selectedCourses').html(response.modal);
                    //alert(response.data)
                    //document.getElementById('selectedCourses').val = "";
                },
                complete: function(){
                    $('#LoadingModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    alert("nooo");
                    console.error(xhr.responseText);
                }
            });
    }


    searchForm.addEventListener("submit", (e) => {
            e.preventDefault();


            data = $('#searchForm').serialize();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#showTable').html('<div class="modal-body text-center"><div class="loader-box"><div class="loader-3" ></div></div></div>');


            // Send an AJAX request
            $.ajax({
                // beforeSend: function(){
                //     $('#AddCourseToSemesterModal').modal('hide');
                //     $('#LoadingModal').modal('show');
                // },
                type: 'POST',
                url: "{{ route('admin.semesterCourses.search') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    $('#showTable').html(response.view);
                    $('#selectedCourses').empty();
                    $('#selectedCourses').html(response.modal);
                },
                // complete: function(){
                //     $('#LoadingModal').modal('hide');
                // },
                error: function(xhr, status, error) {
                    alert("nooo");
                    console.error(xhr.responseText);
                }
            });

    });

    function courseNameSearch(data) {

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Send an AJAX request with the CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#showTable').html('<div class="modal-body text-center"><div class="loader-box"><div class="loader-3" ></div></div></div>');


            $.ajax({
                // beforeSend: function(){
                //     $('#showTable').html('<div class="modal-body text-center"><h2 class="title mb-0 text-center mt-4">الرجاء الانتظار...</h2><div class="loader-box"><div class="loader-3" ></div></div></div>');
                // },
                url: "{{ route('admin.semesterCourses.courseNameSearch') }}", // Replace with your own URL
                method: "post",
                data: {
                    'search': data,
                    'year': document.getElementById("year").value,
                    'semester': document.getElementById("semester").value,
                    _token: '{!! csrf_token() !!}',
                }, // Specify the expected data type
                success: function(data) {
                    //console.log(data);
                    $('#showTable').html(data.view);
                },
                // complete: function(){
                //     //$('#LoadingModal').modal('hide');
                //     $('#showTable').html(dataTable.view);
                // },
                error: function(xhr, status, error) {
                    // This function is called when there is an error with the request
                    alert('error');
                }
            });
    }

    $("#AddCourseToSemesterModal").on("hidden.bs.modal", function () {
        $('#selectedCourses').val(null).trigger('change');
    })


</script>
@endsection
