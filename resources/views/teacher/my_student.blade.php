@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Student</h3>
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
                                        <button style="margin-top: 23px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('teacher/my_student') }}" style="margin-top: 23px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">My Student</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Picture</th>
                                        <th style="min-width: 100px;">Student Name</th>
                                        <th>Gender</th>
                                        <th style="min-width: 100px;">Date of Birth</th>
                                        <th>Religion</th>
                                        <th>Class</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Roll Number</th>
                                        <th>Caste</th>
                                        <th style="min-width: 100px;">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>
                                                @if(!empty($value->getProfile()))
                                                    <img style="width: 100px;" src="{{ $value->getProfile() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->religion }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->roll_number }}</td>
                                            <td>{{ $value->caste }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
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
