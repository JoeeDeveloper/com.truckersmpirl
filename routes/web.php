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

Auth::routes();

// Public routes
Route::get('/', 'WelcomeController@index')->name('welcome');

// Authorised routes only
Route::middleware('auth')->group(function () {
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
    Route::get('/gallery', 'GalleryController@index')->name('gallery');
});

// Route::get('/home', 'HomeController@index')->name('home');
