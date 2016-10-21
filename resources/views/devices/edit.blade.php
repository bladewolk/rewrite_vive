@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group col-md-3 col-md-offset-5">
            {{ Form::model($device, ['method'=>'PUT', 'route' =>['devices.update', $device->id]]) }}
            {{ Form::label('Device name') }}
            {{ Form::text('name', $device->name , ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
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
