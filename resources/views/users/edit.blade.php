@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group col-xs-5 col-xs-offset-4">
            {{ Form::model($user, ['method'=>'PATCH', 'route' =>['users.update', $user->id]]) }}
            <label for="comment">Name: </label>
            {{ Form::text('name', $user->name, ['class' =>'form-control']) }}
            <label for="comment">Username:</label>
            {{ Form::text('username', $user->username, ['class' =>'form-control']) }}
            <label for="comment">Password:</label>
            {{ Form::text('password','', ['class' =>'form-control', 'placeholder' => 'enter new password']) }}
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
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
