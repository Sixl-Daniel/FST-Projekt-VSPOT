@if ($screens->isNotEmpty())
    <div class="row">
        @foreach($screens as $screen)
            <div class="col-md-6 col-lg-4">
                <div class="panel panel-default panel--channel">
                    <div class="panel-heading"><h2>{{ $screen->name }} <small>mit {{ $screen->layout->name }} Layout</small></h2></div>
                    <div class="panel-body">
                        <p class="lead">{{ $screen->description ?? 'Ohne Beschreibung' }}</p>
                    </div>
                    {{-- <ul class="list-group">--}}
                    {{--     <li class="list-group-item">{{ $screen->layout->name ?? 'Ohne' }} Layout</li>--}}
                    {{-- </ul>--}}
                    <div class="panel-footer text-right">
                        <form class="inline-form" action="{{ route('channels.screens.destroy', [$channel->id, $screen]) }}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="fas fa-trash"></i> Löschen</button>
                        </form>
                        <a href="{{ route('channels.screens.edit', [$channel->id, $screen]) }}" class="btn btn-default btn-sm has-icon-left"><i class="fas fa-edit"></i> Editieren</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
{{ $screens->links() }}
@else
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default panel--user-empty">
            <div class="panel-body text-center">
                <p class="text-muted">Es sind keine Screens vorhanden.</p>
            </div>
        </div>
    </div>
</div>
@endif
