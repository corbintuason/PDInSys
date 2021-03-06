<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
trait AccountsTrait
{
    use ModelsTrait;
    
    public function getCodeAttribute()
    {
        return "ACC-".sprintf('%04d', $this->attributes['id']);
    }

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => (object)[
                    "role" => "account-creator",
                    "name" => "create",
                    "entity_type" => "App\Account",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Approval",  "Returned to Approver"],
                "responsible" => (object)[
                    "role" => "account-approver",
                    "name" => "approve",
                    "entity_type" => "App\Account",
                    "entity_id" => false
                ]
            ],

            (object)[
                "names" => ["Approved"],
                "responsible" => null
            ],
            (object)[
                "names" => ["", "Rejected"],
                 "responsible" => null
            ]
        ]);
        return $stages;
    }

    public function getIsProcessFinishedAttribute(){
        return $this->status == 'Approved';
    }

}
