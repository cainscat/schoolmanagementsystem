@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Parent Student List ({{ $getParent->name }} {{ $getParent->last_name }})</h3>
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
                            <div class="card-header">
                                <h3 class="card-title">Search</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-2">
                                        <label>Student ID</label>
                                        <input type="text" class="form-control" value="{{ Request::get('id') }}" name="id" placeholder="Student ID">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="First Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="{{ Request::get('last_name') }}" name="last_name" placeholder="Last Name">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Email</label>
                                        <input type="text" class="form-control" value="{{ Request::get('email') }}" name="email" placeholder="Email">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/parent/my-student/'.$parent_id) }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                @if(!empty($getSearchStudent))
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Parent Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th style="min-width: 100px;">Student Name</th>
                                        <th>Email</th>
                                        <th style="min-width: 100px;">Parent Name</th>
                                        <th style="min-width: 100px;">Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getSearchStudent as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if(!empty($value->getProfile()))
                                                    <img style="width: 100px;" src="{{ $value->getProfile() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->parent_name }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ url('admin/parent/assign_student_parent/'.$value->id.'/'.$parent_id) }}" class="btn btn-primary btn-sm">Add Student to Parent</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="margin-top: 5px; float:right;">
                                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
                            </div>
                        </div>
                    </div>
                @endif
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Parent Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th style="min-width: 100px;">Student Name</th>
                                        <th>Email</th>
                                        <th style="min-width: 100px;">Parent Name</th>
                                        <th style="min-width: 100px;">Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if(!empty($value->getProfile()))
                                                    <img style="width: 100px;" src="{{ $value->getProfile() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->parent_name }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td style="text-align: center;">
                                                <a href="{{ url('admin/parent/assign_student_parent_delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="margin-top: 5px; float:right;">
                                {{-- {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} --}}
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
