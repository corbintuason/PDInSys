<?php

namespace App\Traits;

use App\Vendor;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;

trait VendorsTrait
{
    use ModelsTrait;

    public function getCodeAttribute()
    {
        return "VID-" . sprintf('%04d', $this->attributes['id']);
    }

    protected function getStagesAttribute()
    {
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => "vendor-creator"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "vendor-approver"
            ],
            (object) [
                "names" => ["Approved"],
                "responsible" => null
            ],
            (object) [
                "names" => ["", "Rejected"],
                "responsible" => null
            ]
        ]);
        return $stages;
    }
}
