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
            <div class="small-box text-bg-success">
              <div class="inner">
                <h3>{{ $TotalStudent }}</h3>
                <p>Total Student</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-person-add"></i>
              </div>
              <a href="{{ url('teacher/my_student') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
              <div class="inner">
                <h3>{{ $TotalClass }}</h3>
                <p>Total Class</p>
              </div>
              <div class="icon">
                <i class="nav-icon bi bi-table"></i>
              </div>
              <a href="{{ url('teacher/my_class_subject') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
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
              <a href="{{ url('teacher/my_class_subject') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
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
                <i class="nav-icon bi bi-speedometer"></i>
              </div>
              <a href="{{ url('teacher/my_notice_board') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                More info <i class="bi bi-link-45deg"></i>
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>
</main>

@endsection
