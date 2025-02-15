@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Marks Register</h3>
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
                                        <a href="{{ url('admin/examinations/marks_register') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    @if(!empty($getSubject) && !empty($getSubject->count()))
                        <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Marks Register</h3>
                            </div>
                            <div class="card-body p-0" style="overflow: auto;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            @foreach($getSubject as $subject)
                                                <th>
                                                    {{ $subject->subject_name }} <br>
                                                    ({{ $subject->subject_type }} : {{ $subject->passing_marks }} / {{ $subject->full_marks }})
                                                </th>
                                            @endforeach
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($getStudent) && !empty($getStudent->count()))
                                            @foreach ($getStudent as $student)
                                            <form action="" method="POST" class="SubmitForm">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                <tr class="align-middle">
                                                    <td style="min-width: 150px;">
                                                        {{ $student->name }} {{ $student->last_name }}
                                                    </td>
                                                    @php
                                                        $i = 1;
                                                        $totalStudentMark = 0;
                                                        $totalFullMark = 0;
                                                        $totalPassingMark = 0;
                                                        $pass_fail_vali = 0;
                                                    @endphp
                                                    @foreach($getSubject as $subject)
                                                        @php
                                                            $totalMark = 0;
                                                            $totalFullMark = $totalFullMark + $subject->full_marks;
                                                            $totalPassingMark = $totalPassingMark + $subject->passing_marks;

                                                            $getMark = $subject->getMark($student->id,Request::get('exam_id'),Request::get('class_id'), $subject->subject_id);
                                                            if(!empty($getMark))
                                                            {
                                                                $totalMark = $getMark->class_work + $getMark->home_work + $getMark->test_work + $getMark->exam;
                                                            }
                                                            $totalStudentMark = $totalStudentMark + $totalMark;
                                                        @endphp
                                                        <td>
                                                            <div style="display: flex;">
                                                                <div>
                                                                    <div style="margin-bottom: 10px; margin-right: 10px;">
                                                                        Class Work

                                                                        <input name="mark[{{ $i }}][full_marks]" type="hidden" value="{{ $subject->full_marks }}">
                                                                        <input name="mark[{{ $i }}][passing_marks]" type="hidden" value="{{ $subject->passing_marks }}">
                                                                        <input name="mark[{{ $i }}][id]" type="hidden" value="{{ $subject->id }}">
                                                                        <input name="mark[{{ $i }}][subject_id]" type="hidden" value="{{ $subject->subject_id }}">
                                                                        <input name="mark[{{ $i }}][class_work]" id="class_work_{{ $student->id }}{{ $subject->subject_id }}" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                    <div style="margin-bottom: 10px;">
                                                                        Home Work
                                                                        <input style="width: 105px;" id="home_work_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][home_work]" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div style="margin-bottom: 10px; margin-right: 10px;">
                                                                        Test Work
                                                                        <input style="width: 105px;" id="test_work_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][test_work]" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                    <div>
                                                                        Exam
                                                                        <input style="width: 105px;" id="exam_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][exam]" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <button type="button" class="btn btn-success SaveSingleSubject" id="{{ $student->id }}" data-schedule="{{ $subject->id }}" data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" data-class="{{ Request::get('class_id') }}">
                                                                    Save Single
                                                                </button>
                                                            </div>

                                                            @if(!empty($getMark))
                                                                <div>
                                                                    <b>Total Mark: </b>{{ $totalMark }} <br>
                                                                    <b>Passing Mark: </b>{{ $subject->passing_marks }} <br>
                                                                    @php
                                                                        $getLoopGrade = App\Models\MarksGradeModel::getGrade($totalMark);
                                                                    @endphp
                                                                    @if(!empty($getLoopGrade))
                                                                        <b>Grade: </b>{{ $getLoopGrade }} <br>
                                                                    @endif
                                                                    @if($totalMark >= $subject->passing_marks)
                                                                        <b>Result: </b><span style="color: green; font-weight: bold;">Pass</span>
                                                                    @else
                                                                        <b>Result: </b><b>Result: </b><span style="color: red; font-weight: bold;">Fail</span>
                                                                        @php
                                                                            $pass_fail_vali = 1;
                                                                        @endphp
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </td>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    <td style="width: 150px;">
                                                        <button type="submit" class="btn btn-primary">Save All</button>
                                                        @if(!empty($totalStudentMark))
                                                            <br>
                                                            <b>Total Student Mark:</b> {{ $totalStudentMark }}
                                                            <br>
                                                            <b>Total Subject Mark:</b> {{ $totalFullMark }}
                                                            <br>
                                                            <b>Total Passing Mark:</b> {{ $totalPassingMark }}
                                                            <br>
                                                            @php
                                                                $percentage = ($totalPassingMark * 100) / $totalFullMark;
                                                                $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                                            @endphp
                                                            <b>Percentage: </b>{{ round($percentage,2) }}%
                                                            @if(!empty($getGrade))
                                                                <br>
                                                                <b>Grade: </b>{{ $getGrade }}
                                                            @endif
                                                            @if($pass_fail_vali == 0)
                                                                <br>
                                                                <b>Result: </b><span style="color: green; font-weight: bold;">Pass</span>
                                                            @else
                                                            <b>Result: </b><span style="color: red; font-weight: bold;">Fail</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            </form>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

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
    $('.SubmitForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ url('admin/examinations/submit_marks_register') }}",
            data : $(this).serialize(),
            dataType: "json",
            success: function(data) {
                alert(data.message);
            }
        });
    });

    $('.SaveSingleSubject').click(function(e){
        var student_id = $(this).attr('id');
        var subject_id = $(this).attr('data-val');
        var exam_id = $(this).attr('data-exam');
        var class_id = $(this).attr('data-class');
        var id = $(this).attr('data-schedule');
        var class_work = $('#class_work_'+student_id+subject_id).val();
        var home_work = $('#home_work_'+student_id+subject_id).val();
        var test_work = $('#test_work_'+student_id+subject_id).val();
        var exam = $('#exam_'+student_id+subject_id).val();

        $.ajax({
            type: "POST",
            url: "{{ url('admin/examinations/single_submit_marks_register') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                id : id,
                student_id : student_id,
                subject_id : subject_id,
                exam_id : exam_id,
                class_id : class_id,
                class_work : class_work,
                home_work : home_work,
                test_work : test_work,
                exam : exam,
            },
            dataType: "json",
            success: function(data) {
                alert(data.message);
            }
        });

    });
</script>
@endsection
