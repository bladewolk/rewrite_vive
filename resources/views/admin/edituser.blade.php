@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::model($user, ['method'=>'PATCH', 'route' =>['admin.update', $user->id]]) }}
            <label for="comment">Name: </label>
            {{ Form::text('name','', ['class' =>'form-control', 'placeholder' => $user->name]) }}
            <label for="comment">Username:</label>
            {{ Form::text('username','', ['class' =>'form-control', 'placeholder' => $user->username]) }}
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
