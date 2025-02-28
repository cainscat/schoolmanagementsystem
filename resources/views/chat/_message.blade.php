<div class="chat-header clearfix">
    @include('chat._header')
</div>

<div class="chat-history">
    @include('chat._chat')
</div>

<div class="chat-message clearfix">
    <form action="" id="SubmitMessage" class="input-group mb-0" enctype="multipart/form-data">
        <input type="hidden" value="{{ $getReceiver->id }}" name="receiver_id">
        {{ csrf_field() }}
        <textarea name="message" id="ClearMessage" required class="form-control getFileName" rows="1" placeholder="Enter message..."></textarea>

        <input style="display: none;" type="file" name="file_name" id="file_name">
        <span id="getFileName"></span>
        <a href="javascript:void(0);" id="OpenFile" style="border-radius: 5px;border-color:#d1d1d1" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
        <div class="input-group-prepend">
            <button style="height: 40px;" class="input-group-text" type="submit"><i class="fa fa-send"></i></button>
        </div>
    </form>
</div>
