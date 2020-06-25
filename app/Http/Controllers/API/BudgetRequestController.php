<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\BudgetRequest;
use Notification;
use App\Notifications\ItemNotification;
use App\LiquidationJournal;
use App\Http\Resources\BudgetRequest as BudgetRequestResource;
use PDF;
use Bouncer;
Use App\User;
class BudgetRequestController extends Controller
{
    use ControllersTrait;

    public function index(Request $request){
        $budget_requests = BudgetRequest::query();
        $brable_type = $request->get('brable_type');
        $brable_id = $request->get('brable_id');

        if($brable_type){
            $budget_requests->where('brable_type', $brable_type);
        }
        if($brable_id){
            $budget_requests->where('brable_id', $brable_id);
        }

        return BudgetRequestResource::collection($budget_requests->get());

    }
    public function show($id)
    {
        return new BudgetRequestResource(BudgetRequest::findorFail($id));
    }

    public function download($id){
        $budget_request = new BudgetRequestResource(BudgetRequest::findOrFail($id));
        $data = [
            "budget_request" => $budget_request
        ];
        $pdf = PDF::loadView('pdf.budget-request', $data);
        return $pdf->download('budget-request.pdf');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brable_type' => 'required',
            'ce_number_id' => 'required',
            'brable_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'entries' => 'required',
            'reviewer' => 'required'
        ]);
        // Make sure logged in user will be used 
        $request['br_requestor_id'] = auth()->user()->id;
        $budget_request = $this->createItem($request, BudgetRequest::class, "Budget Request", false);
        
        // Assign Reviewer
        $reviewer = User::findOrFail($request->reviewer);
        Bouncer::allow($reviewer)->to('review', $budget_request);

        // Notify
        Notification::send($reviewer, new ItemNotification($budget_request, $budget_request::$module, "budget_request_show", $budget_request->id));
        
     
        // If Budget Request Process is Finished
        if($budget_request->isProcessFinished){
            LiquidationJournal::create([
                'budget_request_id' => $budget_request->id,
                'status' => "For Creation",
                'entries' => [
                    (object)[
                        "vat_exempt_sales" => 0
                    ]
                ]
            ]);
        }

        return [
            'item_id' => $budget_request->id,
            'success_text' => "Budget Request " . $budget_request->code . " has been successfully created"
        ];
    }

    public function update(Request $request, $id)
    {
        $budget_request = BudgetRequest::findOrFail($id);
        $this->updateItem($budget_request, BudgetRequest::class, "Budget Request", $request, true);
        if($request->get('afg_counterpart_id')){
            $budget_request->update([
                "afg_counterpart_id" => $request->get("afg_counterpart_id")
            ]);
        }
        if($request->get('reference_number')){
            $budget_request->update([
                "reference_number" => $request->get("reference_number")
            ]);
        }
        if($request->get('rate')){
            $budget_request->update([
                'rate' => $request->get('rate')
            ]);
        }
        if($budget_request->status == 'For Disbursement'){
            $afg_counterpart = User::findOrFail($budget_request->afg_counterpart_id);
            Bouncer::allow($afg_counterpart)->to('disburse', $budget_request);
            Notification::send($afg_counterpart, new ItemNotification($budget_request, $budget_request::$module, "budget_request_show", $budget_request->id));
        }
        Notification::send($this->notifyApprovers($budget_request), new ItemNotification($budget_request, $budget_request::$module, "budget_request_show", $budget_request->id));
        
        if($budget_request->isProcessFinished){
            LiquidationJournal::create([
                'budget_request_id' => $budget_request->id,
                'status' => "For Creation",
                "entries" => []
            ]);
        }

        return [
            'item_id' => $budget_request->id,
            'success_text' => "Budget Request " . $budget_request->code . " has been successfully updated"
        ];
        
    }

    public function saveChanges(Request $request, $id){
        // Update First the Cost Estimate Detail
        $budget_request = BudgetRequest::findOrFail($id);
        // $update_fields = $this->filterForUpdating($cost_estimate_detail, $new_cost_estimate_detail);
        
        $budget_request->update($request->all());

        // Update status of Cost Estimate Detail
        $this->updateItem($budget_request, BudgetRequest::class, "Budget Request", $request, true);
        // $budget_request->update([
        //     'status' => $this->getCreateStatus($request, BudgetRequest::class)
        // ]);

        return [
            'refresh' => true,
            'success_text' => $budget_request->code . " has been successfully updated."
        ];
        
    }
}
