@extends('layouts.app')
@section('content')

    @if(Auth::user())
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ Form::open(['url' => '/create']) }}
                            @foreach($devices as $device)
                                {{ Form::radio('device_id', $device->device_id , true) }}
                                {{ Form::label('device_name', $device->name) }}
                            @endforeach
                            <br>
                            {{ Form::label('email', 'Duration') }}
                            {{ Form::number('duration', '10', ['id' => 'ajaxP', 'min' => '0', 'max' => '240']) }}
                            <button class="btn btn-success">Add</button>
                            <br>
                            {{ Form::label('calculate', ' ', ['id' => 'calculated']) }}
                            {{ Form::hidden('username', Auth::user()->name) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @foreach($events as $event)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div style="display: inline-block; float:left">
                                Name: {{ $event->username }} <br>
                                Device: {{ $event->device_id }} <br>
                                Duration: {{ $event->duration }} <br>
                                Price: {{ $event->total_price }} $
                            </div>
                            <div style="float:right">
                                @if ( (\Carbon\Carbon::now()->diffInMinutes($event->created_at)) < $event->duration)
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-danger">Cancel</button>
                                    <br> <h6> {{ $event->created_at }}</h6>
                                     <h6> Time
                                        remaining {{ $event->duration - (\Carbon\Carbon::now()->diffInMinutes($event->created_at)) }} min.</h6>
                                @else
                                    <button class="btn btn-info">Canceled</button>
                                    <br> <h6> {{ $event->created_at }} </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ $events->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection


