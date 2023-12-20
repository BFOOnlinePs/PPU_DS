<a class=" col m-1 btn btn-primary btn-sm" href="{{route('supervisors.majors.index' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-book" ></h1>
    <br>
    التخصصات
</a>
<a class=" col m-1 btn btn-primary btn-sm" href="{{route('supervisors.students.index' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-users" ></h1>
    <br>
    طلاب المشرف
</a>
<a class=" col m-1 btn btn-primary btn-sm" href="{{route('supervisors.assistant.index' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-user-circle" ></h1>
    <br>
    المساعدين الإداريين
</a>

