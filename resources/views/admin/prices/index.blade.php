@extends('layouts.app')

@section('content')
    @foreach($prices as $price)
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Device ID: {{ $price->name }} <br>
                            Min Time: {{ $price->minTime }} <br>
                            Max Time: {{ $price->maxTime }} <br>
                            Price: {{ $price->price }} <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    <a style="float:right" class="btn btn-primary" href="{{ route('prices.create') }}" class="alert-link">New Price</a>
@endsection