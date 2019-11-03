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
                    <a href="{{ route('devices.pdf', $device->id) }}" class="btn btn-default btn-sm has-icon-left" target="_blank"><i class="far fa-file-pdf"></i> Zugänge</a>
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
