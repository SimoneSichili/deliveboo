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

Route::get('/', 'RestaurantController@index')->name('welcome');
Route::get('/restaurant/{slug}', 'RestaurantController@show')->name('restaurant');
Route::get('/restaurant/{slug}/checkout', 'RestaurantController@checkout')->name('checkout');
Route::post('/restaurant/{slug}/checkout', 'RestaurantController@store')->name('store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin') // prefisso rotte
    ->namespace('Admin') // namespace (sottocartelle Controller)
    ->middleware('auth') // filtro per autenticazione
    ->name('admin.') // prefisso di tutti i nomi delle rotte
    ->group(function() {

        Route::resource('dishes', 'DishController');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('dashboard/stats', 'DashboardController@stats')->name('stats');

    }
);


