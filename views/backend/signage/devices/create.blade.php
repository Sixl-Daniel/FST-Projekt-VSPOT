@extends('adminlte::page')

@section('title', 'Neues Gerät')

@section('content_header')
    <h1>Neues Gerät anlegen</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        {!! Form::open([
            'method' => 'post',
            'route' => ['devices.store']
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
                {{ Form::vspotSubmit('Gerät anlegen') }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}
    </div>
</div>
@stop
