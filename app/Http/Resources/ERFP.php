<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\ERFPable as ERFPableResource;

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
        
        // Formulas
        // $response['total_sales'] = $this->totalSales;
        // $response['vat_amount'] = $this->vat_amount;
        // $response['vatable_sales'] = $this->vatable_sales;
        // $response['total_due'] = $this->total_due;
        // $response['witholding_tax'] = $this->witholding_tax;
        // $response['gross_amount'] = $this->gross_amount;
        // $response['amount_due'] = $this->amount_due;
        // $response['total_amount_due'] = $this->total_amount_due;    
        // $response['gross_amount'] = $this->gross_amount;
        // $response['net_amount'] = $this->net_amount;
        $response['erfpables'] = ERFPableResource::collection($this->erfpables);

        $response['vendor'] = new VendorResource($this->vendor);
        $response['actions'] = $this->activities;
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
