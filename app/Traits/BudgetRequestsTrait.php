<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
trait BudgetRequestsTrait
{
    use ModelsTrait;
    
    public function getCodeAttribute()
    {
        return "BRPD-".sprintf('%04d', $this->attributes['id']);
    }

    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "budget-request-creator"
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                "responsible" => "budget-request-reviewer"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "budget-request-approver"
            ],
            (object) [
                "names" => ["For Release", "Returned to Releaser"],
                "responsible" => "budget-request-releaser"
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible" => "budget-request-disburser"
            ],
            (object) [
                "names" => ["Disbursed"],
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
        return $this->status == 'Disbursed';
    }

}
