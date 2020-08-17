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


Auth::routes();

Route::resource('home', 'HomeController')
->only('index');
Route::get('/','HomeController@index');

/*
    Create all the routes for every functions in MessageController.
    //Route::post('/store', 'MessageController@store'); 
    //Route::get('/message/{id}','MessageController@show');
*/
Route::resource('messageboard', 'MessageboardController');
Route::get('mymessageboard', 'MyMessageboardController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
