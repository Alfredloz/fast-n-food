<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function orders()
    {
        $orders = json_encode(Auth::user()->orders);
        //dd($orders);
        return view('admin.statistics.orders', compact('orders'));
    }

    public function sold()
    {
        $bills = Auth::user()->orders;
        //dd($bill);
        return view('admin.statistics.sold', compact('bills'));
    }
}
