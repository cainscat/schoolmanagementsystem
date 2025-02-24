@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="mb-0">
                        Collect Fees Report
                    </h3>
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

                                    <div class="form-group col-md-2">
                                        <label>Student Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('student_name') }}" name="student_name" placeholder="Student Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Payment Type</label>
                                        <select name="payment_type" class="form-control">
                                            <option value="">Select</option>
                                            <option {{ (Request::get('payment_type') == 'cash' ? 'selected' : '') }} value="cash">Cash</option>
                                            <option {{ (Request::get('payment_type') == 'paypal' ? 'selected' : '') }} value="paypal">Paypal</option>
                                            <option {{ (Request::get('payment_type') == 'stripe' ? 'selected' : '') }} value="stripe">Stripe</option>
                                            <option {{ (Request::get('payment_type') == 'cheque' ? 'selected' : '') }} value="cheque">Cheque</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Start Created Date</label>
                                        <input type="date" name="start_created_date" value="{{ Request::get('start_created_date') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>End Created Date</label>
                                        <input type="date" name="end_created_date" value="{{ Request::get('end_created_date') }}" class="form-control">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/fees_collection/collect_fees_report') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Report List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class Name</th>
                                        <th>Total Amount ($)</th>
                                        <th>Paid Amount ($)</th>
                                        <th>Remaning Amount ($)</th>
                                        <th>Payment Type</th>
                                        <th>Remark</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getRecord))
                                        @forelse ($getRecord as $value)
                                            <tr class="align-middle">
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->student_id }}</td>
                                                <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>${{ $value->total_amount }}</td>
                                                <td>${{ number_format($value->paid_amount) }}</td>
                                                <td>${{ number_format($value->remaning_amount) }}</td>
                                                <td>{{ $value->payment_type }}</td>
                                                <td>{{ $value->remark }}</td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
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
