@extends('layouts.app')

@section('header')
    <h1>Main Page</h1>
@endsection

@section('content')
    @include('partials.errors.list')

    <div>
        <a href="{{ route('products.index') }}">Our products</a>
    </div>
    <div>
        <a href="/contacts">Contacts</a>
    </div>
@endsection