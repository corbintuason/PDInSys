<?php

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
// MAIL ROUTES
Route::get('/mail/newUserCreated', 'Mail\UserController@newUserCreated')->name("New User Created");



// Route to redirect all pages to a single view page.
Route::get('/{any}', function() { 
    return view('welcome'); 
})->where('any', '(.*)');
