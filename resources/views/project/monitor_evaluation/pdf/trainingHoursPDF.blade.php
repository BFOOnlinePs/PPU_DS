@extends('layouts.styleForPDF')
@section('title')
تقرير الطلاب المسجلين في المساقات
@endsection
@section('content')

    <h4 class="text-center">{{__('translate.Palestine Polytechnic University')}}{{-- جامعة بوليتكنك فلسطين --}}</h4>
    <h4 class="text-center">{{__('translate.Dual Studies College')}}{{-- كلية الدراسات الثنائية --}}</h4>
    <hr>
    <br>

    <div id="trainingHoursTable">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">رقم الطالب</th>
                        <th scope="col">اسم الطالب</th>
                        <th scope="col">إجمالي ساعات التدريب</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center"><span>{{__('translate.No available data')}} {{-- لا توجد بيانات  --}}</span></td>
                    </tr>
                    @else
                        @foreach ($data as $key)
                            <tr>
                                <td>{{ $key->users->u_username }}</td>
                                <td>{{ $key->users->name }}</td>
                                <td>{{ $key->trainingHoursTotal }}ساعات,{{ $key->trainingMinutesTotal }}دقائق</td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection
