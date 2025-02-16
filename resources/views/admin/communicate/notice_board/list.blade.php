@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Notice Board</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/communicate/notice_board/add') }}" class="btn btn-primary">Add New Notice Board</a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')
                    {{-- <div class="card card-primary">
                        <form action="" method="get">
                            <div class="card-header">
                                <h3 class="card-title">Search</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Enter Name">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Enter Email">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/admin/list') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div> --}}

                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Notice Board List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Notice Date</th>
                                        <th>Publish Date</th>
                                        <th>Message To</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->title }}</td>
                                            <td>{{ date('d-m-Y',strtotime($value->notice_date)) }}</td>
                                            <td>{{ date('d-m-Y',strtotime($value->publish_date)) }}</td>
                                            <td>
                                                @foreach ($value->getMessage as $message)
                                                    @if($message->message_to == 2)
                                                        <div>Teacher</div>
                                                    @elseif($message->message_to == 3)
                                                        <div>Student</div>
                                                    @elseif($message->message_to == 4)
                                                        <div>Parent</div>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/communicate/notice_board/edit/'.$value->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ url('admin/communicate/notice_board/delete/'.$value->id) }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">Record not found!</td>
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
