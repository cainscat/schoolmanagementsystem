@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Notice Board</h3>
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
                                    <input type="text" class="form-control" required value="{{ old('title') }}" name="title" placeholder="Title">
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Notice Date</label>
                                            <input type="date" class="form-control" name="notice_date">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Publish Date</label>
                                            <input type="date" class="form-control" name="publish_date">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label style="display: block;">Message To</label>
                                    <label style="margin-right: 10px;"><input type="checkbox" value="3" name="message_to[]">Student</label>
                                    <label style="margin-right: 10px;"><input type="checkbox" value="4" name="message_to[]">Parent</label>
                                    <label><input type="checkbox" value="2" name="message_to[]">Teacher</label>
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea id="summernote" name="message" class="form-control editor" placeholder="Message"></textarea>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

