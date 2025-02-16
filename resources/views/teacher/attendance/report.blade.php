@extends('layouts.app')
@section('style')
@endsection
@section('content')
<main class="app-main">
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Attendance Report (Total: {{ $getRecord->total() }})</h3>
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

                                <div class="form-group col-md-2">
                                    <label>Student ID</label>
                                    <input type="text" name="student_id" value="{{ Request::get('student_id') }}" class="form-control" placeholder="Student ID">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Student Name</label>
                                    <input type="text" name="student_name" value="{{ Request::get('student_name') }}" class="form-control" placeholder="Student Name">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Class</label>
                                    <select name="class_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->class_id ? 'selected' : '') }} value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Attendance Date</label>
                                    <input type="date" name="attendance_date" value="{{ Request::get('attendance_date') }}" class="form-control">
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Attendance Type</label>
                                    <select name="attendance_type" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ (Request::get('attendance_type') == 1 ? 'selected' : '') }} value="1">Present</option>
                                        <option {{ (Request::get('attendance_type') == 2 ? 'selected' : '') }} value="2">Late</option>
                                        <option {{ (Request::get('attendance_type') == 3 ? 'selected' : '') }} value="3">Absent</option>
                                        <option {{ (Request::get('attendance_type') == 4 ? 'selected' : '') }} value="4">Half Day</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ url('teacher/attendance/report') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="card mb-4 mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Attendance List</h3>
                    </div>
                    <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Class Name</th>
                                    <th>Attendance Type</th>
                                    <th>Attendance Date</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($getRecord))
                                    @forelse($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->student_id }}</td>
                                            <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>
                                                @if($value->attendance_type == 1)
                                                    Present
                                                @elseif($value->attendance_type ==2)
                                                    Late
                                                @elseif($value->attendance_type ==3)
                                                    Absent
                                                @elseif($value->attendance_type ==4)
                                                    Half Day
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-y', strtotime($value->attendance_date)) }}</td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">Record not found</td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="100%">Record not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        @if(!empty($getRecord))
                            <div style="margin-top: 5px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</main>
@endsection

