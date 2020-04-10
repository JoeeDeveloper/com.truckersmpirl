@extends('layouts.site', ['pageTitle' => $event->title])
@section('content')
<div class="row justify-content-center">
    <div class="col-md-2">
        <div class="card shadow">
            <div class="card-header">
                <h2>Edit Event</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('updateEvent', $event) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $event->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Event Description</label>
                        <input type="text" class="form-control" name="description" id="description" value="{{ $event->description }}">
                    </div>
                    <div class="form-group">
                        <label for="date">Event Date/s</label>
                        <div class="row">
                        <div class="col"><input type="date" class="form-control" name="startDate" id="startDate" value="{{ $event->date_start }}"></div>
                            <div class="col"><input type="date" class="form-control" name="finishDate" id="finishDate" value="{{ $event->date_finish }}"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Event</button>
                    </div>
                </form>
                    <div class="form-group">
                        <form action="{{ route('deleteEvent', $event) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete Event</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        <h1>{{ $event->title }} | ID: {{ $event->id }}</h1>
                    </div>
                    <div class="col-md-1"><span style="color: {{ $colour }};"><i data-toggle="tooltip"
                                data-placement="top" title="{{ $message }}"
                                class="fas fa-{{ $icon }}-circle fa-3x float-right"></i></span></div>
                </div>
            </div>
            <div class="card-body">
                <p><b>Start Date:</b> {{ date('d-n-Y', strtotime($event->date_start)) }}</p>
                <p><b>End Date:</b> {{ date('d-n-Y', strtotime($event->date_finish)) }}</p>
                <p><b>Details:</b></p>
                <p>{{ $event->description }}</p>
                <form method="POST" action="{{ route('attendEvent', [$event->id]) }}">
                    @csrf
                    @if($event->date_start < $today)
                        <button class="btn btn-secondary" disabled>This events over!</button>
                    @elseif($event->users->contains($user))
                        <button type="submit" class="btn btn-danger">Not Attending</button>
                    @else
                        <button type="submit" class="btn btn-success">Attending</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card shadow">
            <div class="card-header">
                <h2>Attendees: {{ count($event->users) }}</h2>
                <small>
                    @if($event->users->contains($user))
                        You <b>ARE</b> attending this event!
                    @else
                        You are <b>NOT</b> attending this event!
                    @endif
                </small>
            </div>
            <div class="card-body">
                @foreach($event->users as $user)
                    <span class="badge badge-pill badge-primary" href="#">{{ $user->name }}</span>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
});
</script>
@endsection
