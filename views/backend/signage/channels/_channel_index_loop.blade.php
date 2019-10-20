@if ($channels->isNotEmpty())
<div class="row">
    @foreach($channels as $channel)
        <div class="col-lg-6">
            <div class="panel panel-default panel--channel">
                <div class="panel-heading"><h2>{{ $channel->name }}</h2></div>
                <div class="panel-body">
                    <p class="text-bold">Beschreibung:</p>
                    <p class="lead">{{ $channel->description ?? 'Ohne Beschreibung' }}</p>
                </div>
                {{--<ul class="list-group">--}}
                {{--    <li class="list-group-item">--}}
                {{--        <p><b>x:</b> Content</p>--}}
                {{--    </li>--}}
                {{--    <li class="list-group-item">--}}
                {{--        <p><b>y:</b> Content</p>--}}
                {{--    </li>--}}
                {{--</ul>--}}
                <div class="panel-footer text-right">
                    <form class="inline-form" action="{{ route('channels.destroy', $channel->id) }}" method="post">
                        @csrf
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="fas fa-trash"></i> Löschen</button>
                    </form>
                    <a href="{{ route('channels.edit', $channel->id) }}" class="btn btn-default btn-sm has-icon-left"><i class="fas fa-edit"></i> Editieren</a>
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
                <p class="text-muted">Es sind keine Channels für diese Ansicht vorhanden.</p>
            </div>
        </div>
    </div>
</div>
@endif
