<div id="semsterReportTable">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th style="background-color: #ecf0ef82;" colspan="3" id="semsterReportTableTitle"></th>
            </tr>
          <tbody>
            <tr>
              <td class="col-md-4">إجمالي الطلاب المسجلين في المساقات خلال هذا الفصل</td>
              <td id="manager_summary">{{$coursesStudentsTotal}}</td>
              {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
            </tr>
            <tr>
              <td class="col-md-4">إجمالي المساقات لهذا الفصل</td>
              <td id="phone_summary">{{$semesterCoursesTotal}}</td>
              {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
            </tr>
            <tr id="phone2_summary_area">
              <td class="col-md-4">إجمالي ساعات التدريب لجميع الطلاب خلال هذا الفصل</td>
              <td id="phone2_summary">{{$trainingHoursTotal}} ساعات، {{$trainingMinutesTotal}} دقائق</td>
              {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
            </tr>
            <tr>
              <td class="col-md-4">إجمالي الطلاب المسجلين في الشركات خلال هذاالفصل</td>
              <td id="address_summary">{{$traineesTotal}}</td>
              {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
            </tr>
            <tr>
                <td class="col-md-4">إجمالي الشركات المسجل بها خلال هذا الفصل</td>
                <td id="address_summary">{{$semesterCompaniesTotal}}</td>
                {{-- <td><button class="btn btn-primary">استعراض</button></td> --}}
            </tr>

          </tbody>
        </table>
    </div>
</div>
