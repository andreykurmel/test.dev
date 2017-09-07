@extends('layouts.app')

@section('header')
    <div class="col-xs-12">
        <h1>Please complete form below:</h1>
    </div>
@endsection

@section('content')
    @include('partials.errors.list')

    <div class="col-md-6">
        {!! Form::model($product, ['url' => route($routePrefix.'products.update', $product->id), 'class' => 'form-horizontal']) !!}
            {{ method_field('PUT') }}
            
            @include('products.partials.form')

            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route($routePrefix.'products.index') }}" class="btn btn-default">Cancel</a>
            </div>
        {!! Form::close() !!}
    </div>
@endsection