<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    /** StatistiController@orders method.
     * @param Illuminate\Support\Facades\Auth
     * @return string path and compact data
     */
    public function orders()
    {
        $orders = json_encode(Auth::user()->orders);
        //dd($orders);
        return view('admin.statistics.orders', compact('orders'));
    }

    /** StatistiController@orders method.
     * @param Illuminate\Support\Facades\Auth
     * @return string path and compact data
     */
    public function sold()
    {
        $bills = Auth::user()->orders;
        //dd($bill);
        return view('admin.statistics.sold', compact('bills'));
    }
}
