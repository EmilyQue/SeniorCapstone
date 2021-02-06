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

Route::get('/home', function () {
    return view('home');
});

/*Route is mapped to the '/login' URI and will return the login view */
Route::get('/login', function() {
    return view('login');
});

/*Fetches the post parameters of login*/
Route::post('/login', 'App\Http\Controllers\LoginController@index');

Route::get('/logout', 'App\Http\Controllers\LoginController@logout');

/*Route is mapped to the '/register' URI and will return the register view */
Route::get('/register', function() {
    return view('register');
});

/*Fetches the post parameters of registration*/
Route::post('/register', 'App\Http\Controllers\RegisterController@index');

/*Route is mapped to the '/register' URI and will return the register view */
Route::get('/addPost', function() {
    return view('addPost');
});

/*Fetches the post parameters of registration*/
Route::post('/addPost', 'App\Http\Controllers\PostController@index');
