@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::model($event, ['method'=>'PATCH', 'route' =>['events.update', $event->id]]) }}
            {{ Form::label('Select mode') }} <br>
            {{ Form::radio('mode', 'edit') }}
            {{ Form::label('edit') }} <br>
            {{ Form::radio('mode', 'cancel') }}
            {{ Form::label('cancel') }} <br>
            {{ Form::label('New Duration (Will be added to current time)') }}
            {{ Form::label($event->duration) }}
            {{ Form::number('duration','', ['class' =>'form-control']) }}
            {{ Form::label('Description') }}
            {{ Form::textarea('description','', ['class' =>'form-control']) }}
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
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