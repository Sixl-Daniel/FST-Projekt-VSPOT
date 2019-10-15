@extends('frontend.layouts.app')

@section('pageTitle', 'Tests')

@section('content')
<div class="container content">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <h1 class="page-heading">QR-Code
                @if(!empty($heading))
                für {{ $heading ?? '' }}
                @endif
            </h1>
            <div class="qr-wrapper">{!! $qr !!}</div>
        </div>
    </div>
</div>
@endsection
