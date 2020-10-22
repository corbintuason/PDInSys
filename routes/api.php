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
    Route::put('/account/{id}', 'API\AccountController@update');
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
    
    // Budget Request
    Route::get('/budget_request', 'API\BudgetRequestController@index');
    Route::post("/budget_request/", "API\BudgetRequestController@store");
    Route::get('/budget_request/{id}', 'API\BudgetRequestController@show');
    Route::put('/budget_request/{id}', 'API\BudgetRequestController@update');
    Route::put('/budget_request/{id}/saveChanges', 'API\BudgetRequestController@saveChanges');
    

    Route::put("/liquidation_journal/{id}", "API\LiquidationJournalController@update");
    Route::put("/liquidation_journal/{id}/saveState", "API\LiquidationJournalController@saveState");


    // Additional Routes
    Route::put("/project/{id}/returnToUser", 'API\ProjectController@returnToUser');
    Route::get('/activities', "API\ActivityController@index");

    // Mandate
    Route::get('/mandate', 'API\MandateController@index');
    Route::post('/mandate/', 'API\MandateController@store');
    Route::get('/mandate/{id}', 'API\MandateController@show');
    Route::put('/mandate/{id}', 'API\MandateController@update');
    Route::put('/mandate/{id}/saveChanges', 'API\MandateController@saveChanges');
    Route::put('/mandate/{id}/returnToUser', 'API\MandateController@returnToUser');
    Route::put('/mandate/{id}/reject', 'API\MandateController@reject');

    // Vendor
    Route::get('/vendor', 'API\VendorController@index');
    Route::post('/vendor/', 'API\VendorController@store');
    Route::get('/vendor/{id}', 'API\VendorController@show');
    Route::put('/vendor/{id}', 'API\VendorController@update');
    Route::put('/vendor/{id}/saveChanges', 'API\VendorController@saveChanges');
    Route::put('/vendor/{id}/returnToUser', 'API\VendorController@returnToUser');
    Route::put('/vendor/{id}/reject', 'API\VendorController@reject');

    Route::get('/erfp', 'API\ERFPController@index');
    Route::post('/erfp', 'API\ERFPController@store');
    Route::get('/erfp/{id}', 'API\ERFPController@show');
    Route::put('/erfp/{id}', 'API\ERFPController@process');
    Route::post('/erfp/{id}/saveChanges', 'API\ERFPController@saveChanges');
    Route::put('/erfp/{id}/releaseCash', 'API\ERFPController@releaseCash');
    Route::post('/erfp/downloadQuotation', 'API\ERFPController@downloadQuotation');

    Route::put('/erfpable/{id}', 'API\ERFPableController@update');

    Route::post('/term_of_payment/{id}/cashRelease', 'API\TermOfPaymentController@cashRelease');
    Route::post('/term_of_payment/downloadPayment', 'API\TermOfPaymentController@downloadPayment');
    
    Route::put('/closing_erfp/{id}/saveChanges', 'API\ClosingERFPController@saveChanges');
    Route::put('/bouncer/hasAbility', 'API\BouncerController@hasAbility');

});



// Route::middleware('auth:api')->get('/init', function (Request $request) {
//     return new UserResource($request->user());
// });

// Route::get('/user', function (Request $request) {
//     return auth()->guard('api')->user();
//   });
// Route::api()


