
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
<script>
    $(document).ready(function(){
        loadScript("{{ asset('assets/js/select2/select2-custom.js') }}", function() {});
        loadScript("{{ asset('assets/js/select2/select2.full.min.js') }}", function() {});
    });
    //to load script again
    function loadScript(src, callback) {
        var script = document.createElement('script');
        script.src = src;
        script.onload = callback;
        document.head.appendChild(script);
    }
</script>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col" style="display:none;">id</th>
                <th scope="col">اسم التخصص</th>
                <th scope="col">الرمز المرجعي للتخصص</th>
                <th scope="col">المشرف</th>
                <th scope="col">العمليات</th>

            </tr>
        </thead>
        <tbody>

        @if ($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center"><span>لا توجد بيانات</span></td>
            </tr>
        @else
            @foreach ($data as $major)
                <tr>
                    <td  style="display:none;">{{ $major->m_id }}</td>
                    <td>{{ $major->m_name }}</td>
                    {{-- <td>{{ $major->m_description }}</td> --}}
                    <td>{{ $major->m_reference_code }}</td>
                        <td>
                            <select  class="js-example-basic-single col-sm-12" id="supervisor_{{ $major->m_id }}"  multiple="multiple"  onchange="showSuperVisorModal({{$major}})" >
                            @foreach ($superVisors as $super)
                                <option @foreach ($major->majorSupervisors as $majorSupervisor) @if($super->u_id ==  $majorSupervisor->users->u_id) selected @endif  @endforeach value="{{$super->u_id }}">{{$super->name}}</option>
                            @endforeach
                            </select>

                        </td>
                    <td>
                        <button class="btn btn-info" onclick="showMajorModal({{ $major }})"><i class="fa fa-search"></i></button>
                        <button class="btn btn-primary" onclick="showEditModal({{ $major }})"><i class="fa fa-edit"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif

    </tbody>
    </table>
</div>
