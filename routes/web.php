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

// Route::get('/home', function () {
//     return view('home');
// });
/*Fetches the get parameters of all blog posts*/
Route::get('/home', 'App\Http\Controllers\PostController@displayFeaturedPosts');

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
// Route::get('/profile', function() {
//     return view('userProfile');
// });

/*Fetches the get parameters of display profile method in profile controller*/
Route::get('/profile', 'App\Http\Controllers\ProfileController@displayUserProfile');

/*Fetches the post parameters of add profile info*/
Route::post('/addProfile', 'App\Http\Controllers\ProfileController@index');

/*Fetches the post parameters of profile info*/
Route::get('/addProfile', 'App\Http\Controllers\ProfileController@displayUserProfile');

/*Fetches the get parameters of update profile method in profile controller*/
Route::get('/updateProfile', 'App\Http\Controllers\ProfileController@findProfile');

/*Fetches post parameters of updated user profile info*/
Route::post('/updateProfile', 'App\Http\Controllers\ProfileController@updateProfileInfo');

/*Fetches post parameters of updated user recent travel info*/
Route::post('/addRecentTravel', 'App\Http\Controllers\ProfileController@addRecentTravel');

/* BLOG POSTS */

/*Route is mapped to the '/addPost' URI and will return the addPost view */
Route::get('/addPost', function() {
    return view('addPost');
});

/*Fetches the post parameters of adding a blog post*/
Route::post('/addPost', 'App\Http\Controllers\PostController@index');

/*Fetches the get parameters of search blog post method in post controller*/
Route::get('/search', 'App\Http\Controllers\PostController@searchBlogPost');

/*Fetches the get parameters of all blog posts*/
Route::get('/displayPosts', 'App\Http\Controllers\PostController@displayAllPosts');

/*Fetches the get parameters of user blog posts*/
Route::get('/displayMyPosts', 'App\Http\Controllers\PostController@displayUserPosts');

/*Fetches the get parameters of individual blog posts*/
Route::get('/displaySinglePost', 'App\Http\Controllers\PostController@displaySinglePost');

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
