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

/* LOGIN */

/*Route is mapped to the '/login' URI and will return the login view */
Route::get('/login', function() {
    return view('login');
});

/*Fetches the post parameters of login*/
Route::post('/login', 'App\Http\Controllers\LoginController@index');

Route::get('/logout', 'App\Http\Controllers\LoginController@logout');

/* REGISTER */

/*Route is mapped to the '/register' URI and will return the register view */
Route::get('/register', function() {
    return view('register');
});

/*Fetches the post parameters of registration*/
Route::post('/register', 'App\Http\Controllers\RegisterController@index');

/* USER PROFILE */
/*Route is mapped to the '/addPost' URI and will return the addPost view */
Route::get('/profile', function() {
    return view('userProfile');
});

/* BLOG POSTS */

/*Route is mapped to the '/addPost' URI and will return the addPost view */
Route::get('/addPost', function() {
    return view('addPost');
});

/*Fetches the post parameters of adding a blog post*/
Route::post('/addPost', 'App\Http\Controllers\PostController@index');

/*Fetches the get parameters of search blog post method in post controller*/
Route::get('/search', 'App\Http\Controllers\PostController@searchBlogPost');

/*Fetches the get parameters of user blog posts*/
Route::get('/displayPosts', 'App\Http\Controllers\PostController@displayAllPosts');

/*Route is mapped to the '/editPost' URI and will return the edit blog post form */
Route::get('/editPost', 'App\Http\Controllers\PostController@findUserPosts');

/*Fetches the post parameters of updated blog post*/
Route::post('/updatePosts', 'App\Http\Controllers\PostController@updateBlogPost');

/*Fetches the get parameters of deleteBlogPost method in Post controller*/
Route::get('/deletePost', 'App\Http\Controllers\PostController@deleteBlogPost');

/* ADMIN USERS */

/*Fetches the get parameters of users admin*/
Route::get('/usersAdmin', 'App\Http\Controllers\AdminController@index');

/*Fetches the get parameters of suspendUser method in the Admin controller*/
Route::get('/adminSuspend', 'App\Http\Controllers\AdminController@suspendUser');

/*Fetches the get parameters of unsuspendUser method in the Admin controller*/
Route::get('/adminUnsuspend', 'App\Http\Controllers\AdminController@unsuspendUser');
