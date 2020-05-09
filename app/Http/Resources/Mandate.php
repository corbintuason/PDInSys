<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\Remark as RemarkResource;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;
class Mandate extends JsonResource
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
        $response["code"] = $this->code;
        $response['current_handler'] = $this->currentHandler;
        $response["relationships"] = [
            'actions' => $this->activities,
            'user' => $this->user,
            'contributors' => ContributorResource::collection($this->contributors),
            'remarks' => RemarkResource::collection($this->remarks),
            'actions' => $this->actions
        ];
        return $response;
    }
}
