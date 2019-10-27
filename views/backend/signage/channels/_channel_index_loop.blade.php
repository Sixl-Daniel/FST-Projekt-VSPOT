@if ($channels->isNotEmpty())
<div class="row">
    @foreach($channels as $channel)
        <div class="col-lg-6">
            <div class="panel panel-default panel--channel">
                <div class="panel-heading"><h2>{{ $channel->name }}</h2></div>
                <div class="panel-body">
                    <p class="lead">{{ $channel->description ?? 'Ohne Beschreibung' }}</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        @if( $channel->screens()->count() > 0)
                        <p class="text-primary text-bold">{{ $channel->screens()->count() }} {{ str_plural('Screen', $channel->screens()->count()) }} in diesem Channel</p>
                        @else
                        <p class="text-muted">Keine Screens</p>
                        @endif
                    </li>
                </ul>
                <div class="panel-footer text-right">
                    <form class="inline-form" action="{{ route('channels.destroy', $channel->id) }}" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="fas fa-trash"></i> Löschen</button>
                    </form>
                    <a href="{{ route('channels.edit', $channel->id) }}" class="btn btn-default btn-sm has-icon-left"><i class="fas fa-edit"></i> Eigenschaften</a>
                    @if( $channel->screens()->count() > 0)
                    <a href="{{ route('channels.screens.index', $channel->id) }}" class="btn btn-primary btn-sm has-icon-left"><i class="fas fa-sitemap"></i> Screens</a>
                    @else
                    <a href="{{ route('channels.screens.index', $channel->id) }}" class="btn btn-primary btn-sm has-icon-left"><i class="fas fa-plus"></i> Screens hinzufügen</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
{{ $channels->links() }}
@else
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default panel--user-empty">
            <div class="panel-body text-center">
                <p class="text-muted">Es sind keine Channels vorhanden.</p>
            </div>
        </div>
    </div>
</div>
@endif
