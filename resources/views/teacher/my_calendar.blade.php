@extends('layouts.app')
@section('style')
<style>
    .fc-daygrid-event {
    white-space: normal;
    }
</style>
@endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                       My Calendar
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src='{{ url('public/dist/fullcalendar/index.global.js') }}'></script>
<script>
    var events = new Array();

    @foreach($getClassTimeTable as $value)
        events.push({
                title: '{{ $value->class_name }} - {{ $value->subject_name }}',
                daysOfWeek: [ {{ $value->fullcalendar_day }} ],
                startTime: "{{ $value->start_time }}",
                endTime: "{{ $value->end_time }}",
            });
    @endforeach

    var calendarID = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarID, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: '<?=date('Y-m-d')?>',
        navLinks: true,
        editable: false,
        events: events,
        // initialView: 'timeGridWeek',
    });

    calendar.render();
</script>
@endsection
