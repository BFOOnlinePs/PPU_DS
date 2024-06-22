@extends('layouts.app')
@section('title')
    {{__('translate.Main')}}{{--الرئيسية--}}
@endsection
@section('header_title')
{{__('translate.Main')}}{{--الرئيسية--}}
@endsection
@section('header_title_link')
{{__('translate.Main')}}{{--الرئيسية--}}
@endsection
@section('header_link')
{{__('translate.Main')}}{{--الرئيسية--}}
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/calendar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-QZFGL0W6qPrIFZdtYjZ3j+Y6OtHcCqHF5+yXvr3A3qoZtefksLyC5/CSlC5J8+h6FHUw0xRSoAFK43Z7Xlp3Hg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}"> --}}
<style>
    .announcemetsBody{
        padding-top:8%
    }
    .announcement-header{
    background-color: #ef681a;
    color: white;
    width: 100%;
    border-radius: 5px;
    align-items: center;
    justify-content: space-around;
    display: flex;
    }
    </style>
    @endsection
@if(auth()->user()->u_role_id == 1)
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
        <div class="col-md-6" style="padding-top:3%">
        <div class="announcement-header">
        <h2>اعلانات الكلية</h2>
    </div>
    <div class="announcemetsBody">
@foreach($data as $key)
{{ $key->created_at->format('F') }}
{{ $key->created_at->format('d') }}


<br>
<a href='{{ route("admin.announcements.edit",["id"=>$key->a_id])}}'> {{$key->a_title}} </a>
<hr>
@endforeach
</div>
    </div>
      <div class="col-md-6">
        <button class="btn btn-primary" onclick="show_add_event_modal()">{{__('translate.Add event')}}{{-- إضافة حدث --}}</button><br><br>
        <div id="calendar">

        </div>
     </div>
     </div>
        @include('modals.addEvent')
        @include('modals.showEvent')
        @include('modals.alertToConfirmDelete')
        @include('layouts.loader')
    </div>
</div>
@endsection
    @section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        function clear_function() {
            let select = document.getElementById('e_type');
            select.innerHTML = '';
            let array_types = [
                `{{__('translate.Everyone')}}`, // الجميع
                `{{__('translate.Students of a specific major')}}`, // طلاب تخصص معين
                `{{__('translate.Students of a specific course')}}`,//طلاب مساق معين
                `{{__('translate.Trainees of a specific company')}}`,// متدربين شركة معينة
                `{{__('translate.For all academic supervisors')}}`,//لكل المشرفين الأكادميين
            ];
            for(let i = 0; i < array_types.length; i++) {
                let option = document.createElement('option');
                option.value = i;
                option.text = array_types[i];
                select.appendChild(option);
            }
            document.getElementById('show_event_information').reset();
            document.getElementById('addEventForm').reset();
        }
        function edit_event()
        {
            let e_id = document.getElementById('e_id').value;
            let e_title = document.getElementById('show_e_title').value;
            let e_color = document.getElementById('show_e_color').value;
            let e_description = document.getElementById('show_e_description').value;
            let e_type = document.getElementById('show_e_type').value;
            let e_id_type = document.getElementById('show_e_id_type').value;
            let e_start_date = document.getElementById('show_e_start_date').value;
            let e_end_date = document.getElementById('show_e_end_date').value;
            $.ajax({
                beforeSend: function(){
                    $('#ShowEventModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.calendar.ajax.edit_event')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'e_id' : e_id ,
                    'e_title' : e_title ,
                    'e_color' : e_color ,
                    'e_description' : e_description ,
                    'e_type' : e_type ,
                    'e_id_type' : e_id_type ,
                    'e_start_date' : e_start_date ,
                    'e_end_date' : e_end_date
                },
                success: function(response) {
                    toastr.success(`{{__('translate.The event information has been successfully updated')}}`); // تم تعديل معلومات الحدث بنجاح
                    $('#LoadingModal').modal('hide');
                    display_events();
                    clear_function();
                },
                error: function(jqXHR) {
                    $('#LoadingModal').modal('hide');
                }
            });
        }
        function delete_event()
        {
            $.ajax({
                url: "{{route('admin.calendar.ajax.delete_event')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'e_id' : document.getElementById('e_id').value
                },
                success: function(response) {
                    $('#confirmDeleteEvent').modal('hide');
                    display_events();
                    toastr.success(`{{__('translate.The event has been successfully deleted')}}`); // تم حذف الحدث بنجاح
                    clear_function();
                },
                error: function(jqXHR) {
                }
            });
        }
        function show_alert_delete() {
            $('#ShowEventModal').modal('hide');
            $('#confirmDeleteEvent').modal('show');
        }
        function show_add_event_modal()
        {
            document.getElementById('e_id_type').innerHTML = "";
            document.getElementById('e_id_type').disabled = true;
            $('#AddEventModal').modal('show');
        }
        function action_listener_when_choose_option(option_number , id) {
            if (option_number == 1) {
                ajax_to_get_majors(id);
            }
            else if (option_number == 2) {
                ajax_to_get_courses(id);
            }
            else if (option_number == 3) {
                ajax_to_get_companies(id);
            }
            else {
                document.getElementById(id).innerHTML = "";
                document.getElementById(id).disabled = true;
            }
        }
        function ajax_to_get_courses(id)
        {
            $.ajax({
                url: "{{route('admin.calendar.ajax.ajax_to_get_courses')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                },
                success: function(response) {
                    let e_id_type = document.getElementById(id);
                    e_id_type.innerHTML = "";
                    e_id_type.disabled = false;
                    response.semester_courses.forEach(function(semester_course) {
                        let option = document.createElement('option');
                        option.value = semester_course.sc_course_id;
                        option.text = semester_course.sc_course.c_name;
                        e_id_type.appendChild(option);
                    });
                },
                error: function(jqXHR) {
                }
            });
        }
        function ajax_to_get_majors(id)
        {
            $.ajax({
                url: "{{route('admin.calendar.ajax.ajax_to_get_majors')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                },
                success: function(response) {
                    let e_id_type = document.getElementById(id);
                    e_id_type.innerHTML = "";
                    e_id_type.disabled = false;
                    response.majors.forEach(function(major) {
                        let option = document.createElement('option');
                        option.value = major.m_id;
                        option.text = major.m_name;
                        e_id_type.appendChild(option);
                    });
                },
                error: function(jqXHR) {
                }
            });
        }
        function ajax_to_get_companies(id)
        {
            $.ajax({
                url: "{{route('admin.calendar.ajax.ajax_to_get_companies')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                },
                success: function(response) {
                    let e_id_type = document.getElementById(id);
                    e_id_type.innerHTML = "";
                    e_id_type.disabled = false;
                    response.companies.forEach(function(key) {
                        let option = document.createElement('option');
                        option.value = key.c_id;
                        option.text = key.c_name;
                        e_id_type.appendChild(option);
                    });
                },
                error: function(jqXHR) {
                }
            });
        }
        function ajax_to_get_event_information(id) {
            $.ajax({
                url: "{{route('admin.calendar.ajax.show_event_information')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id' : id
                },
                success: function(response) {
                    document.getElementById('e_id').value = response.event.e_id;
                    document.getElementById('show_e_color').value = response.event.e_color;
                    document.getElementById('show_e_title').value = response.event.e_title;
                    document.getElementById('show_e_description').value = response.event.e_description;
                    let e_type;
                    if(response.event.e_type === 0) {
                        e_type = `{{__('translate.Everyone')}}`; // الجميع
                    }
                    else if(response.event.e_type === 1) {
                        e_type = `{{__('translate.Students of a specific major')}}`; // طلاب تخصص معين
                    }
                    else if(response.event.e_type === 2) {
                        e_type = `{{__('translate.Students of a specific course')}}`; // طلاب مساق معين
                    }
                    else if(response.event.e_type === 3) {
                        e_type = `{{__('translate.Trainees of a specific company')}}`; // متدربين شركة معينة
                    }
                    else if(response.event.e_type === 4) {
                        e_type = `{{__('translate.For all academic supervisors')}}`; // لكل المشرفين الأكادميين
                    }
                    let array_types = [
                        `{{__('translate.Everyone')}}`, // الجميع
                        `{{__('translate.Students of a specific major')}}`, // طلاب تخصص معين
                        `{{__('translate.Students of a specific course')}}`,//طلاب مساق معين
                        `{{__('translate.Trainees of a specific company')}}`,// متدربين شركة معينة
                        `{{__('translate.For all academic supervisors')}}`,//لكل المشرفين الأكادميين
                    ];
                    let select = document.getElementById('show_e_type');
                    select.innerHTML = '';
                    let option = document.createElement('option');
                    option.value = response.event.e_type
                    option.text = e_type;
                    select.appendChild(option);
                    for(let i = 0; i < array_types.length; i++) {
                        if(array_types[i] !== e_type) {
                            let option = document.createElement('option');
                            option.value = i;
                            option.text = array_types[i];
                            select.appendChild(option);
                        }
                    }
                    let select_type_name = document.getElementById('show_e_id_type');
                    select_type_name.innerHTML = '';
                    if(response.event_name_type !== null && e_type === `{{__('translate.Students of a specific course')}}`) { // طلاب مساق معين
                        document.getElementById('show_e_id_type').disabled = false;
                        let option = document.createElement('option');
                        option.value = response.event_id_type;
                        option.text = response.event_name_type;
                        select_type_name.appendChild(option);
                        for(let i = 0; i < response.data.length; i++) {
                            let option = document.createElement('option');
                            option.value = response.data[i].sc_course_id;
                            option.text = response.data[i].course_name;
                            select_type_name.appendChild(option);
                        }
                    }
                    else if(response.event_name_type !== null && e_type == `{{__('translate.Students of a specific major')}}`) { // طلاب تخصص معين
                        document.getElementById('show_e_id_type').disabled = false;
                        let option = document.createElement('option');
                        option.value = response.event_id_type;
                        option.text = response.event_name_type;
                        select_type_name.appendChild(option);
                        for(let i = 0; i < response.data.length; i++) {
                            let option = document.createElement('option');
                            option.value = response.data[i].m_id;
                            option.text = response.data[i].m_name;
                            select_type_name.appendChild(option);
                        }
                    }
                    else if(response.event_name_type !== null && e_type == `{{__('translate.Trainees of a specific company')}}`) { // متدربين شركة معينة
                        document.getElementById('show_e_id_type').disabled = false;
                        let option = document.createElement('option');
                        option.value = response.event_id_type;
                        option.text = response.event_name_type;
                        select_type_name.appendChild(option);
                        for(let i = 0; i < response.data.length; i++) {
                            let option = document.createElement('option');
                            option.value = response.data[i].c_id;
                            option.text = response.data[i].c_name;
                            select_type_name.appendChild(option);
                        }
                    }
                    else {
                        document.getElementById('show_e_id_type').disabled = true;
                    }
                    document.getElementById('show_e_start_date').value = response.event.e_start_date;
                    document.getElementById('show_e_end_date').value = response.event.e_end_date;
                    $('#ShowEventModal').modal('show');
                },
                error: function(jqXHR) {
                }
            });
        }
        let AddEventForm = document.getElementById("addEventForm");
        AddEventForm.addEventListener("submit", (e) => {
            e.preventDefault();
            create_event();
        })
        function create_event()
        {
            let e_title = document.getElementById('e_title').value;
            let e_color = document.getElementById('e_color').value;
            let e_description = document.getElementById('e_description').value;
            let e_type = document.getElementById('e_type').value;
            let e_id_type = document.getElementById('e_id_type').value;
            let e_start_date = document.getElementById('e_start_date').value;
            let e_end_date = document.getElementById('e_end_date').value;
            $.ajax({
                beforeSend: function(){
                    $('#LoadingModal').modal('show');
                },
                url: "{{route('admin.calendar.create_event')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'e_title' : e_title,
                    'e_color' : e_color,
                    'e_description' : e_description,
                    'e_type' : e_type,
                    'e_id_type' : e_id_type,
                    'e_start_date' : e_start_date,
                    'e_end_date' : e_end_date
                },
                success: function(response) {
                    toastr.success(`{{__('translate.The event has been successfully added')}}`); // تم إضافة الحدث بنجاح
                    $('#LoadingModal').modal('hide');
                    $('#AddEventModal').modal('hide');
                    display_events();
                    clear_function();
                },
                error: function(jqXHR) {
                    $('#LoadingModal').modal('hide');
                    clear_function();
                }
            });
        }
        function display_events()
        {
            let events = [];
            $.ajax({
                url: "{{route('admin.calendar.display_events')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                },
                success: function(response) {
                    events = response.events;
                    let calendarEl = document.getElementById('calendar');
                    let currentDate = new Date();
                    let calendar = new FullCalendar.Calendar(calendarEl,{
                        initialView: 'dayGridMonth',
                        initialDate: currentDate.toISOString().slice(0,10), // Set initial current date
                        events:events,
                        eventClick: function(info) {
                            ajax_to_get_event_information(info.event.id);
                        } ,
                        dateClick: function(info) {
                            var clickedDate = info.date;
                        }
                    });
                    calendar.render();
                },
                error: function(jqXHR) {
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            display_events();
            clear_function();
        });
    </script>
    @endsection
@else
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if(auth()->user()->u_role_id == 2) {{-- Student --}}
                            @include('includes.studentCard')
                        @elseif (auth()->user()->u_role_id == 3) {{-- Supervisor --}}
                            @include('includes.academicSupervisorCard')
                        @elseif (auth()->user()->u_role_id == 4) {{-- Assistant --}}
                            @include('includes.assistantCard')
                        @elseif (auth()->user()->u_role_id == 5) {{-- M&E --}}
                            @include('includes.monitorEvaluationCard')
                        @elseif (auth()->user()->u_role_id == 6) {{-- Company Manager --}}
                            @include('includes.companyManagerCard')
                        @elseif (auth()->user()->u_role_id == 8) {{-- Communications Manager with Companies --}}
                            @include('includes.communicationsManagerWithCompaniesCard')
                        @endif

                    </div>
                    <div class="col-md-6">
                        <div id="calendar">
                        </div>
                        @include('modals.showEventForAll')
                    </div>
                </div>
                <div class="col-md-12" style="padding-top:1%">
                    <div class="announcement-header">
                     <h2>اعلانات الكلية</h2>
                    </div>
                    <div class="announcemetsBody" style="padding-top:3%">
                        @foreach($data as $key)
                        {{ $key->created_at->format('F') }}
                        {{ $key->created_at->format('d') }}
                        <br>
                        <a href='{{ route("admin.announcements.edit",["id"=>$key->a_id])}}'> {{$key->a_title}} </a>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        function ajax_to_get_event_information(id)
        {
            $.ajax({
                url: "{{route('allUsersWithoutAdmin.calendar.show_event_information')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    'id' : id
                },
                success: function(response) {
                    document.getElementById('show_e_title_for_all').value = response.event.e_title;
                    document.getElementById('show_e_description_for_all').value = response.event.e_description;
                    let e_type;
                    if(response.event.e_type === 0) {
                        e_type = `{{__('translate.Everyone')}}`; // الجميع
                    }
                    else if(response.event.e_type === 1) {
                        e_type = `{{__('translate.Students of a specific major')}}`; // طلاب تخصص معين
                    }
                    else if(response.event.e_type === 2) {
                        e_type = `{{__('translate.Students of a specific course')}}`; // طلاب مساق معين
                    }
                    else if(response.event.e_type === 3) {
                        e_type = `{{__('translate.Trainees of a specific company')}}`; // متدربين شركة معينة
                    }
                    else if(response.event.e_type === 4) {
                        e_type = `{{__('translate.For all academic supervisors')}}`; // لكل المشرفين الأكادميين
                    }
                    document.getElementById('show_e_type_for_all').value = e_type;
                    document.getElementById('show_e_id_type_for_all').value = response.event_name_type;
                    document.getElementById('show_e_start_date_for_all').value = response.event.e_start_date;
                    document.getElementById('show_e_end_date_for_all').value = response.event.e_end_date;
                    $('#ShowEventModalForAll').modal('show');
                },
                error: function(jqXHR) {
                }
            });
        }
        function display_events()
        {
            let events = [];
            $.ajax({
                url: "{{route('allUsersWithoutAdmin.calendar.display_events')}}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                },
                success: function(response) {
                    events = response.events;
                    let calendarEl = document.getElementById('calendar');
                    let currentDate = new Date();
                    let calendar = new FullCalendar.Calendar(calendarEl,{
                        initialView: 'dayGridMonth',
                        initialDate: currentDate.toISOString().slice(0,10), // Set initial current date
                        events:events,
                        eventClick: function(info) {
                            ajax_to_get_event_information(info.event.id);
                        } ,
                        dateClick: function(info) {
                        }
                    });
                    calendar.render();
                },
                error: function(jqXHR) {
                }
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            display_events();
        });
    </script>
    @endsection
@endif

