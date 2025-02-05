@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        <span style="color: blue">{{ $getStudent->name }} {{ $getStudent->last_name }}'s</span>
                        Class Timetable
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ $getClass->name }} - {{ $getSubject->name }}
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $valueW)
                                            <tr>
                                                <td>
                                                    {{ $valueW['week_name'] }}
                                                </td>
                                                <td>{{ !empty($valueW['start_time']) ? date('h:i A', strtotime($valueW['start_time'])) : '' }}</td>
                                                <td>{{ !empty($valueW['end_time']) ? date('h:i A', strtotime($valueW['end_time'])) : '' }}</td>
                                                <td>{{ $valueW['room_number'] }}</td>
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

