<p>Benutzer: <strong>{{ $user->name }}</strong><br>
Gerätename: <strong>{{ $device->display_name }}</strong><br>
Gerätekennung: <strong>{{ $device->product_reference ?? 'ohne Angabe' }}</strong><br>
Location: <strong>{{ $device->location ?? 'ohne Angabe' }}</strong></p>
