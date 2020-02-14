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
    .auth-device-link {
        font-size: 14px;
    }
    .copyright {
        margin-top: 1.5em;
    }
    a,
    a:link,
    a:visited,
    a:hover,
    a:active{
        text-decoration: none;
    }
@endpush

@section('content')
<h1 class="heading"><span class="w700">VSPOT</span> <span class="w200">Digital Signage Solution</span></h1>

<section>
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
    <p><strong>Beschreibung:</strong><br>{{ $device->description }}</p><p><strong>Achtung:</strong><br>Die Zugänge auf dieser Seite sollten nur für Geräte und Applikationen verwendet werden. Die hier eingesetzten Keys sind geräte- bzw. applikationsabhängig und autorisieren diese.</p>
</section>

<section>
    <h2>Zugänge für Geräte und Applikationen</h2>
    <p>Web-Zugang für Geräte:<br><a class="auth-device-link" href="{{ $device->weburl }}">{{ $device->weburl }}</a></p>
    <p>API-Zugang für Applikationen:<br><a class="auth-device-link" href="{{ $device->apiurl }}">{{ $device->apiurl }}</a></p>
    <p>Um nur den Zeitstempel des letzten Updates als JSON-Response zu erhalten, hängen Sie bitte den Parameter <b>timestamp</b> an den jeweiligen Link an.</p>
</section>

<section>
    <h2>QR-Codes</h2>
    <table class="qr-codes">
        <tr>
            <th>Web-Access</th>
            <th>API-Access</th>
        </tr>
        <tr>
            <td><img src="{{ $device->getWebQRImgSrc(200) }}"/></td>
            <td><img src="{{ $device->getApiQRImgSrc(200) }}"/></td>
        </tr>
    </table>
</section>
@endsection

