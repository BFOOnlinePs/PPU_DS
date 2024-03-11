<div id="showTable">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" style="display:none;">id</th>
                            <th scope="col">{{__('translate.announcement_title')}} {{-- عنوان الاعلان --}}</th>
                            <th scope="col">{{__('translate.added_by')}}{{-- منشئ الاعلان  --}}</th>
                            <th scope="col">{{__('translate.announcement_content')}}{{-- محتوى الاعلان --}}</th>
                            <th scope="col">{{__('translate.announcement_stutas')}}{{-- حالة الاعلان --}}</th>
                            <th scope="col">{{__('translate.Operations')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center"><span>{{__('translate.No data to display')}}{{--لا توجد بيانات--}}</span></td>
                        </tr>
                    @else
                        @foreach($data as $key)
                            <tr>
                                <td style="display:none;">{{ $key->a_id }}</td>
                                <td>{{$key->a_title}}</td>
                                <td>{{$key->users->name}} </td>
                                <td>{{$key->a_content}}</td>
                                <td> <select class="js-example-basic-single col-sm-12" name="a_stutas_{{$key->a_id}}" id="a_stutas_{{$key->a_id}}" onchange="changeAnnouncementStutas({{$key}})">
                                        <option @if($key->a_stutas==1) selected  @endif value="0">مفعل</option>
                                        <option @if($key->a_stutas==0) selected  @endif value="1">غير مفعل</option>
                                     </select></td>
                                <td><button class="btn btn-info" onclick="showAnnouncement({{ $key }})"><i class="fa fa-info"></i></button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                </table>
            </div>
        </div>