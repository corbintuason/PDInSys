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

    public function getProofOfLiquidationAttribute(){
        /**
         * 
         * 
            FINAL_RFPPD20version1
            FINAL_RFPPD20version1
            100%
            8

            =IF(AE15="Not Registered","Acknowledgement Receipt",IF(J15="Goods","Sales Invoice",IF(J15="Services","Official Receipt",IF(J15="","","Official Receipt"))))
            Screen reader support enabled.

         */
        $proof;
         if($this->type_vat == "Not Registered"){
            $proof = "Acknowledgement Receipt";
         }else{
            if($this->line_business == "Goods"){
                $proof = "Sales Invoice";
            }else if($this->line_business == "Services"){
                $proof = "Official Receipt";
            } else if($this->line_business == "Both"){
                $proof = "Official Receipt";
            }
         }
         return $proof;
    }
}
