@extends('layouts.app')

@section('content')
    @foreach($devices as $device)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device ID: {{ $device->device_id }} <br>
                            Device name: {{ $device->name }} <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <a class="btn btn-primary alert-link pull-right" href="{{ route('devices.create') }}">New Device</a>
@endsection