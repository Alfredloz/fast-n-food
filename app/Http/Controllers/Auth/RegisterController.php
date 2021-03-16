<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Typology;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Override of the showRegistarionForm in trait RegistersUsers
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $typologies = Typology::all();

        return view('auth.register', compact('typologies'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'piva'=> ['required', 'string', 'max:11'],
            'restaurant_name'=> ['required', 'string', 'max:50','unique:users'],
            'restaurant_description'=> ['required', 'string'],
            'restaurant_logo'=> ['required', 'image', 'max:500'],
            'restaurant_banner'=> ['nullable', 'image', 'max:1000'],
            'address'=> ['required', 'string'],
            'phone_number'=> ['required', 'string'],
            'typologies'=> ['required', 'exists:typologies,id']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $data['slug'] = Str::slug($data['restaurant_name']);

        $user = User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'piva'=> $data['piva'],
            'restaurant_name'=> $data['restaurant_name'],
            'restaurant_description'=> $data['restaurant_description'],
            'restaurant_logo'=> Storage::put('img/restaurant', $data['restaurant_logo']),
            'restaurant_banner'=> Storage::put('img/restaurant', $data['restaurant_banner']),
            'address'=> $data['address'],
            'phone_number'=> $data['phone_number'],
            'slug'=> $data['slug']
        ]);
         
        //attaching typologies ids to the user
        $user->typologies()->attach($data['typologies']);
        return $user;
    }
}
