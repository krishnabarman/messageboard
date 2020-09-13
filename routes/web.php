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


Route::resource('messageboard', 'MessageboardController');
Route::view('posts', 'pages.messageboard.index_message'); // Calling the view directly, MessageboardController@index will return api data



Route::resource('category', 'BacklinkApp\CategoryController');
Route::get('admindashboard', 'BacklinkApp\ShowAdminDashboard');
Route::resource('subcategory', 'BacklinkApp\SubcategoryController');
Route::resource('domain', 'BacklinkApp\DomainController');
