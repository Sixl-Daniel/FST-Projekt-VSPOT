<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Lava;

class DashboardController extends Controller
{
    public function index()
    {
        /*
         * quotes
         */

        $quote = Inspiring::quote();

        /*
         * charts user
         */

        $users = User::verified()->get()->sortBy('email_verified_at');
        $userCount = 0;
        $userChartDataTable = Lava::DataTable();
        $userChartDataTable->addDateColumn('Date')->addNumberColumn('Benutzer');
        foreach ($users as $u) {
            $userCount++;
            $userChartDataTable->addRow([$u->email_verified_at,  $userCount]);
        }
        $userChart = Lava::AreaChart('userchart', $userChartDataTable, [
            'title' => 'Registrierung neuer User',
            'legend' => [
                'position' => 'in'
            ],
            'pointSize' => 4,
        ]);
        return view("backend.dashboard")
            ->with([
                'quote' => $quote,
                'userchart' => $userChart
            ]);
    }
}
