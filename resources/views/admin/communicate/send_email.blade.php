@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('public/dist/css/select2.min.css') }}">
    <style>
        .select2-container--default .select2-selection--single{
            height: 38px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 35px;
        }
    </style>
@endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Send Email</h3>
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
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" required value="{{ old('title') }}" name="subject" placeholder="Subject">
                                </div>

                                <div class="form-group mt-2">
                                    <label>Message to User (Select to single send)</label>
                                    <select name="user_id" class="form-control select2" style="width: 100%;">
                                    <option value="">Select</option>
                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label style="display: block;">Message to Type (Select to all send)</label>
                                    <label style="margin-right: 10px;"><input type="checkbox" value="3" name="message_to[]">Student</label>
                                    <label style="margin-right: 10px;"><input type="checkbox" value="4" name="message_to[]">Parent</label>
                                    <label><input type="checkbox" value="2" name="message_to[]">Teacher</label>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Message</label>
                                    <textarea id="summernote" name="message" class="form-control editor" placeholder="Message" style="height: 300px;"></textarea>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Send Email</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="{{ url('public/dist/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            ajax: {
                url: '{{ url('admin/communicate/search_user') }}',
                dataType: 'json',
                delay: 250,
                data: function(data) {
                    return {
                        search: data.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results:response
                    };
                },
            }
        });
    });
</script>
@endsection
