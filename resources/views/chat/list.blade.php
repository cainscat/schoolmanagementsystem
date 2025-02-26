@extends('layouts.app')
@section('style')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('public/css/chat.css') }}" />
@endsection
@section('content')
<main class="app-main">
    <div class="container mt-3">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-prepend">
                                <span style="height: 40px;" class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                        </div>

                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @include('chat._user')
                        </ul>
                    </div>

                    <div class="chat">
                        @if(!empty($getReceived))
                            @include('chat._message')
                        @else

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    $('body').delegate('#SubmitMessage', 'submit', function(e){
        e.preventDefault();
        $.ajax({
            type : 'POST',
            url : "{{ url('submit_message') }}",
            data : new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){

            },
            error: function(data){

            }
        });
    });
</script>
@endsection
