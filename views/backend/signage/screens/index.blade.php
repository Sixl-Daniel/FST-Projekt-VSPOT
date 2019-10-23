@extends('adminlte::page')

@section('title', 'Screens')

@section('content_header')
    <h1>Liste der Screens von Channel <b>{{ $channel->name }}</b></h1>
@stop

@section('content')

<div class="well well--toolbar">
    {{ Form::vspotBack() }}
    <a href="{{ route('channels.screens.index', $channel->id) }}" class="btn btn-default has-icon-left"><i class="fas fa-redo"></i> Ansicht aktualisieren</a>
    <a href="{{ route('channels.screens.create', $channel->id) }}" class="btn btn-default has-icon-left"><i class="fas fa-plus"></i> Screen hinzufügen</a>
</div>

@include('backend.signage.screens._screens_index_loop')

@stop
