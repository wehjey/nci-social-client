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

Route::middleware('auth.login')->group(function(){

    /**
     * Topics
     */
    Route::get('/', 'TopicController@home');
    Route::get('topic/{id}', 'TopicController@show');
    Route::get('delete-topic/{id}', 'TopicController@delete');
    Route::post('topic', 'TopicController@store');
    Route::get('comment-remove/{comment_id}', 'TopicController@removeComment');
    Route::post('comment', 'TopicController@makeComment');

    /**
     * Shop
     */
    Route::get('shop', 'ShopController@show');
    Route::get('category/{id}', 'ShopController@getProductsByCategory');
    Route::get('product/{id}', 'ShopController@viewProduct');
    Route::get('delete-product/{id}', 'ShopController@deleteProduct');
    Route::post('product', 'ShopController@addProduct');
    Route::get('order/{id}', 'ShopController@makeOrder');
    
    Route::get('my', 'ProfileController@profile');
    Route::get('my/topics', 'ProfileController@topics');
    Route::get('my/orders', 'ProfileController@orders');
    Route::get('my/products', 'ProfileController@products');
    Route::post('profile', 'ProfileController@updateProfile');
});

Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@submitLogin');
Route::get('register', 'AuthController@showRegisterForm')->name('register');
Route::post('register', 'AuthController@submitRegister');
Route::get('signout', 'AuthController@signOut');