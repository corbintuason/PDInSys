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
Route::post("/register", "API\UserController@store");


Route::group(['middleware' => 'auth:api'], function () {
    Route::post("/logout", "API\AuthController@logout");
    Route::get('/init', "API\AuthController@user");

    Route::apiResources([
        'user' => 'API\UserController',
        'vendor' => 'API\VendorController',
        'mandate' => 'API\MandateController',
        'budget-allocation' => 'API\BudgetAllocationController',
        'project_core_employee' => 'API\ProjectCoreEmployeeController',
        'cost_estimate_detail' => 'API\CostEstimateDetailController',
        'signed_cost_estimate_detail' => 'API\SignedCostEstimateDetailController',
        'remark' => 'API\RemarkController',
    ]);

    // // Route::post('/budget-allocation/', 'API\BudgetAllocation@save');

    // Account Routes
    Route::get('/account', 'API\AccountController@index');
    Route::post('/account/', 'API\AccountController@store');
    Route::get('/account/{id}', 'API\AccountController@show');
    Route::put('/account/{id}', 'API\ProjecAccountController@update');
    Route::put('/account/{id}/saveChanges', 'API\AccountController@saveChanges');
    Route::put('/account/{id}/returnToUser', 'API\AccountController@returnToUser');
    Route::put('/account/{id}/reject', 'API\AccountController@reject');

    // Project Routes
    Route::get('/project', 'API\ProjectController@index');
    Route::post('/project/', 'API\ProjectController@store');
    Route::get('/project/{id}', 'API\ProjectController@show');
    Route::put('/project/{id}', 'API\ProjectController@update');
    Route::put('/project/{id}/saveChanges', 'API\ProjectController@saveChanges');

    // Cost Estimate Routes
    Route::get('/download_cost_estimate/{id}', 'API\CostEstimateController@download');
    Route::get('/download_signed_cost_estimate/{id}', 'API\SignedCostEstimateDetailController@download');
    Route::post('/project/{id}/cost-estimate', 'API\CostEstimateController@store');
    Route::put('/project/{id}/cost-estimate', 'API\CostEstimateController@update');
    // Cost Estimate Detail Routes
    Route::post('/cost_estimate_detail/{id}/saveChanges', 'API\CostEstimateDetailController@saveChanges');
    Route::post('/cost_estimate_detail/{id}/sign', 'API\CostEstimateDetailController@sign');
    Route::put('/signed_cost_estimate_detail/{id}/saveChanges', 'API\SignedCostEstimateDetailController@saveChanges');
    Route::post("/project/{id}/cost-estimate-detail", "API\CostEstimateDetailController@store");
    // Additional Routes

    Route::put("/project/{id}/returnToUser", 'API\ProjectController@returnToUser');
    Route::get('/activities', "API\ActivityController@index");

    // Mandate Routes
    // Route::get('/mandate', 'API\MandateController@index');
    // Route::post('/mandate', 'API\MandateController@store');
    // Route::get('/mandate/{id}', 'API\MandateController@show');
    // Route::put('/mandate/{id}', 'API\MandateController@update');
    // Route::put('/mandate/{id}/saveChanges', 'API\MandateController@saveChanges');
    // Route::put("/mandate/{id}/returnToUser", 'API\MandateController@returnToUser');

    Route::get('/mandate', 'API\MandateController@index');
    Route::post('/mandate/', 'API\MandateController@store');
    Route::get('/mandate/{id}', 'API\MandateController@show');
    Route::put('/mandate/{id}', 'API\ProjecMandateController@update');
    Route::put('/mandate/{id}/saveChanges', 'API\MandateController@saveChanges');
    Route::put('/mandate/{id}/returnToUser', 'API\MandateController@returnToUser');
    Route::put('/mandate/{id}/reject', 'API\MandateController@reject');
});



// Route::middleware('auth:api')->get('/init', function (Request $request) {
//     return new UserResource($request->user());
// });

// Route::get('/user', function (Request $request) {
//     return auth()->guard('api')->user();
//   });
// Route::api()
