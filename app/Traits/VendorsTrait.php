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
                "responsible" => (object)[
                    'role' => 'vendor-creator',
                    "name" => "create",
                    "entity_type" => "App\Vendor",
                    "entity_id" => true
                ],
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => (object)[
                    'role' => 'vendor-approver',
                    "name" => "approve",
                    "entity_type" => "App\Vendor",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["Approved"],
                "responsible" => null
            ],
            (object) [
                "names" => ["Rejected"],
                "responsible" => null
            ]
        ]);
        return $stages;
    }

    public function getIsProcessFinishedAttribute()
    {
        return $this->status == 'Approved';
    }
}
