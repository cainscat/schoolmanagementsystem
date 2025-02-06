@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Exam Schedule</h3>
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
                        <form action="" method="get">
                            <div class="card-header">
                                <h3 class="card-title">Search</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Exam</label>
                                        <select name="exam_id" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach($getExam as $exam)
                                                <option {{ (Request::get('exam_id') == $exam->id ? 'selected' : '') }} value="{{ $exam->id }}">{{ $exam->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Class</label>
                                        <select name="class_id" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id ? 'selected' : '') }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/examinations/exam_schedule') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    @if(!empty($getRecord))
                        <form action="{{ url('admin/examinations/exam_schedule_insert') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                            <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                            <div class="card mb-4 mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">Exam List</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subject Name</th>
                                                <th>Exam Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Room Number</th>
                                                <th>Full Marks</th>
                                                <th>Passing Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($getRecord as $value)
                                                <tr class="align-middle">
                                                    <td style="min-width: 150px;">
                                                        {{ $value['subject_name'] }}
                                                        <input type="hidden" class="form-control" value="{{ $value['subject_id'] }}" name="schedule[{{ $i }}][subject_id]">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" value="{{ $value['exam_date'] }}" name="schedule[{{ $i }}][exam_date]">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" value="{{ $value['start_time'] }}" name="schedule[{{ $i }}][start_time]">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" value="{{ $value['end_time'] }}" name="schedule[{{ $i }}][end_time]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $value['room_number'] }}" name="schedule[{{ $i }}][room_number]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $value['full_marks'] }}" name="schedule[{{ $i }}][full_marks]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $value['passing_marks'] }}" name="schedule[{{ $i }}][passing_marks]">
                                                    </td>
                                                </tr>
                                            @php
                                                $i++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div style="padding: 10px;">
                                        <button class="btn btn-primary" name="submit">Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
