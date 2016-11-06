@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::model($event, ['method'=>'PATCH', 'route' =>['events.update', $event->id]]) }}
            {{ Form::label('New Duration (Will be added to current time)') }}
            {{ Form::label($event->duration) }}
            {{ Form::number('duration','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::label('Description') }}
            {{ Form::textarea('description','', ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::submit('Update', ['name', 'class' => 'btn btn-primary']) }}
            {{ Form::submit('Cancel', ['name', 'class' => 'btn btn-danger']) }}
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
