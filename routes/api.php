<?php

use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", "API\AuthController@login")->name('login');
Route::middleware('auth:api')->post("/logout", "API\AuthController@logout");
Route::post("/register", "API\UserController@store");


Route::apiResources([
    'user' => 'API\UserController',
    'account' => 'API\AccountController'
]);

<<<<<<< HEAD
// Route::middleware('auth:api')->get('/init', function (Request $request) {
//     return new UserResource($request->user());
// });
Route::middleware('auth:api')->get('/init', "API\AuthController@user");
=======
Route::apiResources([
    'user' => 'API\UserController',
    'vendor' => 'API\VendorController'
]);

Route::middleware('auth:api')->get('/init', function (Request $request) {
    return new UserResource($request->user());
});
>>>>>>> 426c8b268e1aada7852d236b30c6f9ab4a4e51a5

// Route::get('/user', function (Request $request) {
//     return auth()->guard('api')->user();
//   });
// Route::api()
