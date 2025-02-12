@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Exam Result</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">

                @foreach($getRecord as $value)
                    <div class="col-md-12">
                        @include('layouts._message')

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <b>Exam: </b>
                                    <span style="color: blue;">{{ $value['exam_name'] }}</span>
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Class Work</th>
                                            <th>Home Work</th>
                                            <th>Test Work</th>
                                            <th>Exam</th>
                                            <th>Total Score</th>
                                            <th>Passing Marks</th>
                                            <th>Full Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($value['subject'] as $exam)
                                            <tr>
                                                <td>{{ $exam['subject_name'] }}</td>
                                                <td>{{ $exam['class_work'] }}</td>
                                                <td>{{ $exam['home_work'] }}</td>
                                                <td>{{ $exam['test_work'] }}</td>
                                                <td>{{ $exam['exam'] }}</td>
                                                <td>{{ $exam['total_score'] }}</td>
                                                <td>{{ $exam['passing_marks'] }}</td>
                                                <td>{{ $exam['full_marks'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
