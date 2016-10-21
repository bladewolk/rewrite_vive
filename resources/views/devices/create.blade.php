@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group col-md-3 col-md-offset-5">
            {{ Form::open(['route' => 'devices.store']) }}
            {{ Form::label('Device name') }}
            {{ Form::text('name','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
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
