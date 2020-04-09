@extends('layouts.site', ['pageTitle' => 'Edit Calendar'])
@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" />
@endsection
{{-- @section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function () {

        $('#input-group .input-group.date').datepicker({
            todayBtn: "linked"
        });

    })
</script>
@endsection --}}
@section('content')
<div class="col-md-6">
    <div class="card">
        <div class="card-header">Create new calendar event.</div>
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
                    {{-- <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="input-sm form-control" name="start"/>
                        <span class="input-group-addon">to</span>
                        <input type="text" class="input-sm form-control" name="end" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <div class="input-group">
                    <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
