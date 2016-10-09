@extends('layouts.app')
@section('content')

    @if(Auth::user())
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ Form::open(['url' => 'HomeController@create']) }}
                            @foreach($data as $device)
                                {{ Form::radio('device_id', $device->device_id , true) }}
                                {{ Form::label('device_name', $device->name) }}
                            @endforeach
                            <br>
                            {{ Form::label('email', 'Duration') }}
                            {{ Form::number('price', '10', ['id' => 'ajaxP', 'min' => '0', 'max' => '240']) }}
                            <button class="btn btn-success">Add</button>
                            <br>
                            {{ Form::label('calculate', ' ', ['id' => 'calculated']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="display: inline-block; float:left">
                            Username <br>
                            Device: Oculus<br>
                            Duration: 30 min<br>
                            Price: 54$
                        </div>
                        <div style="float:right">
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Cancel</button>
                            <br> <h6>Created at 12:40</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div style="display: inline-block; float:left">
                            Username <br>
                            Device: Oculus<br>
                            Duration: 30 min<br>
                            Price: 54$
                        </div>
                        <div style="float:right">
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Cancel</button>
                            <br> <h6>Created at 12:40</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


