@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    @include('backend.dashboard.infobox-user-chart')
    @include('backend.dashboard.infobox-messages')
    @include('backend.dashboard.infobox-quote')

</div>
@stop
