

<ul class="list custom-scrollbar list-group m-0 p-0" style="padding: 0 !important">
    @if ($data->isEmpty())
    <p>لا توجد مراسلات</p>
@else
    @foreach ($data as $key)
    <li onclick="list_message_ajax({{ $key->c_id }})" style="cursor: pointer" class="clearfix list-group-item mt-2">
        <div style="" class=" d-flex">
            <div class="d-block" style="flex: 2">
                <p style="font-size: 11px;"><span class="fa fa-user"></span> <span>{{ $key->user->name ?? 'لا يوجد اسم' }}</span></p>
            </div>
            <div class="d-block text-end" style="flex: 1">
                <p style="font-size: 9px;" class="text-end text-bold">{{ \Carbon\Carbon::parse($key->created_at)->diffForHumans() }}</p>
            </div>
        </div>
        <div class="d-block">
            <p class="p-0 m-0" style="font-size: 11px;text-weight: bold"><span class="fa fa-comments"></span> <span>
                @foreach ($key->participants as $users)
                @php
                    $text = 'This is a long text example.';
                    $maxLength = 15;
                @endphp
                    @foreach (json_decode($users->uc_user_id) as $user)
                        <span style="font-size: 8px" class="">
                            {{ \App\Models\User::find($user)->name ?? 'لا يوجد اسم' }} |
                        </span>
                    @endforeach
                @endforeach
            </span></p>
            <p class="p-0 m-0" style="font-size: 11px;text-weight: bold"><span class="fa fa-comment"></span> <span>{{ $key->getLastMessage()->m_message_text ?? 'لا يوجد رسالة' }}</span></p>
            <p class="p-0 m-0" style="font-size: 11px;text-weight: bold"><span class="fa fa-comment"></span> <span>{{ $key->c_name ?? 'لا يوجد عنوان' }}</span></p>
        </div>
    </li>
    @endforeach
@endif

</ul>
