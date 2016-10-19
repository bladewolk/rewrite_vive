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
                                {{ Form::radio('device_id', $device->id , !$index) }}
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
                                Device: {{ $event->device->name}}<br>
                                Duration: {{ $event->duration }} <br>
                                Price: {{ $event->total_price }}
                            </div>
                            <div class="pull-right">
                                @if ($event->status == 'active')
                                    @if ((\Carbon\Carbon::now()->diffInMinutes($event->updated_at)) <= $event->duration)
                                        <a class="btn btn-primary"
                                           href="{{ route('events.edit', ['id' => $event->id]) }}">Edit
                                        </a>
                                        <br> <h6> {{ $event->created_at }}</h6>
                                        <h6> Played Time
                                            {{ \Carbon\Carbon::now()->diffInMinutes($event->created_at) }}
                                            min.</h6>
                                        <h6> Time
                                            remaining {{ $event->duration - (\Carbon\Carbon::now()->diffInMinutes($event->created_at)) }}
                                            min.</h6>
                                    @else

                                        <br><h4> Canceled </h4>
                                        <h6> {{ $event->created_at }} </h6>

                                    @endif


                                @else

                                    <br><h4> Canceled by user </h4>
                                    <h6> {{ $event->created_at }} </h6>

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


