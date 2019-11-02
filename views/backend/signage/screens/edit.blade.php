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

                    <div class="col-xs-12 col-md-6 col-lg-2">
                        {{ Form::vspotText('background_color', 'Hintergrundfarbe') }}
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        {{ Form::vspotText('bg_img_cdn_link', 'Bild (CDN-Link)') }}
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-2">
                        {{ Form::vspotText('overlay_color', 'Farbe des Overlay') }}
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-2">
                        {{ Form::vspotText('text_color', 'Textfarbe') }}
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

        /* selects */

        $layoutSelector = $('#screen-layout-select');
        if($layoutSelector.length){
            $layoutSelector.select2({width: '100%'});
        }

        /* color picker */

        cpOptions = {
            customClass: 'vspot-color-picker',
            colorSelectors: {
                'blue': '#0074D9',
                'aqua': '#7FDBFF',
                'teal': '#39CCCC',
                'olive': '#3D9970',
                'green': '#2ECC40',
                'lime': '#01FF70',
                'yellow': '#FFDC00',
                'orange': '#FF851B',
                'red': '#FF4136',
                'fuchsia': '#F012BE',
                'purple': '#B10DC9',
                'white': '#FFFFFF',
                'silver': '#DDDDDD',
                'gray': '#AAAAAA',
                'darkgray': '#444444',
                'black': '#111111',
                'vspot': '#C70038'
            },
            sliders: {
                saturation: {
                    maxLeft: 250,
                    maxTop: 250
                },
                hue: {
                    maxTop: 250
                },
                alpha: {
                    maxTop: 250
                }
            }
        };

        $bgColorInput = $('#background_color');
        if($bgColorInput.length){
            $bgColorInput.colorpicker(cpOptions);
        }

        $overlayColorInput = $('#overlay_color');
        if($overlayColorInput.length){
            $overlayColorInput.colorpicker(cpOptions);
        }

        $textColorInput = $('#text_color');
        if($textColorInput.length){
            $textColorInput.colorpicker(cpOptions);
        }

        /* html block */

        $htmlBlock = $('#html_block');
        if($htmlBlock.length){

            $editorOptions = {
                styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3'],
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    // ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    // ['table', ['table']],
                    // ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
                ],
            }

            $htmlBlock.summernote($editorOptions);

        }

    });
</script>
@endsection

