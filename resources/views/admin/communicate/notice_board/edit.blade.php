@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Notice Board</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" required value="{{ old('title', $getRecord->title) }}" name="title" placeholder="Title">
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Notice Date</label>
                                            <input type="date" class="form-control" value="{{ $getRecord->notice_date }}" name="notice_date" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Publish Date</label>
                                            <input type="date" class="form-control" value="{{ $getRecord->publish_date }}" name="publish_date" required>
                                        </div>
                                    </div>

                                </div>

                                @php
                                    $message_to_teacher = $getRecord->getMessageToSingle($getRecord->id,2);
                                    $message_to_student = $getRecord->getMessageToSingle($getRecord->id, 3);
                                    $message_to_parent = $getRecord->getMessageToSingle($getRecord->id, 4);
                                @endphp
                                <div class="form-group">
                                    <label style="display: block;">Message To</label>
                                    <label style="margin-right: 10px;">
                                        <input {{ !empty($message_to_student) ? 'checked' : '' }} type="checkbox" value="3" name="message_to[]"> Student
                                    </label>
                                    <label style="margin-right: 10px;">
                                        <input {{ !empty($message_to_parent) ? 'checked' : '' }} type="checkbox" value="4" name="message_to[]"> Parent
                                    </label>
                                    <label>
                                        <input {{ !empty($message_to_teacher) ? 'checked' : '' }} type="checkbox" value="2" name="message_to[]"> Teacher
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea id="summernote" name="message" class="form-control editor" placeholder="Message">{{ $getRecord->message }}</textarea>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Update</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

