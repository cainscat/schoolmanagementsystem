@foreach($getChatUser as $user)
    <li class="clearfix getChatWindows @if(!empty($receiver_id)) @if($receiver_id == $user['user_id']) active @endif @endif" id="{{ $user['user_id'] }}">
        <img src="{{ $user['profile_pic'] }}" alt="avatar">
        <div class="about">
            <div class="name">
                {{ $user['name'] }}
                @if(!empty($user['message_count']))
                    <span id="ClearMessage{{ $user['user_id'] }}" class="status" style="background: red;padding: 0px 3px;border-radius: 50%;font-size: 8px;color: #ffff;">
                        {{ $user['message_count'] }}
                    </span>
                @endif
            </div>
            <div class="status">
                @if(!empty($user['is_online']))
                    <i class="fa fa-circle online"></i>
                @else
                    <i class="fa fa-circle offline"></i>
                @endif
                {{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }}
            </div>
        </div>
    </li>
@endforeach



