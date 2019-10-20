@extends('adminlte::page')

@section('title', 'Neuer Channel')

@section('content_header')
    <h1>Neuen Channel anlegen</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        {!! Form::open([
            'method' => 'post',
            'route' => ['channels.store']
        ]) !!}
        <div class="panel panel-default panel--channel panel--channel-edit">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        {{ Form::vspotText('name', 'Bezeichnung') }}
                    </div>
                    <div class="col-md-8 col-lg-9">
                        {{ Form::vspotText('description', 'Beschreibung') }}
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                {{ Form::vspotBack() }}
                {{ Form::vspotSubmit('Channel anlegen') }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}
    </div>
</div>
@stop
