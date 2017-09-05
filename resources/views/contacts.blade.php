@extends('layouts.app')

@section('header')
    <h1>Our contacts:</h1>
@endsection

@section('content')
    <div>Company name: {{ $info->name }}</div>
    <div>City: {{ $info->city }}</div>
    <div>Country: {{ $info->country }}</div>
    <div style="margin-top: 25px;">
        <a href="/">Back</a>
    </div>
@endsection