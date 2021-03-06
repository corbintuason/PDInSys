<?php

use App\User;
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
// MAIL ROUTES'

Route::get('/mail/newUserCreated', 'Mail\UserController@newUserCreated')->name("New User Created");

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/mark-all-read', 'NotificationController@markAsRead');
});

Route::get('/api/budget_request/{id}/download','API\BudgetRequestController@download');

// Route to redirect all pages to a single view page.
// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '(.*)');
Route::get("/{any}", "AppController@welcome")->where('any', '(.*)');
