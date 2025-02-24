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
                        <span style="color: blue;">{{ $getStudent->name }} {{ $getStudent->last_name }}</span>
                        Fees Collection
                    </h3>
                </div>

                <div class="col-sm-6" style="text-align: right;">
                    <button type="button" id="AddFees" class="btn btn-primary">Add Fees</button>
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
                            <h3 class="card-title">Payment Detail</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Total Amount ($)</th>
                                        <th>Paid Amount ($)</th>
                                        <th>Remaning Amount ($)</th>
                                        <th>Payment Type</th>
                                        <th>Remark</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($getFees))
                                        @forelse ($getFees as $value)
                                            <tr class="align-middle">
                                                <td>{{ $value->class_name }}</td>
                                                <td>${{ $value->total_amount }}</td>
                                                <td>${{ number_format($value->paid_amount) }}</td>
                                                <td>${{ number_format($value->remaning_amount) }}</td>
                                                <td>{{ $value->payment_type }}</td>
                                                <td>{{ $value->remark }}</td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/fees_collection/collect_fees/add_fees'.$value->id) }}" class="btn btn-sm btn-success">Collect Fees</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="AddFeesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="mb-3">
                    <label class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Total Amount: ${{ number_format($getStudent->amount) }}</label>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Paid Amount: ${{ number_format($paid_amount) }}</label>
                </div>

                <div class="mb-3">
                    @php
                        $remaningAmount = $getStudent->amount - $paid_amount;
                    @endphp
                    <label class="col-form-label">Remaning Amount: ${{ number_format($remaningAmount) }}</label>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Amount <span style="color: red">*</span></label>
                    <input type="number" class="form-control" name="amount">
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Payment Type <span style="color: red">*</span></label>
                    <select name="payment_type" class="form-control" required>
                        <option value="">Select</option>
                        <option value="paypal">Paypal</option>
                        <option value="stripe">Stripe</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Remark</label>
                    <textarea class="form-control" name="remark"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('#AddFees').click(function() {
        $('#AddFeesModal').modal('show');
    });
</script>
@endsection
