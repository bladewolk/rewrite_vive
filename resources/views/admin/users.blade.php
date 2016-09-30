@extends('layouts.app')

@section('content')
    @foreach($users as $user)
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        Name: {{ $user->name }} <br>
                        Username: {{ $user->username }} <br>
                        Admin permission: {{ $user->isAdmin }}
                        <div style="float: right">
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>

                            {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'style' => 'display: inline-block']) }}
                            <button class="btn btn-danger" type="submit" >Delete</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <a style="float:right" class="btn btn-primary" href="{{ route('users.create') }}" class="alert-link">Add new</a>
@endsection