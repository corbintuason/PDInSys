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
});



// Route::middleware('auth:api')->get('/init', function (Request $request) {
//     return new UserResource($request->user());
// });

// Route::get('/user', function (Request $request) {
//     return auth()->guard('api')->user();
//   });
// Route::api()

// Document No - BRPD20-XXXX
// BR Requestor - Kung sino lang nakalogin
// AFG COUNTERPART - Disabled
// BR Liquidator - Kung sino nakalogin

// Make QTY Box Smaller (max 4)
// no of days venues (max 3)
// Additional Units:
/** 
 * SET/S, PC/S, PACKAGE, UNIT/S
 * 
 * No need for edit mode for Budget Requests
 * 
 *  AFG COUNTERPART WILL BE EDITABLE ONCE ITEM IS FOR RELEASE
 *  release, disburser cannot create a br
 * - Dropdown of Disubursing Officers
 * - All Accounts Payable Officer
 * 
 * When status is For Release
 * - Show modal muna of input bdo reference number
 * 
 * LIQUIDATION JOURNAL CODE:
 * LQPD(BR#)
 * 
 * 
 * - DATE -> CUSTOMER -> DESCRIPTION... INVOICE
 * - CATEGORY (REMOVE PRICE)
 * - Only Creator, Clearer, Auditor can edit the journal
 * 
 * 
 * 
 * VATABLE SALES
 *  - If VAT (With Vat Exempt Sales)
 *         - Gross Amount minus VAT EXEMPT SALES
 *  - If Vat (w/o Vat exempt sales)
 *         - Gross Amount divided by 1.12
 *  - If Non VAT / AR
 *         - Always 0 (VAT Amount will also be 0)
 *         - VAT EXEMPT SALES = Get value of Gross Amount 
 * 
 * 
 * VAT AMOUNT
 * - 12% of VATABLE Sales
 * 
 * 
 * 
 * BUDGET ALLOCATION VERSION (Budget Request)
 * - 
 *          
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * June 16, 2020
 * - Upon Creation : "Are you sure you want to create this BR"
 * - Remove BDO Reference Number in the view, only put it in the downloadable form
 * - Please tick if you skipped this process
 * 
 * Disbursed Budget -> Requested Budget
 *  - Total Disubrsed Budget (kahit di pa disubrsed)
 *  - Remaining Budget (Use as reference when creating BRs and RFPS)
 * 
 *  CREATE -> REVIEW -> APPROVE -> RELEASE -> DISBURSE
 * - If jessica, meann, brenda -> Sales and Operations Director -> VP For Gen Ops -> Accounts Payable Officer
 * - victor.padojinog.pdem@gmail.com, julie.mendoza.pdem@gmail.com -> gigi.corpuz -> VP For Gen Ops -> AFG Counterpart
 * - elvino.olano@pdem.gmail.com -> Skip
 * - Director for Sales and Operations
 * 
 * 
 * Remarks List should only be opened if there is a "new" remark
 * 
 * Save Changes Text: "Are you sure you want to save this?"
 * BRPD20-0001
 * LQPD20-0001
 * 
 * if Total Excess Budget becomes negative, display 0 and make Total Liquidated Amount Red
 * Liq Journal Module name: BR Liquidation Module
 * 
 * Validator and Recommender cannot edit the Liquidation Journal Model
 * 
 * Liq Journal Cannot be edited anymore once Audited
 * 
 * Once For Clearance and For Auditing, user can convert Liquidation Journal to Excel
 * 
 * Include Due date of Liquidation
 * 
 */

/**
 * June 24, 2020
 * - All signed ce details should have a version attached
 * - Once Disbursed, show Requisition to Disbursement
 * - Validator, Recommender cannot edit Liq. Journal
 * - Add Return function
 * - If cannot edit, use next status ("Validate")
 * - Header depends on opened tab (BR or LQPD)
 * 
 */
