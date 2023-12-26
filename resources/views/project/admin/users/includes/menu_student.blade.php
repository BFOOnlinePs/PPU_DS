<a class=" col m-1 btn btn-primary btn-sm" href="{{route('admin.users.courses.student' , ['id'=>$user->u_id])}}">
<h1 style="font-size: 25px; " class="fa fa-book" ></h1>
<br>{{__('translate.Courses student')}} {{-- مساقات الطالب --}}</a>
<a class=" col m-1 btn btn-primary btn-sm" href="{{route('admin.users.places.training' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-map-marker" ></h1>
    <br>
{{__('translate.Training places')}} {{-- أماكن التدريب --}}</a>
<a class=" col m-1 btn btn-primary btn-sm" href="{{route('admin.users.students.attendance' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-check-square" ></h1>
    <br>
{{__('translate.Track record')}} {{-- سجل المتابعة --}}</a>
<a class="col m-1  btn btn-primary btn-sm" href="{{route('admin.users.student.payments' , ['id'=>$user->u_id])}}">
    <h1 style="font-size: 25px; " class="fa fa-dollar" ></h1>
    <br>
{{__('translate.Payments')}} {{-- الدفعات --}}</a>
