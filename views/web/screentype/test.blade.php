<p class="text-left mt-0">
Benutzer: <strong>{{ $user->name }}</strong><br>
Gerät: <strong>{{ $device->display_name }}</strong><br>
Location: <strong>{{ $device->location ?? 'keine Angabe' }}</strong><br>
Kanal: <strong>{{ $channel->name }}</strong><br>
</p>
