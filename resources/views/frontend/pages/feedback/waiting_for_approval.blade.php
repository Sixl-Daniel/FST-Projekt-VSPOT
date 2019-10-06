@extends('frontend.layouts.app')

@section('pageTitle', 'Freischaltung')

@section('content')

{{-- @php dd($user->approved, $user->rejected, $user->pending) @endphp --}}

<main>
<div class="container content">

    <div class="row justify-content-center mb-3">
        <div class="col-md-8">

            <h1 class="page-heading">Aktivierung</h1>

            @if ($user->pending)
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Account für <b>{{ $user->name }}</b></div>
                    <div class="card-body">
                        <h2 class="card-title h4 my-1"><b>Status:</b> Account in Überprüfung</h2>
                        <p class="card-text">Ihr Account wurde angelegt, muss aber noch durch einen Administrator geprüft und freigegeben werden. Die Administration wurde per E-Mail über Ihre Anmeldung informiert.</p>
                    </div>
                </div>
            @elseif ($user->rejected)
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Account für <b>{{ $user->name }}</b></div>
                    <div class="card-body">
                        <h2 class="card-title h4 my-1"><b>Status:</b> Aktivierung abgelehnt</h2>
                        <p class="card-text">Ihr Account wurde nach Prüfung nicht freigegeben. Bitte <a href="mailto:{{ env('APP_MAIL') }}?subject=Aktivierung%20des%20Accounts%20von%20{{ $user->name }}%20(User-ID {{ $user->id }})">schreiben Sie uns eine E-Mail</a>, falls Sie eine erneute Prüfung veranlassen möchten.</p>
                    </div>
                </div>
            @elseif ($user->approved)
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Account für <b>{{ $user->name }}</b></div>
                    <div class="card-body">
                        <h2 class="card-title h4 my-1"><b>Status:</b> Aktivierung bestätigt</h2>
                        <p class="card-text">Ein Administrator hat Ihre Registrierung geprüft und freigegeben. Sie können den <a href="{{ url('/dashboard') }}">Backend-Bereich</a> frei nutzen.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
</main>
@endsection
