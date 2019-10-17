@extends('adminlte::page')

@section('title', 'Gerät bearbeiten')

@section('content_header')
    <h1>Gerät bearbeiten</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        {!! Form::model($device, [
            'method' => 'patch',
            'route' => ['devices.update', $device->id]
        ]) !!}
        <div class="panel panel-default panel--device panel--device-edit">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        {{ Form::vspotText('display_name', 'Anzeigename') }}
                    </div>
                    <div class="col-md-6 col-lg-4">
                        {{ Form::vspotText('product_reference', 'Gerätekennung') }}
                    </div>
                    <div class="col-xs-12 col-lg-4">
                        {{ Form::vspotText('location', 'Ort') }}
                    </div>
                    <div class="col-xs-12">
                        {{ Form::vspotText('description', 'Beschreibung') }}
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                {{ Form::vspotBack() }}
                {{ Form::vspotSubmit('Gerät aktualisieren') }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}
    </div>
</div>
@stop
