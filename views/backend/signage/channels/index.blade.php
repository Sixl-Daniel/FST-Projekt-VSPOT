@extends('adminlte::page')

@section('title', 'Channels')

@section('content_header')
    <h1>Channelliste</h1>
@stop

@section('content')

<div class="well well--toolbar">
    <a href="{{ route('channels.index') }}" class="btn btn-default has-icon-left"><i class="fas fa-redo"></i> Ansicht aktualisieren</a>
    <a href="{{ route('channels.create') }}" class="btn btn-default has-icon-left"><i class="fas fa-plus"></i> Neuen Channel hinzufügen</a>
</div>

@include('backend.signage.channels._channel_index_loop')

@stop
