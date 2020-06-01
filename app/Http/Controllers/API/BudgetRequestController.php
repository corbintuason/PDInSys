<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\BudgetRequest;
use Notification;
use App\Notifications\ItemNotification;
use App\Http\Resources\BudgetRequest as BudgetRequestResource;

class BudgetRequestController extends Controller
{
    use ControllersTrait;

    public function show($id)
    {
        return new BudgetRequestResource(BudgetRequest::findorFail($id));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brable_type' => 'required',
            'brable_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'categories' => 'required',
        ]);
        
        // Clean Form First
        
        $budget_request = $this->createItem($request, BudgetRequest::class, "Budget Request", "budget_request_show");
        Notification::send($this->notifyApprovers($budget_request), new ItemNotification($budget_request, $budget_request::$module, "budget_request_show", $budget_request->id));

        return [
            'item_id' => $budget_request->id,
            'success_text' => "Budget Request " . $budget_request->code . " has been successfully created"
        ];
    }

    public function update(Request $request, $id)
    {
        $budget_request = BudgetRequest::findOrFail($id);
        $this->updateItem($budget_request, BudgetRequest::class, "Budget Request");

        if($request->get("skipped")){
            $this->skipRemark($budget_request, BudgetRequest::class);
        }
        Notification::send($this->notifyApprovers($budget_request), new ItemNotification($budget_request, $budget_request::$module, "budget_reqest_show", $budget_request->id));

        return [
            'item_id' => $budget_request->id,
            'success_text' => "Budget Request " . $budget_request->code . " has been successfully updated"
        ];
        
    }
}
