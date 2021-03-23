<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use Illuminate\Support\Facades\Mail;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $plates_bought = $request->input('plates_bought');
        $total = $request->input('total');
        $clientInfo = $request->input('clientInfo');

        $newOrder = Order::create([
            'user_id' => $plates_bought[0]['user_id'],
            'total_price' => $total
        ]);

        $newOrder->save();

        foreach($plates_bought as $plate){
            $newOrder->plates()->attach($plate['id'], ['plate_quantity' => $plate['quantity']]);
        }

        $user = User::find($plates_bought[0]['user_id']);

        Mail::to($user->email)->send(new Email($plates_bought, $total, $clientInfo));

        return response()->json($plates_bought);
    }
}
