@if ($screens->isNotEmpty())
    <div class="row">
        @foreach($screens as $screen)
            <div class="col-md-6">
                <div class="panel panel-default panel--channel">
                    <div class="panel-heading"><h2>{{ $screen->name }} <small>mit Layout „{{ $screen->layout->name }}“</small></h2></div>
                    <div class="panel-body">
                        <p class="lead">{{ $screen->description ?? 'Ohne Beschreibung' }}</p>
                    </div>
                    {{-- <ul class="list-group">--}}
                    {{--     <li class="list-group-item">{{ $screen->layout->name ?? 'Ohne' }} Layout</li>--}}
                    {{-- </ul>--}}
                    <div class="panel-footer text-right">
                        <div class="btn-group  inline">
                            <a title="Screen an den Anfang verschieben" href="{{ route('channels.screens.move', [$channel->id, $screen, 'start']) }}" class="btn btn-default btn-sm"><i class="fas fa-angle-double-left"></i></a>
                            <a title="Screen eine Position nach vorne verschieben" href="{{ route('channels.screens.move', [$channel->id, $screen, 'up']) }}" class="btn btn-default btn-sm"><i class="fas fa-angle-left"></i></a>
                            <a title="Screen eine Position nach hinten verschieben" href="{{ route('channels.screens.move', [$channel->id, $screen, 'down']) }}" class="btn btn-default btn-sm"><i class="fas fa-angle-right"></i></a>
                            <a title="Screen an das Ende verschieben" href="{{ route('channels.screens.move', [$channel->id, $screen, 'end']) }}" class="btn btn-default btn-sm"><i class="fas fa-angle-double-right"></i></a>
                        </div>
                        <div class="inline">
                            <form class="inline-form" action="{{ route('channels.screens.destroy', [$channel->id, $screen]) }}" method="post">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger btn-sm has-icon-left"><i class="far fa-trash-alt"></i> Löschen</button>
                            </form>
                            <a href="{{ route('channels.screens.duplicate', [$channel->id, $screen]) }}" class="btn btn-default btn-sm has-icon-left"><i class="fa fa-copy"></i> Duplizieren</a>
                            <a href="{{ route('channels.screens.edit', [$channel->id, $screen]) }}" class="btn btn-default btn-sm has-icon-left"><i class="fa fa-edit"></i> Editieren</a>
                        </div>
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
