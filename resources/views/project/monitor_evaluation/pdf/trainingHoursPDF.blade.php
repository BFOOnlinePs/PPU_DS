<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->isLocale('en') ? 'ltr' : 'rtl' }}">
    <head>
       <style>
         @page {
                    header: page-header;
                    footer: page-footer;
                    background: url("{{asset('assets/images/report-background.jpg')}}") no-repeat 0 0;
                    height: 100vh;
            }
       </style>
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        .td {
            border: 1px solid black;
            padding: 8px;
            /* text-align: left; */
        }
        .container {
            display: flex;
        }

        .section {
            flex: 1;
            border: 1px solid #ccc;
            box-sizing: border-box;
            padding: 10px;
        }

    </style>
</head>
<body>
      <table class="table">

        <tbody>
              <tr style="width:100%">

                <td style="width:1%;">
                    {{-- <img src="{{asset('assets/images/ppu.png')}}" alt="" width="60px" height="65px"> --}}
                </td>
                <td style="width:20%; text-align: right; font-size: 15px;">
                    {{-- {{__('translate.Palestine Polytechnic University')}} --}}
                <br>
                    {{-- {{__('translate.Dual Studies College')}} --}}
                </td>
                {{-- <td style="width:50%; text-align: center; font-weight: bold;">{{$title}}</td> --}}
                {{-- <td style="width:59%; text-align: center; font-weight: bold;">تقرير الفصل الإجمالي</td> --}}
                <td style="width:59%; text-align: center; font-size: 20px;">{{$title}}</td>
                <td style="width:21%; text-align: right; font-size: 14px;">
                    تاريخ التقرير: {{now()->format('Y-m-d')}}
                    <br>
                    {{-- {{$semester}} --}}
                    @if ($semester == 1)
                        <span>الفصل الدراسي الأول</span>
                    @elseif ($semester == 2)
                        <span>الفصل الدراسي الثاني</span>
                    @else
                        <span>الفصل الدراسي الصيفي</span>
                    @endif
                </td>
                {{-- <td><button class="btn btn-primary"> استعراض</button></td> --}}
              </tr>
        </tbody>
      </table>


    {{-- <hr> --}}
    <br>
    <br>
    <div style="font-size: 15px;">
    <br>

        {{-- <h3>
            {{$title}}
        </h3> --}}

        {{-- <br> --}}
    <div style="width:60%; margin-left: auto; margin-right: auto;">
        <table class="table">
            <tbody>
                <tr style="background-color: rgba(185, 178, 178, 0.188)">
                    <td class="td"><b>الجنس</b></td>
                    <td class="td">
                      @if ($gender == 1)
                          <span>إناث</span>
                      @elseif ($gender == 0)
                          <span>ذكور</span>
                      @else
                          <span>الجميع</span>
                      @endif
                  </td>
                  <td class="td"><b>التخصص</b></td>
                  <td class="td">{{$majorText}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <br>
    <div>
        <div>
            <table class="table">
                <thead>
                    <tr  class="td">
                        <th class="td" scope="col">رقم الطالب</th>
                        <th class="td" scope="col">اسم الطالب</th>
                        <th class="td" scope="col">إجمالي ساعات التدريب</th>
                    </tr>
                </thead>
                <tbody>
                @if ($data->isEmpty())
                    <tr>
                    <td  class="td" colspan="3"><span>{{__('translate.No available data')}} {{-- لا توجد بيانات  --}}</span></td>
                    </tr>
                @else
                    @foreach ($data as $key)
                    <tr>
                        <td class="td">{{ $key->users->u_username }}</td>
                        <td class="td">{{ $key->users->name }}</td>
                        <td class="td">{{ $key->trainingHoursTotal }}ساعات,{{ $key->trainingMinutesTotal }}دقائق</td>
                    </tr>
                    @endforeach
                @endif
                </tbody>

            </table>
        </div>

        {{-- {{$PAGENO}} --}}
    </div>

    <htmlpagefooter name="page-footer">
        {{-- <hr> --}}
        {{-- <div style="display: block;text-align:center; padding: 30px !important;">Page {PAGENO} of {nbpg}</div> --}}
        <div style="display: block;text-align:center; padding: 30px !important;">صفحة {PAGENO} من {nbpg}</div>
    </htmlpagefooter>


    {{-- <footer>
        hi
    </footer> --}}
</div>
</body>

</html>
{{-- @endsection --}}


