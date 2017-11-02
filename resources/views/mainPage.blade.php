@extends('layouts.app')

@section('header')
    <h1>Main Page</h1>
@endsection

@section('content')
    @include('partials.errors.list')

    @if (Session::has('status_error'))
        <div class="col-xs-12 alert alert-danger">
            {{ Session::get('status_error') }}
        </div>
    @endif
    @if (Session::has('status_info'))
        <div class="col-xs-12 alert alert-info">
            {{ Session::get('status_info') }}
        </div>
    @endif

    <div>
        <a href="{{ route('products.index') }}">Our products</a>
    </div>
    <div>
        <a href="{{ route('orders.create') }}">Create order</a>
    </div>
    <div>
        <a href="/contacts">Contacts</a>
    </div>
@endsection