<div class="chat-header clearfix">
    @include('chat._header')
</div>

<div class="chat-history">
    @include('chat._chat')
</div>

<div class="chat-message clearfix">
    <form action="" id="SubmitMessage" class="input-group mb-0">
        <input type="text" value="{{ $getReceived->id }}" name="received_id">
        {{ csrf_field() }}
        <textarea name="message" required class="form-control" rows="1" placeholder="Enter message..."></textarea>

        <a href="javascript:void(0);" style="border-radius: 5px;border-color:#d1d1d1" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
        <div class="input-group-prepend">
            <button style="height: 40px;" class="input-group-text" type="submit"><i class="fa fa-send"></i></button>
        </div>
    </form>
</div>
