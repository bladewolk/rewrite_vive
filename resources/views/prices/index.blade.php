@extends('layouts.app')

@section('content')
    @foreach($prices as $price)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device: {{ $price->device->name }} <br>
                            Min Time: {{ $price->minTime }} <br>
                            Price: {{ $price->value }} <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <a class="btn btn-primary alert-link pull-right" href="{{ route('prices.create') }}">New Price</a>
@endsection