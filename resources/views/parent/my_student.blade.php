@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Student List</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Profile Pic</th>
                                        <th style="min-width: 100px;">Student Name</th>
                                        <th>Gender</th>
                                        <th style="min-width: 100px;">Date of Birth</th>
                                        <th>Height</th>
                                        <th>Weight</th>
                                        <th>Blood Group</th>
                                        <th>Religion</th>
                                        <th>Class</th>
                                        <th>Admission Number</th>
                                        <th style="min-width: 100px;">Admission Date</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Roll Number</th>
                                        <th>Caste</th>
                                        <th style="min-width: 100px;">Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr class="align-middle" style="text-align: center;">
                                            <td>
                                                @if(!empty($value->getProfile()))
                                                    <img style="width: 100px;" src="{{ $value->getProfile() }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->name }} {{ $value->last_name }}</td>
                                            <td>{{ $value->gender }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->height }}</td>
                                            <td>{{ $value->weight }}</td>
                                            <td>{{ $value->blood_group }}</td>
                                            <td>{{ $value->religion }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->admission_number }}</td>
                                            <td>
                                                @if(!empty($value->date_of_birth))
                                                    {{ date('d-m-Y', strtotime($value->admission_date)) }}
                                                @endif
                                            </td>
                                            <td>{{ $value->mobile_number }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->roll_number }}</td>
                                            <td>{{ $value->caste }}</td>
                                            <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ url('parent/my_student/subject/'.$value->id) }}">Subject</a>
                                            </td>
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
