@extends('layouts.frontend')

@section('styles')

@endsection

@section('content')
    <div id="app" class="container">
        <h4>Movie API</h4>
        {{ config('api-keys.tmdb') }}
        <!--when passing string as props, remove ':'-->
        <home api_key="{{ config('api-keys.tmdb') }}"></home>
    </div>
@endsection
