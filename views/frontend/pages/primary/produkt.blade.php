@extends('frontend.layouts.app')

@section('pageTitle', 'Produkt')

@push('css-top')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css" integrity="sha256-tBxlolRHP9uMsEFKVk+hk//ekOlXOixLKvye5W2WR5c=" crossorigin="anonymous" />
@endpush

@section('content')
<div class="container">
    <h1 class="page-heading page-heading">Produkt</h1>
    <div class="row justify-content-center align-items-end content">
        <div class="col-lg-4">
            <p>VSPOT ist ein CMS zur Erstellung und Verwaltung von Geräten, Benutzern und Inhalten für Digital Signage.</p>
            <p>Generierte Inhalte lassen sich über eine dedizierte Mobile- oder Desktop-Anwendung, über eine JSON-API oder eine reguläre Webpage abrufen.</p>
        </div>
        <div class="col-lg-8">
            <a href="{{asset('media/images/backend-demo.gif')}}" data-lightbox="image-1" data-title="Ansicht des Backends">
                <img class="frame-shadow" src="{{asset('media/images/backend-demo.gif')}}">
            </a>
        </div>
    </div>
</div>
@endsection

@push('js-bottom')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"  crossorigin="anonymous"></script>
@endpush
