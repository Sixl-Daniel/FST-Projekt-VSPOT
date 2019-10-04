@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="auth-box login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">@include('svg.logo')</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><b>{{ __('Verify Your Email Address') }}!</b></p>
                @if (session('resent'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <p>{{ __('You have to confirm your email address before continuing. If the e-mail has not arrived within 15 minutes, please check your spam, bulk or junk mail folder to locate it.') }}</p>
                <form class="" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Resend verification link') }}
                    </button>
                </form>
        </div>
    </div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
