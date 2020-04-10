@extends('layouts.site', ['pageTitle' => 'Events Table'])
@section('head')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">Events Table
                    @if (request()->has('deleted'))
                        <a class="btn btn-primary float-right" href="{{ url('/eventstable') }}">dont show</a>
                    @else
                        <a class="btn btn-primary float-right" href="{{ url('/eventstable'.'?deleted') }}">show deleted it</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="eventsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                              @can('Manage Events')
                                <th>Options</th>
                              @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->date_start }}</td>
                                <td>{{ $event->date_finish }}</td>
                                @can('Manage Events')
                                <td><a class="btn btn-warning" href="{{ url('events/'.$event->id)}}">Edit</a>
                                @endcan
                                @if($event->trashed())
                                <form action="{{ route('restoreEvent', $event) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Restore</button>
                                </form>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready( function () {
    $('#eventsTable').DataTable();
    } );</script>
@endsection
