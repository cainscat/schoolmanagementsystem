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
                                            <th>Subject</th>
                                            <th>Class Work</th>
                                            <th>Home Work</th>
                                            <th>Test Work</th>
                                            <th>Exam</th>
                                            <th>Total Score</th>
                                            <th>Passing Marks</th>
                                            <th>Full Marks</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalScore = 0;
                                            $fullMarks = 0;
                                            $result_validation = 0;
                                        @endphp
                                        @foreach ($value['subject'] as $exam)
                                            @php
                                                $totalScore = $totalScore + $exam['total_score'];
                                                $fullMarks = $fullMarks + $exam['full_marks'];
                                            @endphp
                                            <tr>
                                                <td style="width: 200px;">{{ $exam['subject_name'] }}</td>
                                                <td>{{ $exam['class_work'] }}</td>
                                                <td>{{ $exam['home_work'] }}</td>
                                                <td>{{ $exam['test_work'] }}</td>
                                                <td>{{ $exam['exam'] }}</td>
                                                <td>{{ $exam['total_score'] }}</td>
                                                <td>{{ $exam['passing_marks'] }}</td>
                                                <td>{{ $exam['full_marks'] }}</td>
                                                <td>
                                                    @if($exam['total_score'] >= $exam['passing_marks'])
                                                        <span style="color: green; font-weight: bold;">Pass</span>
                                                    @else
                                                        @php
                                                            $result_validation = 1;
                                                        @endphp
                                                        <span style="color: red; font-weight: bold;">Fail</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="2">
                                                    <b>Grand Total: {{ $totalScore }}/{{ $fullMarks }}</b>
                                                </td>
                                                <td colspan="3">
                                                    @php
                                                        $percentage = ($totalScore * 100) /  $fullMarks;
                                                        $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                                    @endphp
                                                    <b>Percentage: {{ round($percentage,2)}}%</b>
                                                </td>
                                                <td colspan="3">
                                                    <b>Grade: {{ $getGrade }}</b>
                                                </td>
                                                <td colspan="1">
                                                    <b>Result:</b>
                                                        @if($result_validation == 0)
                                                            <b style="color: green;">Pass</b>
                                                        @else
                                                            <b style="color: red;">Fail</b>
                                                        @endif
                                                </td>
                                            </tr>
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
