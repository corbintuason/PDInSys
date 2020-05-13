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
        Notification::send($this->notifyApprovers($budget), new BudgetAllocationCreated($budget));

        return [
            'item_id' => $budget->id,
            'success_text' => "Budget Allocation " . $budget->code . " has been successfully opened"
        ];
    }
}
