@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::open(['route' => 'prices.store']) }}
            @foreach($devices as $device)
            {{ Form::radio('device_id', $device->device_id , true) }}
            <label> {{ $device->name }} </label><br>
            @endforeach
            <label for="comment">Min Time:</label>
            {{ Form::text('minTime','', ['class' =>'form-control']) }}
            <label for="comment">Price:</label>
            {{ Form::text('price','', ['class' =>'form-control']) }}
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
