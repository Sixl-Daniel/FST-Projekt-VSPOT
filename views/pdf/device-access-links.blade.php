@extends('pdf.master')

@push('top_css')
    table.qr-codes {
        table-layout: fixed;
        border-collapse: collapse;
    }
    table.qr-codes img {
        display: block;
    }
    table.qr-codes td,
    table.qr-codes th {
        text-align: center;
        width: 25%;
    }
    .copyright {
        margin-top: 1.5em;
    }
@endpush

@section('content')
<h1 class="heading"><span class="w700">VSPOT</span> <span class="w200">Digital Signage Solution</span></h1>
<table>
    <tr>
        <th>Benutzer:</th>
        <th>Bezeichnung:</th>
        <th>Gerätereferenz:</th>
        <th>Location:</th>
    </tr>
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $device->display_name }}</td>
        <td>{{ $device->product_reference ?? 'ohne Angabe' }}</td>
        <td>{{ $device->location ?? 'ohne Angabe' }}</td>
    </tr>
</table>
<p><strong>Beschreibung:</strong><br>{{ $device->description }}</p>
<section>
    <h2>Link für den Web-Zugang</h2>
    <p><a href="{{ $weburl }}">{{ $weburl }}</a></p>
</section>
<section>
    <h2>Link für den API-Zugang</h2>
    <p><a href="{{ $apiurl }}">{{ $apiurl }}</a></p>
</section>
<section>
    <h2>Zeitstempel</h2>
    <p>Um nur den Zeitstempel des letzten Updates als JSON-Response zu erhalten, hängen Sie bitte den Parameter <b>timestamp</b> an den jeweiligen Link an:</p>
    <p>Letztes Update des Web-Zugangs:<br><a href="{{ $apiurl . '&timestamp' }}">{{ $apiurl . '&timestamp' }}</a></p>
    <p>Letztes Update des API-Zugangs:<br><a href="{{ $weburl . '&timestamp' }}">{{ $weburl . '&timestamp' }}</a></p></p>
</section>
<section>
    <h2>QR-Codes</h2>
    <table class="qr-codes">
        <tr>
            <th>Web-Access<br>Inhalte</th>
            <th>API-Access<br>Inhalte</th>
            <th>Web-Access<br>Zeitstempel</th>
            <th>API-Access<br>Zeitstempel</th>
        </tr>
        <tr>
            <td><img width="{{ $qrCodeSize }}" height="{{ $qrCodeSize }}" src="data:image/png;base64, {{ $webqr_b64 }}"/></td>
            <td><img width="{{ $qrCodeSize }}" height="{{ $qrCodeSize }}" src="data:image/png;base64, {{ $apiqr_b64 }}"/></td>
            <td><img width="{{ $qrCodeSize }}" height="{{ $qrCodeSize }}" src="data:image/png;base64, {{ $webqr_b64_ts }}"/></td>
            <td><img width="{{ $qrCodeSize }}" height="{{ $qrCodeSize }}" src="data:image/png;base64, {{ $apiqr_b64_ts }}"/></td>
        </tr>
    </table>
</section>
@endsection

