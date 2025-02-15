@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Marks Grade</h3>
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
                                    <label>Grade Name</label>
                                    <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="Grade Name">
                                </div>

                                <div class="form-group">
                                    <label>Percent From</label>
                                    <input type="number" class="form-control" required value="{{ old('percent_from', $getRecord->percent_from) }}" name="percent_from" placeholder="Percent From">
                                </div>

                                <div class="form-group">
                                    <label>Percent To</label>
                                    <input type="number" class="form-control" required value="{{ old('percent_to', $getRecord->percent_to) }}" name="percent_to" placeholder="Percent To">
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Submit</button> </div>
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
