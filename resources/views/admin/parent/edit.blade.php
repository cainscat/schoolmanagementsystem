@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Parent</h3>
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
                                        <input type="text" class="form-control" required value="{{ old('name', $getRecord->name) }}" name="name" placeholder="First Name">
                                        <div style="color: red">{{ $errors->first('name') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Last Name <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" required value="{{ old('last_name', $getRecord->last_name) }}" name="last_name" placeholder="Last Name">
                                        <div style="color: red">{{ $errors->first('last_name') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Gender <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="gender">
                                            <option value="">Select Gender</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'male') ? 'selected' : '' }} value="male">Male</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'female') ? 'selected' : '' }} value="female">Female</option>
                                            <option {{ (old('gender', $getRecord->gender) == 'other') ? 'selected' : '' }} value="other">Other</option>
                                        </select>
                                        <div style="color: red">{{ $errors->first('gender') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Mobile Number <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('mobile_number', $getRecord->mobile_number) }}" name="mobile_number" placeholder="Mobile Number">
                                        <div style="color: red">{{ $errors->first('mobile_number') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Profile Pic <span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="profile_pic">
                                        <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                        @if(!empty($getRecord->getProfileDirect()))
                                            <img style="width: 100px;" src="{{ $getRecord->getProfileDirect() }}">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Occupation <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('occupation', $getRecord->occupation) }}" name="occupation" placeholder="Occupation">
                                        <div style="color: red">{{ $errors->first('occupation') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Address <span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ old('address', $getRecord->address) }}" name="address" placeholder="Address">
                                        <div style="color: red">{{ $errors->first('address') }}</div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Status <span style="color: red;">*</span></label>
                                        <select class="form-control" required name="status">
                                            <option value="">Select Status</option>
                                            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Active</option>
                                            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Inactive</option>
                                        </select>
                                        <div style="color: red">{{ $errors->first('status') }}</div>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" required value="{{ old('email', $getRecord->email) }}" name="email" placeholder="Enter Email">
                                    <div style="color: red">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Password <span style="color: red;"></span></label>
                                    <input type="text" class="form-control" name="password" placeholder="Enter Password">
                                    <p>Do you want to change password, so please add new password</p>
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
