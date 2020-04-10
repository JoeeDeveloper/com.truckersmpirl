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
    // View Calendar (auth)
    Route::get('/calendar', 'CalendarController@index')->name('calendar');
    // View events table (auth)
    Route::get('/eventstable', 'EventController@table')->name('eventsTable');

    Route::prefix('events')->group(function () {
        // View event (auth)
        Route::get('/{event}', 'EventController@index')->name('event');
        // Attend event (auth)
        Route::post('/{event}/attend', 'EventController@attend')->name('attendEvent');
    });
    // Can manage events
    Route::group(['middleware' => ['can:manage events']], function () {
        // Can view create event (auth, manage events)
        Route::view('/create', 'createevent');
        // Create event (auth. manage events)
        Route::post('/create/event', 'EventController@create')->name('createEvent');

        Route::prefix('events')->group(function () {
            // can update event (auth, manage events)
            Route::post('/{event}/update', 'EventController@update')->name('updateEvent');
            // can delete event (auth, manage events)
            Route::post('/{event}/delete', 'EventController@delete')->name('deleteEvent');
            // can restore event (auth, manage events)
            Route::post('/{event}/restore', 'EventController@restore')->name('restoreEvent');
        });

    });

    Route::prefix('admin')->group(function () {
        Route::get('/users', 'AdminController@usersIndex')->name('adminUsers');
    });
});

// Route::get('/home', 'HomeController@index')->name('home');
