@component('mail::message')
# Freigabe ausstehend

Ein neuer Benutzer wurde verifiziert und wartet auf Freischaltung:

@component('mail::panel')
Nachname: **{{$user->last_name}}**<br>
Vorname: **{{$user->first_name}}**<br>
E-Mail: **{{$user->email}}**<br>
Nutzername: **{{$user->username}}**<br>
Nutzer-Id: **{{$user->id}}**<br>
@endcomponent

Vielen Dank,<br>
VSPOT Digital Signage Solution
@endcomponent
