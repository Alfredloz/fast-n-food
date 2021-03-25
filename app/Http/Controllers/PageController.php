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

    /** checkout page
     * checkout return
     *
     */
    public function checkout(User $user)
    {   
        $restaurant = $this->restaurantInfoJson($user);

        return view('guests.checkout', compact('restaurant'));
    }

     /** single restaurant
     *  @param User -> $user
     *  single restaurant return as json array (plates).
     */
    public function restaurant(User $user)
    {
        $restaurant = $this->restaurantInfoJson($user);
        $banner = $user->restaurant_banner;
        $plates = json_encode( $user->plates );
        //dd($restaurant, $plates);
        return view('guests.restaurant', compact('restaurant', 'plates', 'banner'));
    }

    /** restaurantInfoJson method   
     * @param User -> $user
     * 
     * return a json array of the restaurant informations.
     */
    private function restaurantInfoJson(User $user)
    {
        return json_encode( [
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
    }
}
