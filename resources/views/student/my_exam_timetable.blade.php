@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Exam Timetable</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @foreach($getRecord as $value)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">{{ $value['name'] }}</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Day</th>
                                            <th>Exam Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                            <th>Full Marks</th>
                                            <th>Passing Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($value['exam'] as $valueS)
                                            <tr>
                                                <td>{{ $valueS['subject_name'] }}</td>
                                                <td>{{ date('l', strtotime($valueS['exam_date'])) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>
                                                <td>{{ date('h:i A', strtotime($valueS['start_time'])) }}</td>
                                                <td>{{ date('h:i A', strtotime($valueS['end_time'])) }}</td>
                                                <td>{{ $valueS['room_number'] }}</td>
                                                <td>{{ $valueS['full_marks'] }}</td>
                                                <td>{{ $valueS['passing_marks'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

