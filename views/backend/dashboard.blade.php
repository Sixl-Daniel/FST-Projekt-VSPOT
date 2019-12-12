@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    @can('manage-users')
        @include('backend.dashboard.infobox-user-chart')
    @endcan
    @include('backend.dashboard.infobox-messages')
    @include('backend.dashboard.infobox-quote')
</div>
@stop
