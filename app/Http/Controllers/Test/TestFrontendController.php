<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Mail\TestEmailStandard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class TestFrontendController extends Controller
{
    public function email () {
        Mail::to(env('INITIAL_ADMIN_EMAIL'))->send(new TestEmailStandard());
        return redirect()->route('front')->with('toast-success', 'Ihre Test-E-Mail wurde versendet.');
    }
}
