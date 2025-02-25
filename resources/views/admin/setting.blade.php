@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Setting</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label>School Name</label>
                                    <input type="text" class="form-control" value="{{ old('school_name', $getRecord->school_name) }}" name="school_name" required placeholder="School Name">
                                </div>

                                <div class="form-group">
                                    <label>Paypal Business Email</label>
                                    <input type="email" class="form-control" value="{{ $getRecord->paypal_email }}" name="paypal_email" required placeholder="Paypal Business Email">
                                </div>

                                <div class="form-group">
                                    <label>Stripe Public Key</label>
                                    <input type="text" class="form-control" value="{{ $getRecord->stripe_key }}" name="stripe_key">
                                </div>

                                <div class="form-group">
                                    <label>Stripe Secret</label>
                                    <input type="text" class="form-control" value="{{ $getRecord->stripe_secret }}" name="stripe_secret">
                                </div>

                                <div class="form-group">
                                    <label>Logo <span style="color: red;"></span></label>
                                    <input type="file" class="form-control" name="logo">
                                    @if(!empty($getRecord->getLogo()))
                                        <img style="width: 100px;" src="{{ $getRecord->getLogo() }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Fevicon Icon <span style="color: red;"></span></label>
                                    <input type="file" class="form-control" name="fevicon_icon">
                                    @if(!empty($getRecord->getFevicon()))
                                        <img style="width: 100px;" src="{{ $getRecord->getFevicon() }}">
                                    @endif
                                </div>

                            </div>
                            <div class="card-footer"> <button type="submit" class="btn btn-primary">Save</button></div>
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
