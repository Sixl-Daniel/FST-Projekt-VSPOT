@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <h1 class="page-heading page-heading--front">{{ env('APP_NAME') }} – {{ env('APP_TAGLINE') }}</h1>
    <section class="front-logo-wrapper">@include('svg.logo_text')</section>
</div>
@endsection
