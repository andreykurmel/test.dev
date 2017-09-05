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
        <a href="{{ route('products.index') }}">Back</a>
    </div>
@endsection