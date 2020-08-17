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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
    Create all the routes for every functions in MessageController.
    //Route::post('/store', 'MessageController@store'); 
    //Route::get('/message/{id}','MessageController@show');
*/
Route::resource('messageboard', 'MessageController')
->only('index','store','show');
