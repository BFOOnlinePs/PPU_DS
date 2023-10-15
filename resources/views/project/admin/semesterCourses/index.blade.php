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
@section('content')


<div class="col-sm-12 col-xl-6 xl-100">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs nav-left" id="right-tab" role="tablist">
          <li class="nav-item"><a class="nav-link active" id="profile-right-tab" data-bs-toggle="tab" href="#right-profile" role="tab" aria-controls="profile-icon" aria-selected="false">مساقات الفصل الحالي</a></li>
          <li class="nav-item"><a class="nav-link " id="right-home-tab" data-bs-toggle="tab" href="#right-home" role="tab" aria-controls="right-home" aria-selected="true">مساقات الفصول</a></li>
          </ul>
        <div class="tab-content" id="right-tabContent">
          <div class="tab-pane fade show active" id="right-home" role="tabpanel" aria-labelledby="right-home-tab">
            <p class="mb-0 m-t-30">hi reem</p>
          </div>
          <div class="tab-pane fade" id="right-profile" role="tabpanel" aria-labelledby="profile-right-tab">
            <p class="mb-0 m-t-30">hi noor</p>
          </div>
          <div class="tab-pane fade" id="right-contact" role="tabpanel" aria-labelledby="contact-right-tab">
            <p class="mb-0 m-t-30">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
          </div>
        </div>
      </div>
    </div>
</div>



@endsection
@section('script')
@endsection
