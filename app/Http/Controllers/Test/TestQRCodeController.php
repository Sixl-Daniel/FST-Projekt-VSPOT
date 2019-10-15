<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QrCode;

class TestQRCodeController extends Controller
{
    public function email(Request $request) {
        $email = $request->input('email', 'info@vspot.eu');
        $subject = $request->input('subject', 'Anfrage an VSPOT');
        $body = $request->input('subject', 'Ihre Nachricht an VSPOT Digital Signage Solution');
        $qr = QrCode::encoding('UTF-8')
            ->size(300)
            ->backgroundColor(255,255,255)
            ->color(51,51,51)
            ->email($email, $subject, $body);
        return view('tests.qrcode')
            ->with('qr', $qr)
            ->with('heading', 'E-Mail');
    }

    public function link(Request $request) {
        $link = $request->input('link', 'https://vspot.eu');
        $qr = QrCode::encoding('UTF-8')
            ->size(300)
            ->backgroundColor(255,255,255)
            ->color(51,51,51)
            ->generate($link);
        return view('tests.qrcode')
            ->with('qr', $qr)
            ->with('heading', 'Verlinkung');
    }

    public function phone(Request $request) {
        $number = $request->input('number', '040428990');
        $qr = QrCode::encoding('UTF-8')
            ->size(300)
            ->backgroundColor(255,255,255)
            ->color(51,51,51)
            ->phoneNumber($number);
        return view('tests.qrcode')
            ->with('qr', $qr)
            ->with('heading', 'Telefonnummer');
    }
}
