@extends('layouts.app')

@section('header')
    <h1>We have {{ count($products) }} products:</h1>
@endsection

@section('content')
    @foreach($products as $pdc)
        <div>
            <a href="{{ route('products.show', $pdc->id) }}">{{ $pdc->name }}</a>
            <a href="{{ route('products.edit', $pdc->id) }}">(Edit)</a>
        </div>
    @endforeach
    <div style="margin-top: 25px;">
        <a href="{{ route('products.create') }}">Add product</a>
        <a href="/" style="margin-left: 50px;">Back</a>
    </div>
@endsection