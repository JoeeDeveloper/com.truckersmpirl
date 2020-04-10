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
Route::view('/terms-of-service', 'tos');
Route::view('/privacy-policy', 'pp');
// Redirects
Route::redirect('/discord', 'https://discord.gg/xCju3qz');
Route::redirect('/twitter', 'https://twitter.com/truckersmp');
Route::redirect('/truckersmp', 'https://truckersmp.com');

// Authorised routes only
Route::middleware('auth')->group(function () {
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
    Route::get('/events/{event}', 'EventController@index')->name('event');
    Route::post('/events/{event}/attend', 'EventController@attend')->name('attendEvent');
    Route::post('/events/{event}/delete', 'EventController@delete')->name('deleteEvent');
});

// Route::get('/home', 'HomeController@index')->name('home');
