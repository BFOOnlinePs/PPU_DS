<div class="modal" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel-deactive">حذف مساق</h5>
       <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>


      </div>
      <div class="modal-body">
       <br>
       <h6 id="p-deactive">هل أنت متأكد من حذف المساق من الفصل الحالي؟</h6>
       <br>
       {{-- <p id='deactiveName'></p> --}}
     </div>
     <div class="modal-footer">
      <button id="b-deactive" type="button" class="btn btn-danger" onclick="deleteCourse()">حذف</button>
      <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">إلغاء</button>
      </div>
     </div>
    </div>
</div>
