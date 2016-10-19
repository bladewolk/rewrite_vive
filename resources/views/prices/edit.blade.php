@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form-group">
            {{ Form::model($price, ['method'=>'PATCH', 'route' =>['prices.update', $price->id]]) }}
            {{ Form::label('minTime') }}
            {{ Form::number('minTime','', ['class' =>'form-control']) }}
            {{ Form::label('Price for 1 minute') }}
            {{ Form::text('value','', ['class' =>'form-control']) }}
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
