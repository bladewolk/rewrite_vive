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
                            <a class="btn btn-primary" href="{{ action('AdminController@updateUser', $user->id) }}">Edit</a>

                            <a class="btn btn-danger" href="{{ action('AdminController@destroyUser', $user->id) }}">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <a style="float:right" class="btn btn-primary" href="createnewuser" class="alert-link">Add new</a>
@endsection