@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container col-md-3 col-md-offset-5">
            {{ Form::open(['route' => 'prices.store']) }}
            @foreach($devices as $index => $device)
                {{ Form::radio('device_id', $device->id, !$index) }}
                {{ Form::label($device->name) }}<br>
            @endforeach
            {{ Form::label('minTime') }}
            {{ Form::text('minTime','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::label('Price for 1 minute') }}
            {{ Form::text('value','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }} <br>
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
