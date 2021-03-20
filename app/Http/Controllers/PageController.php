<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PageController extends Controller
{
    /** index page
     * index return
     *
     */
    public function index()
    {
        return view('guests.index');
    }

    /** index page
     * index return
     *
     */
    public function checkout()
    {   
      return view('guests.checkout');
    }

     /** single restaurant
     * single restaurant return
     *
     */
    public function restaurant(User $user)
    {
        $restaurant = json_encode( [
        'id' => $user->id,
        'restaurant_name' => $user->restaurant_name,
        'restaurant_description' => $user->restaurant_description,
        'restaurant_logo' => $user->restaurant_logo,
        'restaurant_banner' => $user->restaurant_banner,
        'address' => $user->address,
        'phone_number' => $user->phone_number,
        'slug' => $user->slug,
        'typologies' => $user->typologies
        ] );
        $plates = json_encode( $user->plates );
        //dd($restaurant, $plates);
        return view('guests.restaurant', compact('restaurant', 'plates'));
    }
}
