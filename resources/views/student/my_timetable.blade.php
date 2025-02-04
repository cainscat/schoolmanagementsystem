@extends('layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Timetable</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._message')

                    @foreach($getRecord as $value)
                        <div class="card mb-4 mt-3">
                            <div class="card-header">
                                <h3 class="card-title">{{ $value['name'] }}</h3>
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
                                        {{-- @php
                                            $i = 1;
                                        @endphp --}}
                                        @foreach($value['week'] as $valueW)
                                            <tr>
                                                <td>
                                                    {{ $valueW['week_name'] }}
                                                </td>
                                                <td>{{ !empty($valueW['start_time']) ? date('h:i A', strtotime($valueW['start_time'])) : '' }}</td>
                                                <td>{{ !empty($valueW['end_time']) ? date('h:i A', strtotime($valueW['end_time'])) : '' }}</td>
                                                <td>{{ $valueW['room_number'] }}</td>
                                            </tr>
                                        {{-- @php
                                            $i++;
                                        @endphp --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
    <script>
        $('.getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                url: "{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id:class_id,
                },
                dataType:"json",
                success:function(response){
                    $('.getSubject').html(response.html);
                },
            });
        });
    </script>
@endsection
