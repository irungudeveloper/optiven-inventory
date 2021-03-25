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

//Route for Department Controller
Route::resource('department','DepartmentsController');

//Route for Employee Controller
Route::resource('employee','EmployeeController');

//Route for Order Controller
Route::resource('order','OrderController');

//Route for Issue Controller
Route::resource('issue','IssueController');

//Route for AJAX REQUESTS
Route::post('issue/item','IssueController@getPendingItems')->name('issue.item');
Route::post('issue/employee','IssueController@getPendingEmployee')->name('issue.employee');
Route::post('issue/category','IssueController@getAvailableInventory')->name('issue.category');
Route::post('pending/issued','IssueController@setPendingItem')->name('pending.issued');
Route::post('issue/returned','IssueController@returnIssuedItem')->name('issue.returned');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
