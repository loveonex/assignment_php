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

//login
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

//log out
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout']);

// Route::middleware(['auth'])->group(function (){
    Route::get('/admin/product', 'Admin\ProductController@index');
    Route::match(['get', 'post'], '/admin/product/add', 'Admin\ProductController@add')
    ->name('route_Backend_Products_Add');
    Route::get('/admin/product/edit/{id}', 'Admin\ProductController@edit')
    ->name('route_Backend_Products_Edit');
    Route::post('/admin/product/update/{id}', 'Admin\ProductController@update')
    ->name('route_Backend_Products_Update');
// });