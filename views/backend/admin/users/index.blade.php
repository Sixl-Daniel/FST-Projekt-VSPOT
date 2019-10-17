@extends('adminlte::page')

@section('title', 'Benutzer')

@section('content_header')
    <h1>Benutzerliste</h1>
@stop

@section('content')

@include('backend.admin.users._user_index_loop')

@stop
