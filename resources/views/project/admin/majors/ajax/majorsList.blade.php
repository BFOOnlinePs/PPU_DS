
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">اسم التخصص</th>
                      <th scope="col">وصف التخصص</th>
                      <th scope="col">الرمز المرجعي للتخصص	</th>
                      <th scope="col">التعديل</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($data as $key)
              <tr>
                  <td>{{ $key->m_id }}</td>
                  <td>{{ $key->m_name }}</td>
                  <td>{{ $key->m_description }}</td>
                  <td>{{ $key->m_reference_code }}</td>
                  <td>
                  <div class="row">
                      <div class="col-md-6">
                         <button class="btn btn-info" onclick="showMajorModal({{ $key }})"><i class="fa fa-search"></i></button>
                          <button class="btn btn-primary" onclick="showEditModal({{$key}})" ><i class="fa fa-edit"></i></button>
                      </div>
                        </div>
                  </td>
                </tr>
              @endforeach
                   
                   
                  
                  </tbody>
                </table>
           
