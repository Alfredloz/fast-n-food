<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function orders()
    {
        return view('admin.statistics.orders');
    }

    public function sold()
    {
        return view('admin.statistics.sold');
    }
}
