@if(empty($screenConfig))
    <div class="col-xs-12">
        <div class="alert alert-info" role="alert">Für dieses Layout werden die Inhalte automatisch generiert.</div>
    </div>
@endif

@if(in_array('heading', $screenConfig))
<div class="col-xs-12 col-md-6">
    {{ Form::vspotText('heading', 'Überschrift') }}
</div>
@endif

@if(in_array('subheading', $screenConfig))
<div class="col-xs-12 col-md-6">
    {{ Form::vspotText('subheading', 'Unterüberschrift') }}
</div>
@endif

@if(in_array('text_block', $screenConfig))
    <div class="col-xs-12 col-md-6">
        {{ Form::vspotTextarea('text_block', 'Textblock') }}
    </div>
@endif

@if(in_array('html_block', $screenConfig))
    <div class="col-xs-12">
        {{ Form::vspotTextarea('html_block', 'Textblock') }}
    </div>
@endif
