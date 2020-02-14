@if ($devices->isNotEmpty())
<div class="row">
    @foreach($devices as $device)
        <div class="col-lg-6">
            <div class="panel panel-default panel--device">
                <div class="panel-heading"><h2>{{ $device->display_name }}</h2></div>
                <div class="panel-body">
                    <p class="text-bold">Beschreibung:</p>
                    <p class="lead">{{ $device->description ?? 'Ohne Beschreibung' }}</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <p><b>Location:</b> {{ $device->location ?? 'kein Ort angegeben' }}</p>
                    </li>
                    <li class="list-group-item">
                        <p><b>Kennzeichnung:</b> {{ $device->product_reference ?? 'keine Kennzeichnung' }}</p>
                    </li>
                    <li class="list-group-item">
                        <p><b>Channel:</b> <span class="text-bold text-primary {{ $device->channel->name ?? 'text-danger' }}">{{ $device->channel->name ?? 'kein Channel aufgeschaltet' }}</span></p>
                    </li>
                </ul>
                <div class="panel-footer text-right">
                    <form class="inline-form" action="{{ route('devices.destroy', $device->id) }}" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="far fa-trash-alt"></i> Löschen</button>
                    </form>
                    <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-default btn-sm has-icon-left"><i class="far fa-edit"></i> Editieren</a>
                    <a href="{{ route('devices.pdf', $device->id) }}" class="btn btn-default btn-sm has-icon-left" target="_blank"><i class="far fa-file-pdf"></i> Authentisierung [PDF]</a>
                    <div class="dropdown" style="display: inline-block;">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" id="dropdown-menu-dev-{{ $device->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-fw fa-key"></i> Zugänge <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-menu-dev-{{ $device->id }}">
                            <li class="dropdown-header">Web-Access</li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-device-web-link-{{ $device->id }}"><i class="fas fa-fw fa-link"></i> Link</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-device-web-qr-{{ $device->id }}"><i class="fas fa-fw fa-qrcode"></i> QR-Code</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">API-Access</li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-device-api-link-{{ $device->id }}"><i class="fas fa-fw fa-link"></i> Link</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-device-api-qr-{{ $device->id }}"><i class="fas fa-fw fa-qrcode"></i> QR-Code</a></li>
                            <li role="separator" class="divider"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @component('backend.components.modal', ['id'=>"modal-device-web-link-$device->id", 'size'=>'lg' , 'title'=>"Web-Access für $device->display_name"])
            <a class="text-wrap" href="{{ $device->weburl }}" target="_blank">{{ $device->weburl }}</a>
        @endcomponent

        @component('backend.components.modal', ['id'=>"modal-device-web-qr-$device->id", 'size'=>'sm' , 'title'=>"Web-Access für $device->display_name"])
            <div class="qr-wrapper">
                <img src="{{ $device->getWebQRImgSrc() }}" alt="QR-Code für den Web-Access des Gerätes {{ $device->display_name }}">
            </div>
        @endcomponent

        @component('backend.components.modal', ['id'=>"modal-device-api-link-$device->id", 'size'=>'lg' , 'title'=>"API-Access für $device->display_name"])
            <a class="text-wrap" href="{{ $device->apiurl }}" target="_blank">{{ $device->apiurl }}</a>
        @endcomponent

        @component('backend.components.modal', ['id'=>"modal-device-api-qr-$device->id", 'size'=>'sm' , 'title'=>"API-Access für $device->display_name"])
            <div class="qr-wrapper">
                <img src="{{ $device->getApiQRImgSrc() }}" alt="QR-Code für den API-Access des Gerätes {{ $device->display_name }}">
            </div>
        @endcomponent

    @endforeach
</div>
{{ $devices->links() }}
@else
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default panel--user-empty">
            <div class="panel-body text-center">
                <p class="text-muted">Es sind keine Geräte vorhanden.</p>
            </div>
        </div>
    </div>
</div>
@endif
