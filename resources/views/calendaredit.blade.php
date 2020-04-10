@extends('layouts.site', ['pageTitle' => 'Edit Calendar'])
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create new calendar event.</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Event Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter event name.">
                        </div>
                        <div class="form-group">
                            <label for="description">Event Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                placeholder="Enter event description.">
                        </div>
                        <div class="form-group">
                            <label for="date">Event Date</label>
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="input-sm form-control" name="start" />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="input-sm form-control" name="end" />
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Edit calendar event.</div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter event name.">
                    </div>
                    <div class="form-group">
                        <label for="description">Event Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                            placeholder="Enter event description.">
                    </div>
                    <div class="form-group">
                        <label for="date">Event Date</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="start" />
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" name="end" />
                        </div>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Delete calendar event.</div>
            <div class="card-body">
                <form method="POST" id="deleteEventForm" action="{{ route('calendarDelete', $events[0]->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="event">Select event to be deleted.</label>
                        <select class="form-control" id="event" name="event" onchange="updateDeleteForm()">
                            @foreach($events as $event)
                                <option>{{ $event->title }}</option>
                            @endforeach
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <small>Events will be permanently deleted and non-recoverable.</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.input-daterange').datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1
        });

        function updateDeleteForm()
        {
            var event = document.getElementById('event').value
            var form = document.getElementById('deleteEventForm')
            var url = "{{ route('calendarDelete', ':slug') }}"

            url = url.replace(':slug', event)

            form.action = url
        }
    </script>
@endsection
