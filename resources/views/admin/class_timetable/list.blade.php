@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Class Timetable</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')

                    <div class="card card-primary">
                        <form action="" method="get">
                            <div class="card-header">
                                <h3 class="card-title">Search</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Class Name</label>
                                        <select class="form-control getClass" name="class_id" required>
                                            <option value="">Select</option>
                                            @foreach($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{  $class->id }}">{{  $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Subject Name</label>
                                        <select class="form-control getSubject" name="subject_id" required>
                                            <option value="">Select</option>
                                            @if(!empty($getSubject))
                                                @foreach($getSubject as $subject)
                                                    <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{  $subject->subject_id }}">{{  $subject->subject_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/class_timetable/list') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    @if(!empty(Request::get('class_id') && Request::get('subject_id')))
                        <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Class Timetable</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($week as $value)
                                            <tr>
                                                <th>
                                                    {{ $value['week_name'] }}
                                                </th>
                                                <td>
                                                    <input type="time" name="start_time" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="time" name="end_time" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" style="width: 150px;" name="room_number" class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div style="padding: 10px;">
                                    <button class="btn btn-primary" name="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
    <script>
        $('.getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                url: "{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id:class_id,
                },
                dataType:"json",
                success:function(response){
                    $('.getSubject').html(response.html);
                },
            });
        });
    </script>
@endsection
