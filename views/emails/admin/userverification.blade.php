@component('mail::message')
# Neuer Nutzer

Der Nutzer wurde verifiziert und muss überprüft werden.

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
