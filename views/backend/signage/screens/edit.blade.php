@extends('adminlte::page')

@section('title', 'Screen bearbeiten')

@section('content_header')
    <h1>Screen bearbeiten</h1>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        {!! Form::model($screen, [
            'method' => 'patch',
            'route' => ['channels.screens.update', $channel_id, $screen]
        ]) !!}
        <div class="panel panel-default panel--screen panel--screen-edit">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-7 col-md-8 col-lg-4">
                        {{ Form::vspotText('name', 'Name') }}
                    </div>
                    <div class="col-xs-5 col-md-4 col-lg-2">
                        <div class="form-group{{ $errors->has('layout_id') ? ' has-error' : '' }}">
                            <label for="user-role-select">Layout</label>
                            {{ Form::select('layout_id', $layouts, $screen->layout->id ?? 0, [
                                'id' => 'screen-layout-select',
                                'multiple' => false,
                                'style' => 'visibility: hidden;',
                                'class' => 'js-enhanced-select'
                            ]) }}
                            @if($errors->has('layout_id'))
                                <span class="help-block"><strong>{{ $errors->first('layout_id') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 col-lg-6">
                        {{ Form::vspotText('description', 'Beschreibung') }}
                    </div>

                    {{-- individual form elements : --}}
                    @include('backend.signage.screens._form_elements_config')
                </div>
            </div>
            <div class="panel-footer text-right">
                {{ Form::vspotBack() }}
                {{ Form::vspotSubmit('Screen aktualisieren') }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('js')
<script>
    jQuery(document).ready(function($) {
        $('#screen-layout-select').select2({width: '100%'});
    });
</script>
@endsection

