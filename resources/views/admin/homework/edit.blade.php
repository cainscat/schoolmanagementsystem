@extends('layouts.app')
@section('style')

@endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Homework</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Class <span style="color: red">*</span></label>
                                    <select class="form-control" id="getClass" name="class_id" required>
                                        <option value="">Select Class</option>
                                        @foreach($getClass as $class)
                                            <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Subject <span style="color: red">*</span></label>
                                    <select class="form-control" id="getSubject" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                        @foreach($getSubject as $subject)
                                            <option {{ ($getRecord->subject_id == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Homework Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" value="{{ $getRecord->homework_date }}" name="homework_date" required>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Submission Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" value="{{ $getRecord->submission_date }}" name="submission_date" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Document</label>
                                    <input type="file" class="form-control" name="document_file">
                                    @if(!empty($getRecord->getDocument()))
                                        <a style="margin-top: 5px;" href="{{ $getRecord->getDocument() }}" class="btn btn-sm btn-success" download="">Download File</a>
                                    @endif
                                </div>

                                <div class="form-group mt-2">
                                    <label>Description</label>
                                    <textarea id="summernote" name="description" class="form-control editor" placeholder="Description">{{ $getRecord->description }}</textarea>
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

@section('script')
<script>
    $(document).ready(function() {
        $('#getClass').change(function(){
            var class_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/homework/ajax_get_subject') }}",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    class_id : class_id,
                },
                dataType: "json",
                success: function(data) {
                    $('#getSubject').html(data.success);
                }
            });
        });
    });
</script>
@endsection
