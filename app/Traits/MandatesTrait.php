<?php

namespace App\Traits;

use App\Mandate;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;

trait MandatesTrait
{
    use ModelsTrait;

    public function getCodeAttribute()
    {
        return "PMID-" . sprintf('%04d', $this->attributes['id']);
    }

    protected function getStagesAttribute()
    {
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "mandate-creator"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "mandate-approver"
            ],
            (object) [
                "names" => ["Approved"],
                "responsible" => null
            ]
        ]);
        return $stages;
    }
}
