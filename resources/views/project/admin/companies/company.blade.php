@extends('layouts.app')
@section('title')
    إضافة شركة
@endsection
@section('header_title')
     الشركات
@endsection
@section('header_title_link')
    إدارة الشركات
@endsection
@section('header_link')
    إضافة شركة
@endsection

@section('content')

<div class="card" style="padding-left:0px; padding-right:0px;">

    <div class="card-body" >

        <form class="f1" method="post">
            <div class="f1-steps">
                <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                </div>
                <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>المستخدم</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-file-text-o"></i></div>
                    <p>معلومات الشركة</p>
                </div>
                <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-building-o"></i></div>
                    <p>فروع الشركة</p>
                </div>
            </div>

            <fieldset>
                <div class="form-group">
                    <label for="f1-first-name"> اسم الشركة</label>
                    <input class="form-control" id="f1-company-name" type="text" name="f1-first-name" required="">
                </div>
                <div class="form-group">
                    <label for="f1-first-name"> البريد الإلكتروني </label>
                    <input class="form-control" id="f1-email" type="text" name="f1-first-name" required="">
                </div>
                <div class="form-group">
                    <label for="f1-last-name">الشخص المسؤول</label>
                    <input class="f1-last-name form-control" id="f1-last-name" type="text" name="f1-last-name" required="">
                </div>
                <div class="form-group">
                    <label for="f1-last-name">كلمة المرور</label>
                    <input class="f1-last-name form-control" id="f1-last-name" type="text" name="f1-last-name" required="">
                </div>
                <div class="form-group">
                    <label for="f1-last-name">رقم الهاتف</label>
                    <input class="f1-last-name form-control" id="f1-last-name" type="text" name="f1-last-name" required="">
                </div>
                <div class="form-group">
                    <label for="f1-last-name">عدد فروع الشركة</label>
                    <select id="f1-last-name" name="f1-last-name" class="form-control btn-square">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" type="button">التالي</button>
                </div>
            </fieldset>


            <fieldset>
                <div class="form-group">
                    <label class="sr-only" for="f1-email">Email</label>
                    <input class="f1-email form-control" id="f1-email" type="text" name="f1-email" placeholder="Email..." required="">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="f1-password">Password</label>
                    <input class="f1-password form-control" id="f1-password" type="password" name="f1-password" placeholder="Password..." required="">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="f1-repeat-password">Repeat password</label>
                    <input class="f1-repeat-password form-control" id="f1-repeat-password" type="password" name="f1-repeat-password" placeholder="Repeat password..." required="">
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-previous" type="button">رجوع</button>
                    <button class="btn btn-primary btn-next" type="button">التالي</button>
                </div>
            </fieldset>


            <fieldset>
                <div class="form-group">
                    <label class="sr-only">DD</label>
                    <input class="form-control" id="dd" type="number" placeholder="dd" required="">
                </div>
                <div class="form-group">
                    <label class="sr-only">MM</label>
                    <input class="form-control" id="mm" type="number" placeholder="mm" required="">
                </div>
                <div class="form-group">
                    <label class="sr-only">YYYY</label>
                    <input class="form-control" id="yyyy" type="number" placeholder="yyyy" required="">
                </div>
                <div class="f1-buttons">
                    <button class="btn btn-primary btn-previous" type="button">رجوع</button>
                    <button class="btn btn-primary btn-submit" type="submit">إضافة</button>
                </div>
            </fieldset>

        </form>


    </div>



</div>

{{-- <form class="f1" method="post">
    <div class="f1-steps">
      <div class="f1-progress">
        <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
      </div>
      <div class="f1-step active">
        <div class="f1-step-icon"><i class="fa fa-user"></i></div>
        <p>Registration</p>
      </div>
      <div class="f1-step">
        <div class="f1-step-icon"><i class="fa fa-key"></i></div>
        <p>Email</p>
      </div>
      <div class="f1-step">
        <div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
        <p>Birth Date</p>
      </div>
    </div>
    <fieldset>
      <div class="form-group">
        <label for="f1-first-name">First Name</label>
        <input class="form-control" id="f1-first-name" type="text" name="f1-first-name" placeholder="name@example.com" required="">
      </div>
      <div class="form-group">
        <label for="f1-last-name">Last name</label>
        <input class="f1-last-name form-control" id="f1-last-name" type="text" name="f1-last-name" placeholder="Last name..." required="">
      </div>
      <div class="f1-buttons">
        <button class="btn btn-primary btn-next" type="button">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <div class="form-group">
        <label class="sr-only" for="f1-email">Email</label>
        <input class="f1-email form-control" id="f1-email" type="text" name="f1-email" placeholder="Email..." required="">
      </div>
      <div class="form-group">
        <label class="sr-only" for="f1-password">Password</label>
        <input class="f1-password form-control" id="f1-password" type="password" name="f1-password" placeholder="Password..." required="">
      </div>
      <div class="form-group">
        <label class="sr-only" for="f1-repeat-password">Repeat password</label>
        <input class="f1-repeat-password form-control" id="f1-repeat-password" type="password" name="f1-repeat-password" placeholder="Repeat password..." required="">
      </div>
      <div class="f1-buttons">
        <button class="btn btn-primary btn-previous" type="button">Previous</button>
        <button class="btn btn-primary btn-next" type="button">Next</button>
      </div>
    </fieldset>
    <fieldset>
      <div class="form-group">
        <label class="sr-only">DD</label>
        <input class="form-control" id="dd" type="number" placeholder="dd" required="">
      </div>
      <div class="form-group">
        <label class="sr-only">MM</label>
        <input class="form-control" id="mm" type="number" placeholder="mm" required="">
      </div>
      <div class="form-group">
        <label class="sr-only">YYYY</label>
        <input class="form-control" id="yyyy" type="number" placeholder="yyyy" required="">
      </div>
      <div class="f1-buttons">
        <button class="btn btn-primary btn-previous" type="button">Previous</button>
        <button class="btn btn-primary btn-submit" type="submit">Submit</button>
      </div>
    </fieldset>
</form> --}}

@endsection

@section('script')
<script src="{{ asset('assets/js/form-wizard/form-wizard-three.js') }}"></script>
<script src="{{asset('assets/js/form-wizard/jquery.backstretch.min.js')}}"></script>
@endsection
