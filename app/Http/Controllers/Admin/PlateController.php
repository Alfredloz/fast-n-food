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
      $plates = Auth::user()->plates()->latest()->get();
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
        $request['slug'] = Str::slug($request->name . '-' . Auth::user()->id);
        
        $validatedData = $request->validate([            
            'name' => 'required',
            'description_ingredients' => 'required',
            'picture' => 'nullable | image | max:500',
            'price' => 'required | numeric | max:9999,99',
            'visibility' => 'required',
            'slug' => 'unique:plates'
        ]);
    
        $validatedData['user_id'] = Auth::user()->id;

        $picture = Storage::put('img/plates', $request->picture);
        $validatedData['picture'] = $picture;
        
        Plate::create($validatedData);

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
    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plate $plate)
    {
        $validatedData = $request->validate([            
            'name' => 'required',
            'description_ingredients' => 'required',
            'picture' => 'nullable | image | max:500',
            'price' => 'required | numeric | max:9999,99',
            'visibility' => 'required'
        ]);
            
        if ($request->hasFile('picture')) {
            Storage::delete($plate->picture);
            $picture = Storage::put('img/plates', $request->picture);
            $validatedData['picture'] = $picture;
        }
            
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['slug'] = Str::slug($request->name . '-' . $validatedData['user_id']);
        
        $plate->update($validatedData);

        return redirect()->route('admin.plates.show', $plate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plate $plate)
    {
        Storage::delete($plate->picture);
        $plate->delete();
        return redirect()->route('admin.plates.index');
    }
}
