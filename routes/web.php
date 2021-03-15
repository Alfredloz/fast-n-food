<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', 'PageController@index')->name('homepage');
// Route temporanea per la homepage
Route::get('/home', function ()
{
    return view('guests.index');
})->name('homepage');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
  Route::get('/', 'HomeController@index')->name('index');
  Route::resource('plates', 'PlateController');
});
