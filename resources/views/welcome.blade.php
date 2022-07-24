@extends('layouts.frontend')

@section('styles')

@endsection

@section('content')
    <div id="app" class="container mb-3">
        <h4>Movie API</h4>
        <!--when passing string as props, remove ':'-->
        <home api_key="{{ config('api-keys.tmdb') }}"></home>
    </div>
@endsection
