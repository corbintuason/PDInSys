<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;

trait LiquidationJournalsTrait
{
    use ModelsTrait;
    
    public function getCodeAttribute()
    {
        return "LQPD20-".sprintf('%04d', $this->attributes['id']);
    }

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["For Creation", "Returned to Creator"],
                "responsible" => "budget-request-creator"
            ],
            (object) [
                "names" => ["For Validation", "Returned to Validator"],
                "responsible" => "budget-request-reviewer"
            ],
            (object) [
                "names" => ["For Recommendation", "Returned to Recommender"],
                "responsible" => "budget-request-releaser"
            ],
            (object) [
                "names" => ["For Clearance", "Returned to Clearer"],
                "responsible" => "budget-request-reviewer" 
            ],
            (object) [
                "names" => ["For Auditing", "Returned to Auditor"],
                "responsible" => "budget-request-disburser"
            ],
            (object) [
                "names" => ["Audited"],
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
        return $this->status == 'Audited';
    }

}
