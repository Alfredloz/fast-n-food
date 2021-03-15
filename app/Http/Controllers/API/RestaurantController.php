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
        return RestaurantResource::collection(User::with('typologies')->get());
    }

}
