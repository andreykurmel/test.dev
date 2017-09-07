@extends('layouts.app')

@section('header')
    <h1>Information about product #{{ $product->id }}:</h1>
@endsection

@section('content')
    <div>
        Name: {{ $product->name }}
    </div>
    <div>
        Code: {{ $product->code }}
    </div>
    <div>
        Description: {{ $product->description }}
    </div>
    <div>
        In stock: {{ $product->inStock }}
    </div>
    <div>
        Price: {{ $product->price }}
    </div>
    <div>
        Owner: {{ $product->user->name }}
    </div>
    <div>
        <a href="{{ route($routePrefix.'products.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection