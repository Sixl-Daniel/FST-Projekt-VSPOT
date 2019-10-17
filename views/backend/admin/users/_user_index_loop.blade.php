@if ($users->isNotEmpty())
<div class="row">
    @foreach($users as $user)
        <div class="col-lg-6">
            <div class="panel panel-default panel--user">
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">{!! Avatar::create($user->name)->toSvg() !!}</a>
                        </div>
                        <div class="media-body">
                            <div class="user-status-labels pull-right">
                                {!! $user->is('superadmin') ? '<span class="label label-primary">Superadmin</span>' : '' !!}
                                {!! $user->is('admin') ? '<span class="label label-primary">Admin</span>' : '' !!}
                                {!! $user->is('guest') ? '<span class="label label-danger">Gast</span>' : '' !!}
                            </div>
                            <h2 class="h3">{{$user->last_name}}, {{$user->first_name}}</h2>
                            <p>Username: <b>{{$user->username}}</b><br>
                                Rollen:@forelse($user->roles as $role)@if(!$loop->first),@endif <b>{{ ucfirst($role->name) }}</b>@empty <b class="text-danger">Gast, ohne Benutzerrolle</b>@endforelse
                            </p>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>E-Mail</th>
                        <th>ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    </tbody>
                </table>
                <ul class="list-group">
                <li class="list-group-item">
                    <p>Der Nutzer wurde {{ $user->created_at->diffForHumans() }}, {{ $user->created_at->formatLocalized('am %d.%m.%Y um %H:%m Uhr') }}, im System registriert.</p>
                </li>
                @if(!$user->is('superadmin'))
                        <li class="list-group-item text-right">
                            <form class="inline-form" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger">Löschen</button>
                            </form>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default">Editieren</a>
                        </li>
                @else
                        <li class="list-group-item text-right">
                            <p class="text-center text-muted text-fit-button-line">Geschützter Benutzer</p>
                        </li>
                @endif
                    </ul>
            </div>
        </div>
    @endforeach
</div>
{{ $users->links() }}
@else
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default panel--user-empty">
            <div class="panel-body text-center">
                <p class="text-muted">Es sind keine Benutzer für diese Ansicht vorhanden.</p>
            </div>
        </div>
    </div>
</div>
@endif
