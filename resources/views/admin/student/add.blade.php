@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New Student</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>First Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" required value="{{ old('name') }}" name="name" placeholder="First Name">
                                        <div style="color: red">{{ $errors->first('name') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Last Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" required value="{{ old('last_name') }}" name="last_name" placeholder="Last Name">
                                        <div style="color: red">{{ $errors->first('last_name') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Gender <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender') == 'male') ? 'selected' : '' }} value="male">Male</option>
                                            <option {{ (old('gender') == 'female') ? 'selected' : '' }} value="female">Female</option>
                                            <option {{ (old('gender') == 'other') ? 'selected' : '' }} value="other">Other</option>
                                        </select>
                                        <div style="color: red">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Date of Birth <span style="color: red;"></span></label>
                                        <input type="date" class="form-control" required value="{{ old('date_of_birth') }}" name="date_of_birth">
                                        <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Profile Pic <span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="profile_pic">
                                        <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Height <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('height') }}" name="height" placeholder="Height">
                                        <div style="color: red">{{ $errors->first('height') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Weight <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('weight') }}" name="weight" placeholder="Weight">
                                        <div style="color: red">{{ $errors->first('weight') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Blood Group <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('blood_group') }}" name="blood_group" placeholder="Blood Group">
                                        <div style="color: red">{{ $errors->first('blood_group') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Class <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="class_id">
                                            <option value="">Select Class</option>
                                            @foreach($getClass as $value)
                                                <option {{ (old('class_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        <div style="color: red">{{ $errors->first('class_id') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Mobile Number <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" placeholder="Mobile Number">
                                        <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Admission Number <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" required value="{{ old('admission_number') }}" name="admission_number" placeholder="Admission Number">
                                        <div style="color: red">{{ $errors->first('admission_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Admission Date <span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date" required>
                                        <div style="color: red">{{ $errors->first('admission_date') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Religion <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('religion') }}" name="religion" placeholder="Religion">
                                        <div style="color: red">{{ $errors->first('religion') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Roll Number <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" placeholder="Roll Number">
                                        <div style="color: red">{{ $errors->first('roll_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Caste <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('caste') }}" name="caste" placeholder="Caste">
                                        <div style="color: red">{{ $errors->first('caste') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Status <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                        <div style="color: red">{{ $errors->first('status') }}</div>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" required value="{{ old('email') }}" name="email" placeholder="Enter Email">
                                    <div style="color: red">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Password <span style="color: red;">*</span></label>
                                    <input type="password" class="form-control" required name="password" placeholder="Enter Password">
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
