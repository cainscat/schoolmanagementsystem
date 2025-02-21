@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">Collect Fees</h3>
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
                                        <label>Class</label>
                                        <select name="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $class)
                                                <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Student ID</label>
                                        <input type="text" class="form-control" value="{{ Request::get('student_id') }}" name="student_id" placeholder="Student ID">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Student Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('student_name') }}" name="student_name" placeholder="Student Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/fees_colection/collect_fees') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class Name</th>
                                        <th>Total Amount ($)</th>
                                        <th>Paid Amount ($)</th>
                                        <th>Remaning Amount ($)</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getRecord))
                                        @forelse ($getRecord as $value)
                                            @php
                                                $paidAmount = $value->getPaidAmount($value->id, $value->class_id);
                                                $remaningAmount = $value->amount - $paidAmount;
                                            @endphp
                                            <tr class="align-middle">
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>${{ number_format($value->amount) }}</td>
                                                <td>${{ number_format($paidAmount) }}</td>
                                                <td>${{ number_format($remaningAmount) }}</td>
                                                <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/fees_colection/collect_fees/add_fees/'.$value->id) }}" class="btn btn-sm btn-success">Collect Fees</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%">Record not found!</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="100%">Record not found!</td>
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

@section('script')

@endsection
