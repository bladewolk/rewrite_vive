@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom: 22px">
        <div class="col-md-8 col-md-offset-2">
            <a class="btn btn-primary alert-link pull-right" href="{{ route('users.create') }}">Add new</a>

        </div>
    </div>
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
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection