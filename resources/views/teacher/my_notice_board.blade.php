@extends('layouts.app')
    @section('style')
        <link rel="stylesheet" href="{{ url('public/dist/css/adminlte3.min.css') }}">
    @endsection
@section('content')
<main class="app-main">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 style="text-align: center;">Notice Board</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 float-right">
                    <div class="card card-primary">
                        <form action="" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title" placeholder="Enter Title">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Notice Date From</label>
                                        <input type="date" class="form-control" value="{{ Request::get('notice_date_from') }}" name="notice_date_from">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Notice Date To</label>
                                        <input type="date" class="form-control" value="{{ Request::get('notice_date_to') }}" name="notice_date_to">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('teacher/my_notice_board') }}" style="margin-top: 30px;" class="btn btn-success">Reset</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @foreach($getRecord as $value)
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                        <div class="card-body p-0">
                            <div class="mailbox-read-info">
                                <h3>{{ $value->title }}</h3>
                                <h6 style="margin-bottom: 0; margin-top: 5px; color: #000; font-size: 15px;">{{ date('d-m-Y', strtotime($value->notice_date)) }}</h6>
                            </div>
                            <div class="mailbox-read-message">
                                {!! $value->message !!}
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div style="float:right;">
                        {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>
                </div>

            </div>
        </div>
      </section>
    </div>
</main>
@endsection

@section('script')
@endsection
