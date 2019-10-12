<div class="col-md-6">
    <div class="box box-{{ $type ?? 'default' }}{{ ($solid ?? false) ? ' box-solid':''}}" data-widget="box-widget">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="icon fas fa-{{ $icon ?? 'inf-circle' }}"></i> {{ $title ?? 'Information' }}</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">{{ $slot }}</div>
    </div>
</div>
