@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group col-md-3 col-md-offset-5">
            {{ Form::open(['route' => ['users.store']]) }}
            <label for="comment">Name:</label>
            {{ Form::text('name','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            <label for="comment">Username:</label>
            {{ Form::text('username','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            <label for="comment">Password:</label>
            {{ Form::text('password','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
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
