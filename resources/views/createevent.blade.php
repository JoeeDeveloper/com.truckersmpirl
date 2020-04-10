@extends('layouts.site', ['pageTitle' => 'Create Event'])
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">Create Event</div>
            <div class="card-body">
                <form action="{{ route('createEvent') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Event Description</label>
                        <input type="text" class="form-control" name="description" id="description">
                    </div>
                    <div class="form-group">
                        <label for="date">Event Date/s</label>
                        <div class="row">
                        <div class="col"><input type="date" class="form-control" name="startDate" id="startDate"></div> to
                            <div class="col"><input type="date" class="form-control" name="finishDate" id="finishDate"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection
