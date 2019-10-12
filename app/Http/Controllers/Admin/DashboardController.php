<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $quote = Inspiring::quote();
        return view("backend.dashboard")
            ->with(['quote' => $quote]);
    }
}
