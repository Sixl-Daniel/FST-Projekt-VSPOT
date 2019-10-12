<div class="alert alert-{{ $type ?? 'info' }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fas fa-{{ $icon ?? 'info-circle' }}"></i> {{ $title ?? 'Information' }}</h4>
    {{ $slot }}
</div>
