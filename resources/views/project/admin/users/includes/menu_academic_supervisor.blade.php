<a class=" col m-1 btn btn-primary btn-sm" href="{{route('admin.users.supervisor.majors' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-book" ></h1>
    <br>
    التخصصات
</a>
<a class=" col m-1 btn btn-primary btn-sm" href="{{route('admin.users.supervisor.sutdents' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-users" ></h1>
    <br>
    طلاب المشرف
</a>
