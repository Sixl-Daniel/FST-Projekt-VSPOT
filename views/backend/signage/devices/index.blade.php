@extends('adminlte::page')

@section('title', 'Geräte')

@section('content_header')
    <h1>Geräteliste</h1>
@stop

@section('content')

<div class="well well--toolbar">
    <a href="{{ route('devices.index') }}" class="btn btn-default has-icon-left"><i class="fas fa-redo"></i> Ansicht aktualisieren</a>
    <a href="{{ route('devices.create') }}" class="btn btn-default has-icon-left"><i class="fas fa-plus"></i> Neues Gerät hinzufügen</a>
</div>

@include('backend.signage.devices._device_index_loop')

@stop
