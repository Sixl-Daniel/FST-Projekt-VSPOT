@extends('adminlte::page')

@section('title', 'Benutzer')

@section('content_header')
    <h1>Registrierungen (unverifizierte Nutzer)</h1>
@stop

@section('content')

@include('backend.admin.users._user_index_loop')

@stop
