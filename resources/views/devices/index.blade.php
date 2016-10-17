@extends('layouts.app')

@section('content')
    @foreach($devices as $device)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device ID: {{ $device->id }} <br>
                            Device name: {{ $device->name }} <br>
                            <div class="pull-right">

                                {{ Form::open(['route' => ['devices.destroy', $device->id], 'method' => 'delete', 'style' => 'text-align:right']) }}
                                <a class="btn btn-primary" href="{{route('devices.edit', ['id' => $device->id])}}" class="alert-link">Edit</a>
                                {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <a class="btn btn-primary alert-link pull-right" href="{{ route('devices.create') }}">New Device</a>
@endsection