@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::model($device, ['method'=>'PUT', 'route' =>['devices.update', $device->id]]) }}
            {{ Form::label('Device name') }}
            {{ Form::text('name','', ['class' =>'form-control']) }}
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
