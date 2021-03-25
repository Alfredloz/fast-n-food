<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'PageController@index')->name('homepage');


// single restaurant route and checkout
Route::prefix('restaurant')->name('restaurant.')->group(function(){
    Route::get('{user}', 'PageController@restaurant')->name('restaurant');
    Route::get('{user}/checkout', 'PageController@checkout')->name('checkout');
});

Auth::routes();

// PaymentController
Route::get('/payment', 'PaymentController@make')->name('payment');
Route::get('/order', 'OrderController@index')->name('order');

//!rotta temporanea
Route::get('/ordine', function(){
  return view('guests.ordine');
})->name('ordine');

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
  
  // Home route
  Route::get('/', 'HomeController@index')->name('index');
  
  // Statistic routes
  Route::get('statistics/orders', 'StatisticController@orders')->name('orders');
  Route::get('statistics/sold', 'StatisticController@sold')->name('sold');
  
  // Crud Plate Controller routes
  Route::resource('plates', 'PlateController');
  Route::put('plates/{plate}/visibility', 'PlateController@visibility')->name('plates.visibility');
});
