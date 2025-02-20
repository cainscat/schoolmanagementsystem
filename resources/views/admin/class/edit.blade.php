@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Class</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Class Name</label>
                                    <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name" placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label>Amount ($)</label>
                                    <input type="number" class="form-control" value="{{ $getRecord->amount }}" required name="amount" placeholder="Amount">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ ($getRecord->status == 1) ? 'selected' : '' }}  value="1">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Update</button> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
