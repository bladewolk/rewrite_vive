@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 22px">
            <div class="col-md-8 col-md-offset-2">
                <a href="{{ route('devices.create') }}" class="btn btn-primary alert-link pull-right">New</a>
            </div>
        </div>
        @foreach($devices as $device)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device ID: {{ $device->id }} <br>
                            Device name: {{ $device->name }} <br>
                            @if ($device->exists())
                                {{ Form::open(['route' => ['devices.destroy', $device->id], 'method' => 'delete', 'style' => 'text-align:right']) }}
                                <a class="btn btn-primary" href="{{route('devices.edit', ['id' => $device->id])}}"
                                   class="alert-link">Edit</a>
                                {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            @else
                                {{ Form::model($device, ['method'=>'PUT', 'route' =>['devices.update', $device->id], 'style' => 'text-align:right']) }}
                                {{ Form::submit('Restore', ['class' => 'btn btn-info', 'name' => 'action']) }}
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

