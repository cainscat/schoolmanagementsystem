@extends('layouts.app')
@section('style')

@endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Homework</h3>
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
                                            <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Subject <span style="color: red">*</span></label>
                                    <select class="form-control" id="getSubject" name="subject_id" required>
                                        <option value="">Select Subject</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label>Homework Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" value="" name="homework_date" required>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Submission Date <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" value="" name="submission_date" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Document</label>
                                    <input type="file" class="form-control" name="document_file">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Description</label>
                                    <textarea id="summernote" name="description" class="form-control editor" placeholder="Description"></textarea>
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

@section('script')
<script>
    $(document).ready(function() {
        $('#getClass').change(function(){
            var class_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('teacher/homework/ajax_get_subject') }}",
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
