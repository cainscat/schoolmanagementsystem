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
                            <div class="card-body p-0">
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
                                                    @endphp
                                                    @foreach($getSubject as $subject)
                                                        @php
                                                            $getMark = $subject->getMark($student->id,Request::get('exam_id'),Request::get('class_id'), $subject->subject_id);
                                                        @endphp
                                                        <td>
                                                            <div style="display: flex;">
                                                                <div>
                                                                    <div style="margin-bottom: 10px; margin-right: 10px;">
                                                                        Class Work
                                                                        <input style="width: 105px;" name="mark[{{ $i }}][subject_id]" type="hidden" value="{{ $subject->subject_id }}">
                                                                        <input style="width: 105px;" name="mark[{{ $i }}][class_work]" value="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                    <div style="margin-bottom: 10px;">
                                                                        Home Work
                                                                        <input style="width: 105px;" name="mark[{{ $i }}][home_work]" value="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div style="margin-bottom: 10px; margin-right: 10px;">
                                                                        Test Work
                                                                        <input style="width: 105px;" name="mark[{{ $i }}][test_work]" value="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                    <div>
                                                                        Exam
                                                                        <input style="width: 105px;" name="mark[{{ $i }}][exam]" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" type="text" class="form-control" placeholder="Enter Marks">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    <td>
                                                        <button type="submit" class="btn btn-primary">Save</button>
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
    })
</script>
@endsection
