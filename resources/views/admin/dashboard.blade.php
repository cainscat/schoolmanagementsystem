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
                <h3>${{ number_format($getTotalFees) }}</h3>
                <p>Received Payment</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-bag"></i>
              </div>
              <a href="" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>${{ number_format($getTotalTodayFees) }}</h3>
                <p>Today Received Payment</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-bag"></i>
              </div>
              <a href="" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalStudent }}</h3>
                <p>Total Student</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('admin/student/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-warning">
              <div class="inner">
                <h3>{{ $TotalTeacher }}</h3>
                <p>Total Teacher</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('admin/teacher/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalParent }}</h3>
                <p>Total Parent</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('admin/parent/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
              <div class="inner">
                <h3>{{ $TotalAdmin }}</h3>
                <p>Total Admin</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('admin/admin/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-danger">
              <div class="inner">
                <h3>{{ $TotalExam }}</h3>
                <p>Total Exam</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-table"></i>
              </div>
              <a href="{{ url('admin/examinations/exam/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalClass }}</h3>
                <p>Total Class</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-speedometer"></i>
              </div>
              <a href="{{ url('admin/class/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
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
              <a href="{{ url('admin/subject/list') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>
</main>

@endsection
