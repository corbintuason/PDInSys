<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Remark as RemarkResource;
use App\Http\Resources\Contributor as ContributorResource;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;

class BudgetAllocation extends JsonResource
{
    use LogsActivity, CausesActivity, ModelsTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        $response['adm_grand_total'] = $this->adm_grand_total;
        $response["relationships"] = [
            'actions' => $this->activities,
            'user' => $this->user,
            'remarks' => RemarkResource::collection($this->remarks),
            'contributors' => ContributorResource::collection($this->contributors),
        ];
        return $response;
    }
}
