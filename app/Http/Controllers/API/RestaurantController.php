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
        ///////////////////////////////////////////
        // Soluzione che restituisce ogni ristorante che ha almeno una tipologia fra quelle selezionate ( in request()->input('typologies_ids') )
        //////////////////////////////////////////
        // $callback = function($query) {
        //     if (request()->input('typologies_ids')){
        //         $query->whereIn('id', request()->input('typologies_ids') );
        //     }
        // };

        // $restaurants = User::whereHas('typologies', $callback)->get();


        //////////////////
        //Query iterative
        //Soluzione che restituisce solo i ristoranti che hanno tutte le tipologie selezionate
        $selectedTypologies = request()->input('typologies_ids');

        $query = User::with('typologies');

        if ($selectedTypologies){
            foreach($selectedTypologies as $typologyID){
                $query->whereHas('typologies', function($q) use ($typologyID){
                    $q->where('id', $typologyID);
                });
            }
        }

        $restaurants = $query->get();

        return RestaurantResource::collection($restaurants);    
    }

}
