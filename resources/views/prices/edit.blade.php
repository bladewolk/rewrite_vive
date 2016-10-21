@extends('layouts.app')

@section('content')
    <div class="container col-md-3 col-md-offset-5">
        <div class="form-group">
            {{ Form::model($price, ['method'=>'PATCH', 'route' =>['prices.update', $price->id]]) }}
            {{ Form::label('minTime') }}
            {{ Form::number('minTime',$price->minTime, ['class' =>'form-control', 'autocomplete' => 'off']) }}
            {{ Form::label('Price for 1 minute') }}
            {{ Form::text('value',$price->value, ['class' =>'form-control', 'autocomplete' => 'off']) }}
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
