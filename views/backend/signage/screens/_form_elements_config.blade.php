@if(empty($screenConfig))
    <div class="col-xs-12">
        <div class="alert alert-warning" role="alert">Für dieses Layout wurde noch keine Konfiguration angelegt.</div>
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
