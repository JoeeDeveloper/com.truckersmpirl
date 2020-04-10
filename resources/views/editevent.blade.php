@extends('layouts.site', ['pageTitle' => 'Edit'.{{$event->name}}])
@section('content')
<div class="col-md-12 center">
    <div class="card">
        <div class="card-header">Events Calendar</div>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>
@endsection
