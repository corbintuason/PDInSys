<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Contributor as ContributorResource;
use App\Http\Resources\ERFP as ERFPResource;

class TermOfPayment extends JsonResource
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
        $response['code'] = $this->code;
        $response['history_logs'] = $this->history_logs;

        $response['contributors'] = ContributorResource::collection($this->contributors);
        return $response;
    }

}
