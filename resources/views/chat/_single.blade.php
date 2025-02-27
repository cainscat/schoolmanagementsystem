@foreach($getChat as $value)
    @if($value->sender_id == Auth::user()->id)
        <li class="clearfix">
            <div style="text-align: right" class="message-data">
                <span class="message-data-time">{{ Carbon\Carbon::parse($value->created_date)->diffForHumans() }}</span>
                <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
            </div>
            <div class="message other-message float-right">
                {!! $value->message !!}
                @if(!empty($value->getFile()))
                    <div>
                        <a href="{{ $value->getFile() }}" download="" target="_blank" >Download</a>
                    </div>
                @endif
            </div>

        </li>
    @else
        <li class="clearfix">
            <div class="message-data">
                <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
                <span class="message-data-time">{{ Carbon\Carbon::parse($value->created_date)->diffForHumans() }}</span>
            </div>
            <div class="message my-message">
                {!! $value->message !!}
                @if(!empty($value->getFile()))
                    <div>
                        <a href="{{ $value->getFile() }}" download="" target="_blank" >Download</a>
                    </div>
                @endif
            </div>
        </li>
    @endif
@endforeach
