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
                        <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="fas fa-trash"></i> Löschen</button>
                    </form>
                    <a href="{{ route('devices.edit', $device->id) }}" class="btn btn-default btn-sm has-icon-left"><i class="fas fa-edit"></i> Editieren</a>
                    <button type="button" class="btn btn-success btn-sm btn-lg" data-toggle="modal" data-target="#modal-device-link-{{ $device->id }}"><i class="fas fa-link"></i></button>
                    <button type="button" class="btn btn-success btn-sm btn-lg" data-toggle="modal" data-target="#modal-device-qr-{{ $device->id }}"><i class="fas fa-qrcode"></i></button>
                </div>
            </div>
        </div>
        {{-- modal link --}}
        <div id="modal-device-link-{{ $device->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Link für {{ $device->display_name }}</h4>
                    </div>
                    <div class="modal-body">
                        <a class="text-wrap" href="{{ $device->webURL }}" target="_blank">{{ $device->webURL }}</a>
{{--                        <div class="qr-wrapper my-3">{!! $device->qr !!}</div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- modal link --}}
        <div id="modal-device-qr-{{ $device->id }}" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">QR-Code für {{ $device->display_name }}</h4>
                    </div>
                    <div class="modal-body"><div class="qr-wrapper">{!! $device->qr !!}</div></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Schließen</button>
                    </div>
                </div>
            </div>
        </div>
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
