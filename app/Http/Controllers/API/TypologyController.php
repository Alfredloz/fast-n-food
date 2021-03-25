<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Typology as TypologyResource;
use App\Typology;
use Illuminate\Http\Request;

class TypologyController extends Controller
{   
    /** TypologyController@index method 
     * return all typology like a collection
     */
    public function index()
    {
        return TypologyResource::collection(Typology::all());
    }
}
