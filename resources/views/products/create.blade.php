@extends('layouts.app')

@section('header')
    <div class="col-xs-12">
        <h1>Please complete form below:</h1>
    </div>
@endsection

@section('content')
    @include('partials.errors.list')

    <div class="col-md-6">
        {!! Form::open(['url' => route($routePrefix.'products.store'), 'class' => 'form-horizontal']) !!}

            @include('products.partials.form')

            <div class="form-group">
                {!! Form::label('userId', 'Owner:', ['class' => 'form-label col-xs-2']) !!}
                <div class="col-xs-10">
                    {!! Form::select('userId', $users, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route($routePrefix.'products.index') }}" class="btn btn-default">Cancel</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection