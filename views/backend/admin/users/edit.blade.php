@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Benutzerverwaltung</h1>
@stop

@section('content')

<h2>Nutzer <b>{{ $user->name }}</b> bearbeiten</h2>

<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default panel--user panel--user-edit">

            <div class="panel-body">
                <div class="media">
                    <div class="media-left">
                        <a href="#">{!! Avatar::create($user->name)->toSvg() !!}</a>
                    </div>
                    <div class="media-body">
                        <div class="user-status-labels pull-right">
                            {!! $user->is('admin') ? '<span class="label label-info">Admin</span>' : '' !!}
                            {!! $user->is('superadmin') ? '<span class="label label-info">Superadmin</span>' : '' !!}
                            {!! $user->rejected ? '<span class="label label-danger">Gesperrt</span>' : '' !!}
                            {!! $user->pending ? '<span class="label label-warning">Prüfen</span>' : '' !!}
                        </div>
                        <h2 class="h3">{{$user->name}}</h2>
                        <p>Username: <b>{{$user->username}}</b></p>
                    </div>
                </div>

                <form id="update-user-form" action="{{ route('admin.users.update', $user) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
{{--                    <div class="form-group">--}}
{{--                        <label for="user-email-input">E-Mail</label>--}}
{{--                        <input type="email" class="form-control" id="user-email-input">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="user-password-input">Passwort</label>--}}
{{--                        <input type="password" class="form-control" id="user-password-input">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="user-role-select">Rollen</label>
                        <select id="user-role-select" class="roles-select-multiple js-enhanced-select" name="roles[]" multiple="multiple" style="visibility: hidden;">
                            @foreach($roles as $role)
                                <option {{ $user->is($role->name) ? 'selected' : '' }} value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

            </div>
            <ul class="list-group">
                <li class="list-group-item text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-default pull-left">Zurück</a>
                        <button type="submit" class="btn btn-primary" form="update-user-form">Speichern</button>
                </li>
            </ul>
        </div>
    </div>

</div>


@stop

@section('adminlte_js')
    <script>
    jQuery(document).ready(function($) {
        $('.roles-select-multiple').select2({
            width: '100%'
        });
    });
    </script>
@endsection
