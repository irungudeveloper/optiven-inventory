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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard','DashboardController@index')->name('dashboard');

//Routes for category controller
Route::resource('category','CategoryController');

//Route for brand controller
Route::resource('brand','BrandController');

//Route for user-roles
Route::resource('role','RolesController');

//Route for Inventory Controller
Route::resource('inventory','InventoryController');

Route::get('register','Auth.RegisterController@index')->name('register');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
