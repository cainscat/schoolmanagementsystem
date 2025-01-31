@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Student List (Total: {{ $getRecord->total() }})</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ url('admin/student/add') }}" class="btn btn-primary">Add New Student</a>
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
                                        <label>Class</label>
                                        <input type="text" class="form-control" value="{{ Request::get('class') }}" name="class" placeholder="Class">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Admission Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('admission_number') }}" name="admission_number" placeholder="Admission Number">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Admission Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('admission_date') }}" name="admission_date">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Roll Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('roll_number') }}" name="roll_number" placeholder="Roll Number">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Blood Group</label>
                                        <input type="text" class="form-control" value="{{ Request::get('blood_group') }}" name="blood_group" placeholder="Blood Group">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Religion</label>
                                        <input type="text" class="form-control" value="{{ Request::get('religion') }}" name="religion" placeholder="Religion">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>Caste</label>
                                        <input type="text" class="form-control" value="{{ Request::get('caste') }}" name="caste" placeholder="Caste">
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
                                        <label>Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ Request::get('mobie_number') }}" name="mobie_number" placeholder="Mobile Number">
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
                                        <label>Date</label>
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('admin/student/list') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>#</th>
                                        <th>Picture</th>
                                        <th style="min-width: 100px;">Student Name</th>
                                        <th style="min-width: 100px;">Parent Name</th>
                                        <th>Gender</th>
                                        <th style="min-width: 100px;">Date of Birth</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Blood Group</th>
                                        <th>Religion</th>
                                        <th>Class</th>
                                        <th>Admission Number</th>
                                        <th style="min-width: 100px;">Admission Date</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Roll Number</th>
                                        <th>Caste</th>
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
                                                @if(!empty($value->getProfile()))
                                                    <img style="width: 100px;" src="{{ $value->getProfile() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->height }}</td>
                                            <td>{{ $value->weight }}</td>
                                            <td>{{ $value->blood_group }}</td>
                                            <td>{{ $value->religion }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->admission_number }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->roll_number }}</td>
                                            <td>{{ $value->caste }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                            <td style="min-width: 120px;">
                                                <a href="{{ url('admin/student/edit/'.$value->id) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ url('admin/student/delete/'.$value->id) }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
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
