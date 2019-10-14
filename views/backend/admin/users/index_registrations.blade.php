@extends('adminlte::page')

@section('title', 'Benutzer')

@section('content_header')
    <h1>Registrierungen <small>Unverifizierte Nutzer</small></h1>
@stop

@section('content')

@if ($users->isNotEmpty())
@include('backend.admin.users._user_index_loop')
@endif

@stop
