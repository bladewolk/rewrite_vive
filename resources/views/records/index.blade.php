@extends('layouts.app')

@section('content')
    @foreach($events as $event)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Event ID: {{ $event->event_id }} <br>
                            User ID: {{ $event->user_id }} <br>
                            Status: {{ $event->status }} <br>
                            Description: {{ $event->description }} <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <a class="btn btn-primary alert-link pull-right" href="{{ route('prices.create') }}">New Price</a>
@endsection