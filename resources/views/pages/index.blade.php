@extends('layouts.app')
@section('content')

    @if(Auth::user())
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ Form::open(['route' => 'events.store']) }}
                            @foreach($devices as $index => $device)
                                {{ Form::radio('device_id', $device->device_id , !$index) }}
                                {{ Form::label('device_name', $device->name) }}
                            @endforeach
                            <br>
                            {{ Form::label('email', 'Duration') }}
                            {{ Form::text('duration', '10', ['id' => 'ajaxPriceCalculate', 'min' => '0', 'max' => '240', 'autocomplete' => 'off']) }}
                            <button class="btn btn-success">Add</button>
                            <br>
                            {{ Form::label('calculate', ' ', ['id' => 'calculated']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @foreach($events as $event)
        <div class="container" id="{{$event->id}}">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="visible-lg-inline-block pull-left">
                                Name: {{ $event->user->name }} <br>
                                Device: {{ $event->device->name }} <br>
                                Duration: {{ $event->duration }} <br>
                                Price: {{ $event->total_price }}
                            </div>
                            <div class="pull-right">
                                @if ( (\Carbon\Carbon::now()->diffInMinutes($event->updated_at)) < $event->duration && $event->status == 'active')
                                    <button class="btn btn-primary" onclick="editEvent({{ $event->id }})">Edit
                                    </button>
                                    <button class="cancel-event btn btn-danger" data-id="{{ $event->id }}">Cancel
                                    </button>
                                    <br> <h6> {{ $event->created_at }}</h6>
                                    <h6> Time
                                        remaining {{ $event->duration - (\Carbon\Carbon::now()->diffInMinutes($event->created_at)) }}
                                        min.</h6>
                                @else
                                    @if ($event->status == 'canceled')
                                        <button class="btn btn-info">Canceled by user</button>
                                    @endif
                                    <br> <h6> {{ $event->created_at }} </h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="hiddenEdit{{$event->id}}" style="display: none">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="visible-lg-inline-block pull-left">
                                Name: {{ $event->user->name }} <br>
                                Device: {{ $event->name }} <br>
                                Duration: {{ $event->duration }} <br>
                                Price: {{ $event->total_price }}
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary">Update</button>
                                Edit form
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="hiddenCancel{{$event->id}}" style="display: none">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <label>Description: </label>

                            <textarea id="ajaxCancelTextarea" name="description"></textarea>
                            <input hidden name="event_id" value="{{ $event->id }}">
                            <div class="pull-right">
                                <button class="cancel-button btn btn-danger" data-id="{{ $event->id }}">Do
                                    Cancel
                                </button>
                                Cancel form
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


