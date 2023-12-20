 

                                        <div id="noor12121">
                                            <input id="companyDepartments" name="companyDepartments" value="{{$companyDepartments}}" hidden>
                                        @foreach($companyDepartments as $key1)
                               <div class="col-md-4">
                                <input class="f1-last-name form-control" name="d_name_{{$key1->d_id}}" id="d_name_{{$key1->d_id}}" value="{{$key1->d_name}}">
      </div>
   
  
                                    @endforeach
                                   
                <input hidden id="c_id" name="c_id" value="{{$company->c_id}}">  
</div>
       