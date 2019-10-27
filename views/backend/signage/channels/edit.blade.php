@extends('adminlte::page')

@section('title', 'Channel bearbeiten')

@section('content_header')
    <h1>Channel bearbeiten</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        {!! Form::model($channel, [
            'method' => 'patch',
            'route' => ['channels.update', $channel->id]
        ]) !!}
        <div class="panel panel-default panel--device panel--device-edit">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        {{ Form::vspotText('name', 'Bezeichnung') }}
                    </div>
                    <div class="col-md-8 col-lg-9">
                        {{ Form::vspotText('description', 'Beschreibung') }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::vspotText('display_time', 'Anzeigedauer (ms)') }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::vspotText('transition_time', 'Überblendung (ms)') }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::vspotText('refresh_time', 'Refresh (s)') }}
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                {{ Form::vspotBack() }}
                {{ Form::vspotSubmit('Channel aktualisieren') }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}
    </div>
</div>
@stop
