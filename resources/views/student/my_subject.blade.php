@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Subject</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">My Subject</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle">
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->subject_type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
