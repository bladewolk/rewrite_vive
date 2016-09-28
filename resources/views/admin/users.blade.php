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
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <button class="btn btn-default" style="float:right; margin-right: 2%;">New user</button>
@endsection