<div class="row">
    <div class="col-lg-12">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
            <img src="{{ $getReceived->getProfileDirect() }}" alt="avatar">
        </a>
        <div class="chat-about">
            <h6 style="margin-bottom: 0px;" class="m-b-0">{{ $getReceived->name }} {{ $getReceived->last_name }}</h6>
            <small>Last seen: {{ Carbon\Carbon::parse($getReceived->updated_at)->diffForHumans() }}</small>
        </div>
    </div>
</div>
