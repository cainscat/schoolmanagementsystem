@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Class & Subject</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">My Class & Subject</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>Class Timetable</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->subject_type }}</td>
                                            <td>
                                                @php
                                                    $ClassSubject = $value->getMyTimetable($value->class_id,$value->subject_id);
                                                @endphp
                                                @if(!empty($ClassSubject))
                                                    <strong>{{ date('h:i A', strtotime($ClassSubject->start_time)) }}</strong> to <strong>{{ date('h:i A', strtotime($ClassSubject->end_time)) }}</strong>
                                                    <br>
                                                    <strong>Room:</strong> <b style="color: red">{{ $ClassSubject->room_number }}</b>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('teacher/my_class_subject/class_timetable/'.$value->class_id.'/'.$value->subject_id) }}" class="btn btn-primary btn-sm">My Class Timetable</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
