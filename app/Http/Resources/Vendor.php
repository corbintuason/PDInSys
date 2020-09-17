<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;

class Vendor extends JsonResource
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

        // ATTRIBUTES
        $response["code"] = $this->code;
        $response['current_handler'] = $this->currentHandler;
        $response['proof_of_liquidation'] = $this->proofOfLiquidation;
        $response['is_process_finished'] = $this->isProcessFinished;

        // GENERIC RELATIONSHIPS
        $response['actions'] = $this->activities->sortBy('created_at');
        $response['contributors'] = ContributorResource::collection($this->contributors);
        $response['remarks'] = RemarkResource::collection($this->remarks);

        return $response;
    }
}
