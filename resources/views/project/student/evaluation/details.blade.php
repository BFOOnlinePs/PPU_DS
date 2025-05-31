@extends('layouts.app')
@section('title')
    تفاصيل التقييم
@endsection
@section('header_title')
    تفاصيل التقييم
@endsection
@section('header_title_link')
    تفاصيل التقييم
@endsection
@section('header_link')
    تفاصيل التقييم
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm table-hover">
                                <tbody>
                                    @foreach ($data as $key)
                                        @php
                                            $registration = $key['registrations'][0] ?? null;
                                            $course = $registration
                                                ? \App\Models\Course::where(
                                                    'c_id',
                                                    $registration['r_course_id'],
                                                )->first()
                                                : null;
                                        @endphp

                                        @if (auth()->user()->u_role_id == 10)
                                            <tr>
                                                <td>{{ $key->name }}</td>
                                                <td>{{ optional($course)->c_name ?? 'غير معروف' }}</td>
                                                <td>
                                                    <span>
                                                        {{ isset($registration['university_score']) ? '50 / ' . $registration['university_score'] : 'لم يتم التقييم بعد' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $regModel = \App\Models\Registration::where(
                                                            'r_student_id',
                                                            $key->u_id,
                                                        )->first();
                                                    @endphp
                                                    @if ($key->submission_status == false && $regModel)
                                                        <a href="{{ route('students.evaluation.evaluation_submission_page', ['registration_id' => $regModel->r_id, 'evaluation_id' => $id]) }}"
                                                            class="btn btn-xs btn-primary">تقييم</a>
                                                    @else
                                                        <p class="badge bg-success">تم التقييم</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif(auth()->user()->u_role_id == 2)
                                            <tr>
                                                <td>{{ $key->name }}</td>
                                                <td>
                                                    @if ($key->submission_status == false)
                                                        <a href="{{ route('students.evaluation.evaluation_submission_page', ['registration_id' => $key->u_id, 'evaluation_id' => $id]) }}"
                                                            class="btn btn-xs btn-primary">تقييم</a>
                                                    @else
                                                        <button class="badge bg-success">تم التقييم</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif(auth()->user()->u_role_id == 6)
                                            <tr>
                                                <td>{{ $key->name }}</td>
                                                <td>{{ optional($course)->c_name ?? 'غير معروف' }}</td>
                                                <td>
                                                    <span>
                                                        {{ isset($registration['company_score']) ? '50 / ' . $registration['company_score'] : 'لم يتم التقييم بعد' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($key->submission_status == false)
                                                        <a href="{{ route('students.evaluation.evaluation_submission_page', ['registration_id' => $key->u_id, 'evaluation_id' => $id]) }}"
                                                            class="btn btn-xs btn-primary">تقييم</a>
                                                    @else
                                                        <button class="badge bg-success">تم التقييم</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
