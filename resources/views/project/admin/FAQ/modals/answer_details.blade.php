<div class="modal fade" id="answer_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <form method="post" action="{{ route('admin.faq_category.create') }}" class="modal-content">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h5 class="pull-left">تفاصيل الاجابة</h5>
                            </div>
                            <div class="card-body">
                                <div class="tabbed-card">
                                    <ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab1" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab1" data-bs-toggle="pill" href="#pills-clrhome1" role="tab" aria-controls="pills-clrhome1" aria-selected="true">ويب</a></li>
                                        <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab1" data-bs-toggle="pill" href="#pills-clrprofile1" role="tab" aria-controls="pills-clrprofile1" aria-selected="false">موبايل</a></li>
                                    </ul>
                                    <div class="tab-content" id="pills-clrtabContent1">
                                        <div class="tab-pane fade active show" id="pills-clrhome1" role="tabpanel" aria-labelledby="pills-clrhome-tab1">
                                            <p id="web_answer">

                                            </p>
                                        </div>
                                        <div class="tab-pane fade" id="pills-clrprofile1" role="tabpanel" aria-labelledby="pills-clrprofile-tab1">
                                            <p id="mobile_answer">

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
