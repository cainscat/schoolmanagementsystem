@extends('layouts.app')
@section('style')
        <link rel="stylesheet" href="{{ url('public/dist/css/adminlte3.min.css') }}">
@endsection
@section('content')

<main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
        </div>
      </div>
    </div>
    <div class="app-content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>${{ number_format($TotalPaidAmount) }}</h3>
                <p>Total Paid Amount</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-bag"></i>
              </div>
              <a href="{{ url('student/fees_collection') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalSubject }}</h3>
                <p>Total Subject</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-speedometer"></i>
              </div>
              <a href="{{ url('student/my_subject') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
              <div class="inner">
                <h3>{{ $TotalNotice }}</h3>
                <p>Notice Board</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('student/my_notice_board') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
              <div class="inner">
                <h3>{{ $TotalHomework }}</h3>
                <p>Homework</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-table"></i>
              </div>
              <a href="{{ url('student/my_homework') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalSubmittedHomework }}</h3>
                <p>Submitted Homework</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-speedometer"></i>
              </div>
              <a href="{{ url('student/my_submitted_homework') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
              <div class="inner">
                <h3>{{ $TotalAttendance }}</h3>
                <p>Attendance</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-speedometer"></i>
              </div>
              <a href="{{ url('student/my_attendance') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>



        </div>

      </div>
    </div>
</main>

@endsection
