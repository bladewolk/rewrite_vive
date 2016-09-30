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
    <a style="float:right" class="btn btn-primary" href="{{ route('devices.create') }}" class="alert-link">New Device</a>
@endsection