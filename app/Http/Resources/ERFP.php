<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\ERFPable as ERFPableResource;
use App\Http\Resources\TermOfPayment as TermOfPaymentResource;
use App\Http\Resources\CheckWrite as CheckWriteResource;
use App\Http\Resources\ClosingERFP as ClosingERFPResource;

class ERFP extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
        $response = parent::toArray($request);
        $response["code"] = $this->code;
        // $response["parent"] = $parent_resource;
        $response['current_handler'] = $this->currentHandler;
        $response['is_process_finished'] = $this->isProcessFinished;
        
        $response['term_of_payments'] = TermOfPaymentResource::collection($this->term_of_payments);
        $response['check_writes'] = CheckWriteResource::collection($this->check_writes);
        $response['erfpables'] = ERFPableResource::collection($this->erfpables);
        $response['vendor'] = new VendorResource($this->vendor);
        $response['closing_erfp'] = new ClosingERFPResource($this->closing_erfp);
        $response['actions'] = $this->activities;
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
