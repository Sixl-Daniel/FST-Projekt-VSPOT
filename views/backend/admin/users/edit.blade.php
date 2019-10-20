@extends('adminlte::page')

@section('title', 'Benutzer bearbeiten')

@section('content_header')
    <h1>Benutzer&shy;verwaltung</h1>
@stop

@section('content')
<h2>Benutzer <b>{{ $user->name }}</b> bearbeiten</h2>

<div class="row">
    <div class="col-xs-12">

        {!! Form::model($user, [
            'method' => 'patch',
            'route' => ['admin.users.update', $user->id]
        ]) !!}
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
                        <h3>{{$user->name}}</h3>
                        <p>Username: <b>{{$user->username}}</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        {{ Form::vspotText('username', 'Benutzername') }}
                    </div>
                    <div class="col-md-6 col-lg-3">
                        {{ Form::vspotEmail('email', 'E-Mail') }}
                    </div>
                    <div class="col-md-6 col-lg-3">
                        {{ Form::vspotText('first_name', 'Vorname') }}
                    </div>
                    <div class="col-md-6 col-lg-3">
                        {{ Form::vspotText('last_name', 'Nachname') }}
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <label for="user-role-select">Rollen</label>
                            {{ Form::select('roles[]', $rolesAvailable, $user->roleIds, [
                                'id' => 'user-role-select',
                                'multiple' => true,
                                'style' => 'visibility: hidden;',
                                'class' => 'roles-select-multiple js-enhanced-select'
                            ]) }}
                            @if($errors->has('roles'))
                                <span class="help-block"><strong>{{ $errors->first('roles') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <a href="{{ url()->previous() }}" class="btn btn-default pull-left">Zurück</a>
                {{ Form::vspotSubmit() }}
            </div>
        </div> <!-- /.panel -->
        {!! Form::close() !!}

    </div>
</div>
@stop

@section('adminlte_js')
    <script>
    jQuery(document).ready(function($) {
        $('.roles-select-multiple').select2({width: '100%'});
    });
    </script>
@endsection
