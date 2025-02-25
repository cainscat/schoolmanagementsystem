@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Admin</h3>
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

                                <div class="form-group">
                                    <label>Profile Pic <span style="color: red;"></span></label>
                                    <input type="file" class="form-control" name="profile_pic">
                                    <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                                    @if(!empty($getRecord->getProfileDirect()))
                                        <img style="width: 100px;" src="{{ $getRecord->getProfileDirect() }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" name="name" required placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ old('email',$getRecord->email) }}" name="email" required placeholder="Enter Email">
                                    <div style="color: red">{{ $errors->first('email') }}</div>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Enter Password">
                                    <p>Do you want to change password, so please add</p>
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Update</button></div>
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
