<?php

namespace App\Http\Controllers\Admin;

use App\Plate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $plates = Auth::user()->plates;
      return view('admin.plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([            
            'name' => 'required',
            'description_ingredients' => 'required',
            'picture' => 'nullable | file | max:500',
            'price' => 'required | numeric | max:9999,99',
            //'slug' => 'required',
            'visibility' => 'required',
            //'user_id' => 'required',
            ]);
    
    Auth::user();
    $plate = new Plate();
    $plate->user_id=Auth::user()->id;

        
    
    dd($plate);    

        $picture = Storage::put('img/plates', $request->picture);
        $validatedData['picture'] = $picture;

        
            
        Plate::create($validatedData);

        
        // $new_plate = Plate::orderBy('id', 'desc')->first();
        // $request['slug'] = Str::slug($request->name . '-' . $new_plate->id);
        // $new_plate = Plate::orderBy('id', 'desc')->first();


        return redirect()->route('admin.plates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plate $plate)
    {
      return view('admin.plates.show', compact('plate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
