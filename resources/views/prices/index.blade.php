@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="margin-bottom: 22px">
            <div class="col-md-8 col-md-offset-2">
                <a class="btn btn-primary alert-link pull-right" href="{{ route('prices.create') }}">New
                    Price</a>
            </div>
        </div>
        @foreach($prices as $price)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device: {{ $price->device->name }} <br>
                            Min Time: {{ $price->minTime }} <br>
                            Price: {{ $price->value }} <br>
                            @if (!$price->deleted_at)

                                {{ Form::open(['route' => ['prices.destroy', $price->id], 'method' => 'delete', 'style' => 'text-align:right'])  }}
                                <a class="btn btn-primary"
                                   href="{{ route('prices.edit', ['id' => $price->id]) }}">Edit</a>
                                {{ Form::submit('Delete', ['class'=>'btn btn-danger', 'style' => 'text-align:right']) }}
                                {{ Form::close() }}
                            @else
                                {{ Form::model($price, ['method'=>'PUT', 'route' =>['prices.update', $price->id], 'style' => 'text-align:right']) }}
                                {{ Form::submit('Restore', ['class' => 'btn btn-info', 'name' => 'action']) }}
                                {{ Form::close() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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