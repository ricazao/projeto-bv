<?php

namespace App\Http\Controllers;

use App\Data\DashboardData;
use App\Data\DashboardPins;

class DashboardController
{
    public function __invoke()
    {
        $data = DashboardData::get();
        $pins = DashboardPins::get();

        return view('dashboard.index', compact('data', 'pins'));
    }
}
