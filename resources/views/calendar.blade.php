@extends('layouts.site', ['pageTitle' => 'Calendar'])
@section('head')
<link href='{{ asset('/vendor/fullcalendar/core/main.css') }}' rel='stylesheet' />
<link href='{{ asset('/vendor/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('/vendor/fullcalendar/bootstrap/main.css') }}' rel='stylesheet' />

<script src='{{ asset('/vendor/fullcalendar/core/main.js') }}'></script>
<script src='{{ asset('/vendor/fullcalendar/daygrid/main.js') }}'></script>
<script src='{{ asset('/vendor/fullcalendar/bootstrap/main.js') }}'></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid','bootstrap'],
            themeSystem: 'bootstrap',
            height: 600,
            events: {!! $events !!}
        });

        calendar.render();
    });

</script>

@endsection
@section('content')
<div class="col-md-12 center">
    <div class="card shadow">
        <div class="card-header">Events Calendar <a href="{{ url('/create') }}" class="btn btn-primary float-right">Create Event</a></div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>
@endsection
