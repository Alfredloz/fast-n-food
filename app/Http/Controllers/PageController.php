<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     /** single restaurant
     * single restaurant return
     * 
     */
    public function restaurant()
    {   
        return view('guests.restaurant');
    }
}
