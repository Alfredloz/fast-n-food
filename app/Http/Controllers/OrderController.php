<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $plates_bought = $request->input('plates_bought');
        $total = $request->input('total');
        
        $newOrder = Order::create([
            'user_id' => $plates_bought[0]['user_id'],
            'total_price' => $total
        ]);

        $newOrder->save();

        foreach($plates_bought as $plate){
            $newOrder->plates()->attach($plate['id'], ['plate_quantity' => $plate['quantity']]);
        }

        return response()->json($plates_bought);
    }
}
