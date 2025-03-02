<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print the Exam Result</title>
    <style>
        @page {
            size: 8.3in 11.7in;
        }
        @page {
            size: A4;
        }
        .page-container {
            display: flex;
        }
        .page-container h2{
            font-size: 20px;
        }
        .margin-bottom  {
            margin-bottom: 3px;
        }
        .table-bg {
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
            text-align: center;
        }

        .table-bg th {
            border: 1px solid;
            padding: 10px;
        }

        .table-bg td {
            border: 1px solid;
            padding: 3px;
        }

        .table-bg .text-container {
            text-align: left;
            padding-left: 5px;
        }

        @media print {
            @page {
                margin: 0;
                margin-left: 20px;
                margin-right: 20px;
            }
        }
    </style>
</head>
<body>
    <div id="page">
        <div class="page-container">
            <table style="width: 50%">
                <tr>
                    <td width="5%"></td>
                    <td width="15%"><img style="width: 80px;" src="{{ $getSetting->getLogo() }}" alt=""></td>
                    <td align="center">
                        <h2>{!! $getSetting->school_full_name  !!}</h2>
                    </td>
                    <td></td>
                </tr>
            </table>
            <table style="width: 50%; float: right;">
                <tr>
                    <td width="5%"></td>
                    <td align="center">
                        <h2>SOCIALIST REPUBLIC OF VIETNAM <br>
                            <span style="font-size: 16px;">Independence - Liberty - Happiness</span>
                        </h2>
                        <br>

                    </td>
                    <td></td>
                </tr>
            </table>
        </div>

        <table style="width: 100%; text-align: center;">
            <tr>
                <td width="5%"></td>
                <td align="center">
                    <h2>SCORE TABLE</h2>
                </td>
                <td></td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td width="5%"></td>
                <td width="70%">
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="27%">Name Of Student: </td>
                                <td style="border-bottom:1px solid; width:100%">{{ $getStudent->name }} {{ $getStudent->last_name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Admission No: </td>
                                <td style="border-bottom:1px solid; width:100%">{{ $getStudent->admission_number }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Class: </td>
                                <td style="border-bottom:1px solid; width:100%">{{ $getClass->class_name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="11%">Term: </td>
                                <td style="border-bottom:1px solid; width:100%">{{ $getExam->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td width="5%"></td>
                <td width="20%" valign="top">
                    <img style="border-radius: 6px; height: 100px; width: 100px;" src="{{ $getStudent->getProfileDirect() }}" alt="">
                    <br>
                    Gender: {{ $getStudent->gender }}
                </td>
            </tr>
        </table>
        <br>
        <div>
            <table class="table-bg">
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
                    @foreach ($getExamMark as $exam)
                        @php
                            $totalScore = $totalScore + $exam['total_score'];
                            $fullMarks = $fullMarks + $exam['full_marks'];
                        @endphp
                        <tr>
                            <td class="text-container">{{ $exam['subject_name'] }}</td>
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

        <div>
            <p>{!! $getSetting->exam_description !!}</p>
        </div>

        <table class="margin-bottom" style="width: 100%">
            <tbody>
                <tr>
                    <td width="15%">Signature: </td>
                    <td style="border-bottom:1px solid; width:100%"></td>
                </tr>
            </tbody>
        </table>

    </div>



    <script>
        window.print();
    </script>
</body>
</html>
