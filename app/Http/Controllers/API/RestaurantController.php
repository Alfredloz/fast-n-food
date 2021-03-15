<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant as RestaurantResource;
use App\User;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $callback = function($query) {
            if (request()->input('typology_id') != 0){
                $query->where('id' , '=' ,request()->input('typology_id') );
            }
        };

        $restaurants = User::whereHas('typologies', $callback)->get();//->with(['typologies' => $callback])->get();

        return RestaurantResource::collection($restaurants);       
    }

}
