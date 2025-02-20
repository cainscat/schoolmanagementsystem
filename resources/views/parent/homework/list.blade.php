@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <span style="color: blue;">{{ $getStudent->name }} {{ $getStudent->last_name }}'s</span>
                        Homework
                    </h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('parent/my_student/submitted_homework/'.$getStudent->id) }}" class="btn btn-success">Submitted Homework</a>
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
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" name="subject_name" placeholder="Subject">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Homework Date From</label>
                                        <input type="date" class="form-control" value="{{ Request::get('homework_date_from') }}" name="homework_date_from">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Homework Date To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('homework_date_to') }}" name="homework_date_to">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Submission Date From</label>
                                        <input type="date" class="form-control" value="{{ Request::get('submission_date_from') }}" name="submission_date_from">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Submission Date To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('submission_date_to') }}" name="submission_date_to">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Created Date From</label>
                                        <input type="date" class="form-control" value="{{ Request::get('created_date_from') }}" name="created_date_from">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Created Date To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('created_date_to') }}" name="created_date_to">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('parent/my_student/homework/'.$getStudent->id) }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Homework List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Homwork Date</th>
                                        <th>Submission Date</th>
                                        <th>Document</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ date('d-m-Y',strtotime($value->homework_date)) }}</td>
                                            <td>{{ date('d-m-Y',strtotime($value->submission_date)) }}</td>
                                            <td>
                                                @if(!empty($value->getDocument()))
                                                    <a href="{{ $value->getDocument() }}" class="btn btn-sm btn-success" download="">Download</a>
                                                @endif
                                            </td>
                                            <td>{!! $value->description !!}</td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">
                                                Have no homework!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div style="margin-top: 5px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
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
