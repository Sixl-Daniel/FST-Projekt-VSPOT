@component('backend.components.box_standard', ['icon' => 'chalkboard-teacher', 'title' => 'Nachrichten'])

    <p class="lead">Hallo, {{ auth()->user()->name }}.</p>

    @if(auth()->user()->is('guest'))
        @component('backend.components.alert', ['title' => 'Gastzugang', 'type' => 'warning','icon' => 'exclamation-triangle'])
            <p>Ihr Account wurde erstellt. Sie sind zunächst als Gast bei VSPOT registriert und haben nur sehr eingeschränkten Zugang zum Backend dieser Anwendung.</p>
            <p>Die Administration wurde per E-Mail über Ihre Anmeldung informiert und wird Ihren Zugang zeitnah prüfen und gegebenfalls freischalten.</p>
        @endcomponent
    @endif

    @if(auth()->user()->is('superadmin'))
        @component('backend.components.alert', ['title' => 'Rolle: Super-Admin'])
            <p>Sie sind als Super-Administrator eingeloggt. Sie besitzen damit alle Rechte des normalen Admins, können aber nicht editiert oder gelöscht werden. Systemnachrichten werden von Ihnen bearbeitet.</p>
        @endcomponent
    @endif

    @if(auth()->user()->is('admin'))
        @component('backend.components.alert', ['title' => 'Rolle: Admin'])
            <p>Sie sind als Administrator eingeloggt. Sie besitzen damit das Recht zur Nutzerverwaltung.</p>
        @endcomponent
    @endif

    @if(auth()->user()->is('inspector'))
        @component('backend.components.alert', ['title' => 'Rolle: Inspektor'])
            <p>Sie sind als Inspektor eingeloggt. Sie haben damit das Recht, die Administartionsbereiche einzusehen.</p>
        @endcomponent
    @endif

    @if(auth()->user()->is('user'))
        @component('backend.components.alert', ['title' => 'Rolle: Benutzer'])
            <p>Sie sind als Benutzer eingeloggt. Sie haben damit das Recht Ihre Geräte und Channels zu verwalten.</p>
        @endcomponent
    @endif

@endcomponent
