@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::open(['route' => 'prices.store']) }}
            @foreach($devices as $device)
            {{ Form::radio('device_id', $device->device_id , true) }}
            {{ Form::label($device->name) }}<br>
            @endforeach
            {{ Form::label('minTime') }}
            {{ Form::number('minTime','', ['class' =>'form-control']) }}
            {{ Form::label('Price') }}
            {{ Form::number('price','', ['class' =>'form-control']) }}
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
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
