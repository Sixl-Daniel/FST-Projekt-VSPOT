@extends('adminlte::page')

@section('title', 'Benutzer')

@section('content_header')
    <h1>Benutzerverwaltung</h1>
@stop

@section('content')

@if ($users->isNotEmpty())
<h2>Verifizierte Nutzer</h2>
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
                            <h2 class="h3">{{$user->name}}</h2>
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
                        <th>Anmeldung</th>
                        <th>ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->formatLocalized('%d.%m.%Y') }}</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    </tbody>
                </table>
                @if(!$user->is('superadmin'))
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <form class="inline-form" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                            @csrf
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-danger">Löschen</button>
                        </form>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default">Editieren</a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endif

@if ($unverifiedUsers->isNotEmpty())
<h2>Registrierungen <b>ohne</b> Verifikation</h2>
<div class="row">
    @foreach($unverifiedUsers as $user)
        <div class="col-lg-6">
            <div class="panel panel-default panel--user">
                <div class="panel-body">
                    <h2 class="h3">{{$user->name}}</h2>
                    <p>
                        Username: <b>{{$user->username}}</b><br>
                        Rollen:@forelse($user->roles as $role)@if(!$loop->first),@endif <b>{{ ucfirst($role->name) }}</b>@empty <b class="text-danger">ohne Benutzerrolle</b>@endforelse
                    </p>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nachname</th>
                        <th>Vorname</th>
                        <th>E-Mail</th>
                        <th>Anmeldedatum</th>
                        <th>ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->formatLocalized('%d.%m.%Y') }}</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    </tbody>
                </table>
                <ul class="list-group">
                    <li class="list-group-item text-right">
                        <div class="btn-group">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                {{ method_field('delete') }}
                                <button type="submit" class="btn btn-danger">Löschen</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endif

@stop
