@extends('layouts.app')

@section('header')
    <div class="col-xs-12">
        <h1>Please complete form below for create Order:</h1>
    </div>
@endsection

@section('content')
    @include('partials.errors.list')

    <div class="col-md-6">
        <form method="post" action="{{ route('orders.store') }}" class="form-horizontal">
            {{ csrf_field() }}
            <h2>
                User:
            </h2>
            <div class="form-group">
                <label for="user_name" class="form-label col-xs-2">Name:</label>
                <div class="col-xs-10">
                    <input type="text" name="user_name" id="user_name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="user_pass" class="form-label col-xs-2">Password:</label>
                <div class="col-xs-10">
                    <input type="password" name="user_pass" id="user_pass" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="user_email" class="form-label col-xs-2">Email:</label>
                <div class="col-xs-10">
                    <input type="email" name="user_email" id="user_email" class="form-control">
                </div>
            </div>
            <hr>
            <h2>
                Product:
            </h2>

            @include('products.partials.form')

            <div class="form-group">
                {!! Form::submit('Create order', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route($routePrefix.'root') }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
@endsection