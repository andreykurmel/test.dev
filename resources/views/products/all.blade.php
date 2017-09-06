@extends('layouts.app')

@section('header')
    <h1>We have {{ count($products) }} products:</h1>
@endsection

@section('content')
    @foreach($products as $pdc)
        <div style="margin-top: 10px;">
            <a href="{{ route('products.show', $pdc->id) }}" class="btn btn-default">{{ $pdc->name }}</a>
            <a href="{{ route('products.edit', $pdc->id) }}" class="btn btn-warning">Edit</a>
            {{ Form::open(['url' => route('products.destroy', $pdc->id), 'method' => 'DELETE', 'style' => 'display: inline-block']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            {{ form::close() }}
        </div>
    @endforeach
    <div style="margin-top: 25px;">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add product</a>
        <a href="/" class="btn btn-default">Back</a>
    </div>
@endsection