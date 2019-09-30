@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>{{ __('You are logged in as :user.', ['user' => $user->name]) }}</p>
@stop
