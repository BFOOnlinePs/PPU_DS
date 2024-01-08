@extends('layouts.app')
@section('title')
    حذف بيانات
@endsection
@section('header_title')
    حذف بيانات
@endsection
@section('header_title_link')
    حذف بيانات
@endsection
@section('header_link')
    حذف بيانات
@endsection
@section('style')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div id="messages">
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">من تاريخ</label>
                        <input type="date" class="form-control"  id="from">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">إلى تاريخ</label>
                        <input type="date" class="form-control" id="to">
                    </div>
                </div>
            </div>
            <button class="btn btn-danger" onclick="show_modal_delete()">حذف</button>
        </div>
        @include('project.admin.settings.includes.alertToDeleteData')
        @include('layouts.loader')
    </div>
@endsection
@section('script')
    <script>
        function show_modal_delete()
        {
            $('#confirmDeleteModal').modal('show');
        }
        function confirmDelete()
        {
            let from = document.getElementById('from').value;
            let to = document.getElementById('to').value;
            $.ajax({
                beforeSend: function() {
                    $('#confirmDeleteModal').modal('hide');
                    $('#LoadingModal').modal('show');
                },
                url: "{{ route('admin.settings.confirmDelete') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{
                    'from': from,
                    'to': to
                },
                success: function (response) {
                    if(response.status == 1) {
                        document.getElementById('messages').innerHTML = `
                            <div class="alert alert-success">
                                تم الحذف بنجاح
                            </div>
                        `;
                    }
                    else {
                        document.getElementById('messages').innerHTML = `
                            <div class="alert alert-danger">
                                لا يوجد بيانات في هذه الفترة ، لم يُحذف أي بيانات
                            </div>
                        `;
                    }
                    $('#LoadingModal').modal('hide');
                },
                error: function (error) {
                    $('#LoadingModal').modal('hide');
                    alert("errrrrro");
                }
            });
        }
    </script>
@endsection
