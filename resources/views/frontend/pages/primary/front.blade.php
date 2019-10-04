@extends('frontend.layouts.app')

@section('content')
    <main>
        <div class="container">
            <h1 class="page-heading page-heading--front">{{ config('app.name') }} – {{ config('app.tagline') }}</h1>
            <section class="front-logo-wrapper">@include('svg.logo_text')</section>
        </div>
    </main>
@endsection
