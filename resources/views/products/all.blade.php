@extends('layouts.app')

@section('header')
    <h1>We have {{ count($products) }} products:</h1>
@endsection

@section('content')
    @if ($messages)
        @isset ($messages['error'])
            <div class="col-xs-12 alert alert-danger">
                {{ $messages['error'] }}
            </div>
        @endisset
        @isset ($messages['info'])
            <div class="col-xs-12 alert alert-info">
                {{ $messages['info'] }}
            </div>
        @endisset
    @endif
    <div class="row">
        @foreach ($products as $pdc)
            <div class="col-xs-12" style="margin-bottom: 10px;">
                <a href="{{ route($routePrefix.'products.show', $pdc->id) }}">
                    <div class="col-xs-9 col-sm-6 col-sm-4 col-lg-3 btn btn-default">
                        {{ $pdc->name }}
                    </div>
                </a>

                @auth
                    @if (Auth::user()->id == $pdc->user->id)
                        <span class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="glyphicon glyphicon-option-horizontal"></i>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route($routePrefix.'products.edit', $pdc->id) }}">Edit</a>
                                </li>
                                <li>
                                    <a href="{{ route($routePrefix.'products.destroy', $pdc->id) }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('destroy-product{{ $pdc->id }}').submit();">
                                        Delete
                                    </a>
                                    {{ Form::open(['url' => route($routePrefix.'products.destroy', $pdc->id), 'method' => 'DELETE', 'style' => 'display: none;', 'id' => 'destroy-product'.$pdc->id]) }}
                                    {{ form::close() }}
                                </li>
                            </ul>
                        </span>
                    @else
                        <span class="btn">Owner: {{ $pdc->user->name }}</span>
                    @endif
                @endauth
            </div>
        @endforeach
        <div style="margin-top: 15px;" class="col-xs-12">
            @auth
            <a href="{{ route($routePrefix.'products.create') }}" class="btn btn-primary">Add product</a>
            @endauth
            <a href="/" class="btn btn-default">Back</a>
        </div>
    </div>
@endsection