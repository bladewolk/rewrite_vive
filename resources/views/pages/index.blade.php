@extends('layouts.app')
@section('content')

    @if(Auth::user())
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <div class="panel-body form-group">
                        {{ Form::open(['route' => 'events.store']) }}
                        @foreach($devices as $index => $device)
                            {{ Form::radio('device_id', $device->id , !$index) }}
                            {{ Form::label('device_name', $device->name) }}
                        @endforeach
                        <br>
                        {{ Form::label('email', 'Duration') }}
                        {{ Form::text('duration', '10', [
                                'id' => 'ajaxPriceCalculate',
                                'min' => '0',
                                'max' => '240',
                                'autocomplete' => 'off',
                                'class' => 'form-control'
                            ])
                        }}
                        <button class="btn btn-success pull-right">Add</button>
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
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="pull-left">
                                Name: {{ $event->user->name }} <br>
                                Device: {{ $event->device->name}}<br>
                                Duration: {{ $event->duration }} <br>
                                Price: {{ $event->total_price }}
                            </div>
                            <div class="pull-right">
                                @if ((\Carbon\Carbon::now()->diffInSeconds($event->created_at)) <= $event->duration*60)
                                    <a class="btn btn-primary"
                                       href="{{ route('events.edit', ['id' => $event->id]) }}">Edit
                                    </a>
                                    <br> <h6> {{ $event->created_at }}</h6>
                                    <h6> Played Time
                                        {{  \Carbon\Carbon::now()->diffInMinutes($event->created_at) }}
                                        min.</h6>
                                    <h6> Time
                                        remaining
                                        {{ $event->duration - (\Carbon\Carbon::now()->diffInMinutes($event->created_at)) }}
                                        min.</h6>
                                @else

                                    <br><h4> Canceled </h4>
                                    <h6> {{ $event->created_at }} </h6>

                                @endif
                                @if ($event->records->count())
                                    <button class="btn btn-info" onclick="showEdits({{ $event->id }})">SHOW EDITS
                                    </button>
                                @endif

                            </div>

                        </div>
                        <div class="panel-body records" style="display: none" data-event-id="{{ $event->id }}">
                            @foreach($event->records as $record)
                                {{ $record->description }} <br>
                            @endforeach
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
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{  $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection


