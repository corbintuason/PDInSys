<?php

namespace App\Traits;

use App\RFP;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Traits\ModelsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

trait ERFPsTrait
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;
    
    protected static $logFillable = true; 
    public static $module = 'ERFP Module';
    protected static $logName = 'RFP';

    public function getCodeAttribute()
    {
        $year = date("y");
        return "ERFP".$year."-".sprintf('%04d', $this->attributes['id']);
    }
    
    protected function getStagesAttribute(){
        $stages = collect([
            (object) [
                "names" => ["", "Returned to Creator"],
                "responsible" => (object)[
                    "role" => "erfp-creator",
                    "name" => "create",
                    "entity_type" => "App\ERFP",
                    "entity_id" => true
                ]
            ],
            (object) [
                "names" => ["For Review", "Returned to Reviewer"],
                // "responsible" => "budget-request-reviewer"
                "responsible" => (object)[
                    "role" => "erfp-reviewer",
                    "name" => "review",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For ERFP Approval", "Returned to Approver"],
                "responsible" => (object)[
                    "role" => "erfp-erfp-approver",
                    "name" => "erfp-approve",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ]
            ],
            (object) [
                "names" => ["For Validation", "Returned to Validator"],
                "responsible" => (object)[
                    "role" => "erfp-validator",
                    "name" => "validate",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Payment Approval", "Returned to Payment Approver"],
                "responsible" => (object)[
                    "role" => "erfp-payment-approver",
                    "name" => "payment-approve",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Disbursement", "Returned to Disburser"],
                "responsible" => (object)[
                    "role" => "erfp-disburser",
                    "name" => "disburse",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Acknowledgement", "Returned to Acknowledger"],
                "responsible" => (object)[
                    "role" => "erfp-acknowledger",
                    "name" => "acknowledge",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object) [
                "names" => ["For Closing", "Returned to Closer"],
                "responsible" => (object)[
                    "role" => "erfp-closer",
                    "name" => "close",
                    "entity_type" => "App\ERFP",
                    "entity_id" => false
                ],
            ],
            (object)[
                "names" => ["Closed"],
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
        return $this->status == 'Closed';
    }

    // Formulas


    /**
     *  Total Sales 
        FORMULA:
        If(vat_amount == 0) return 0
        else return VATABLE Sales + Vat Amount
     */

    public function getTotalSalesAttribute(){
        if($this->vat_amount == 0 ){
            return 0;
        }else{
            return $this->vatable_sales + $this->vat_amount;
        }
    }

    /**
     * 	Formula:
        if(vat registered){
            vatable sales * 0.12
        } else {
            0
        }
     */

    public function getVatAmountAttribute(){
        $vat_amount = 0;
        if($this->vendor->type_vat == 'VAT'){
            $vat_amount = $this->vatable_sales * 0.12;
        }
        return $vat_amount;
    }

        /**
    VATable Sales
    FORMULA:
    if(vat registered){
        (Gross Amount - Vat Exempt Sales - Vat Zero Rated Sales)/1.12
    } else{
        0
    }
     * 
     */

    public function getVatableSalesAttribute(){
        $vatable_sales = 0;
        if($this->vendor->type_vat == 'VAT'){
            $vatable_sales = ($this->gross_amount - $this->vat_exempt_sales - $this->vat_zero_rated_sales)/1.12;
        }
        return $vatable_sales;
    }

        /**
     *  Total Sales 
          FORMULA:
          Total Sales - Less Vat Amount
     */

    public function getTotalDueAttribute(){
        return $this->total_sales - $this->vat_amount;
    }

    /**
     *  Witholding TAX 
        =IF(vat_type="VAT Registered",
        value if vat registered:
        (IF(AD72="",(IFERROR((Z68*AB72),0)),(Z68*AD72))),
        value if not vat registered
        IF(AD72="",(IFERROR((Z88*AB72),0)),(Z88*AD72)))

        var used_percentage = total;
        var used_amount = total;

        if(may laman override){
            used_percentage = override;
        }
        if(vat_type != "Vat registered"){
            used_amount = gross_amount;
        }

        return used_amount*used_percentage
     * 
     */
    public function getWitholdingTaxAttribute(){
        $used_percentage = $this->vendor->ewt_details[0]->detail->percent;
        $used_amount = $this->total_due;
        
        if($this->override!=null){
            $used_percentage = $this->override;
        }

        if($this->vendor->type_vat != 'VAT'){
            $used_amount = $this->gross_amount;
        }

        return $used_amount*$used_percentage;
    }

        /**
     * Gross Amount 
        Formula
        Billing Amount - Down Payment Gross Amount
     */

    public function getGrossAmountAttribute(){
        return $this->billing_amount;
    }
    /**
     * 	FORMULA:
        if(vat registered){
            total due - witholding tax
        } else {
            0
        }
     * 
     */
    public function getAmountDueAttribute(){
        $amount_due = 0;
        if($this->vendor->type_vat == 'VAT'){
            $amount_due = $this->total_due - $this->witholding_tax;
        }
        return $amount_due;
    }

       /**
     	Total Amount Due
        FORMULA:
        Amount due + VAT Amount
     * 
     */

    public function getTotalAmountDueAttribute(){
        return $this->amount_due + $this->vat_amount;
    }

    /**
     * NET Amount
    Formula: Gross Amount - E-WHT   
     */

    public function getNetAmountAttribute(){
        return $this->gross_amount - $this->witholding_tax;
    }

    

    





    



}
