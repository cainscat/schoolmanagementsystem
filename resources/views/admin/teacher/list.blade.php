@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Teacher List (Total: {{ $getRecord->total() }})</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/teacher/add') }}" class="btn btn-primary">Add New Teacher</a>
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

                                    <div class="form-group col-md-2">
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('mobie_number') }}" name="mobie_number" placeholder="Mobile Number">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Current Adress</label>
                                        <input type="text" class="form-control" value="{{ Request::get('address') }}" name="address" placeholder="Current Adress">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (Request::get('gender') == 'male') ? 'selected' : '' }} value="male">Male</option>
                                            <option {{ (Request::get('gender') == 'female') ? 'selected' : '' }} value="female">Female</option>
                                            <option {{ (Request::get('gender') == 'other') ? 'selected' : '' }} value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Marital Status</label>
                                        <input type="text" class="form-control" value="{{ Request::get('marital_status') }}" name="marital_status" placeholder="Marital Status">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option>
                                            <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">InActive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Date of Joining</label>
                                        <input type="date" class="form-control" value="{{ Request::get('admission_date') }}" name="admission_date">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Created Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/teacher/list') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Teacher List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Picture</th>
                                        <th style="min-width: 100px;">Teacher Name</th>
                                        <th>Gender</th>
                                        <th style="min-width: 100px;">Date of Birth</th>
                                        <th>Date of Joining</th>
                                        <th>Marital Status</th>
                                        <th>Current Address</th>
                                        <th>Permanent Address</th>
                                        <th>Qualification</th>
                                        <th>Work Experience</th>
                                        <th>Note</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th style="min-width: 100px;">Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if(!empty($value->getProfileDirect()))
                                                    <img style="width: 100px;" src="{{ $value->getProfileDirect() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($value->admission_date))
                                                    {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->marital_status }}</td>
                                            <td>{{ $value->address }}</td>
                                            <td>{{ $value->permanent_address }}</td>
                                            <td>{{ $value->qualification }}</td>
                                            <td>{{ $value->work_experience }}</td>
                                            <td>{{ $value->note }}</td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            <td style="min-width: 140px;">
                                                <a href="{{ url('admin/teacher/edit/'.$value->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                <a href="{{ url('chat?receiver_id='.base64_encode($value->id)) }}" class="btn btn-sm btn-success"><i class="bi bi-chat-left-dots-fill"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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
