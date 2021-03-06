<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BudgetAllocation;
use App\Http\Resources\BudgetAllocation as BudgetAllocationResource;
use Notification;
use App\Notifications\BudgetAllocationCreated;
use App\Traits\ControllersTrait;

class BudgetAllocationController extends Controller
{
    use ControllersTrait;

    public function index()
    {
        return BudgetAllocationResource::collection(BudgetAllocation::all());
    }

    public function store(Request $request)
    {

        // STATUS IS SET TO FOR APPROVAL
        $auth_user = auth()->user();
        $budget = $this->createItem($request, BudgetAllocation::class, "Budget Allocation", "budget_allocation_show");
        // Notify Process Users
        // Notification::send($this->notifyApprovers($budget), new BudgetAllocationCreated($budget));

        return [
            'item_id' => $budget->id,
            'success_text' => " " . $budget->code . " has been successfully opened"
        ];
    }

    // public function save(Request $request)
    // {
    //     // STATUS IS SET TO FOR APPROVAL
    //     $auth_user = auth()->user();
    //     $budget = $this->saveItem($request, BudgetAllocation::class, "Budget Allocation", "budget_allocation_show");

    //     return [
    //         'item_id' => $budget->id,
    //         'success_text' => "Budget Allocation " . $budget->code . " has been successfully saved"
    //     ];
    // }

    public function show($id)
    {
        return new BudgetAllocationResource(BudgetAllocation::findorFail($id));
    }

    public function update($id)
    {
        $budget = BudgetAllocation::findOrFail($id);
        $auth_user = auth()->user();

        $this->updateItem($budget, BudgetAllocation::class, "Budget Allocation", "budget_allocation_show");


        return [
            'item_id' => $budget->id,
            'success_text' => "Budget Allocation " . $budget->code . " has been successfully updated"
        ];
    }
}
