<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ModelsTrait {
    
    public function getCurrentHandlerAttribute(){
        $stages = $this->stages;
        // Find a stage where it the status is in one of the names
        foreach($stages as $stage){
            foreach($stage->names as $name){
                if($name == $this->status){
                    $current_stage = $stage;
                break;
                }
            }
        }
        $handler = $current_stage->responsible;
        return $handler;
    }

    // Generic Relationships
    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function remarks(){
        return $this->morphMany("App\Remark", 'remarkable')->with('remarked_by');
    }
}




/* 

Requestion - PMs plus Gigi, Officers and Assistants
Review - JDC/EAO, VMG/CCA/VTM (base on BR) 
       - Cannot Edit, 
       - Can Approve (Can add Remarks), Return, Reject
Approve - VTM, RGA
        - Cannot Edit, 
        - Can Approve (Can add Remarks), Return, Reject
Validation - Accounts Payable Officer
        - Can Edit
       - Can Approve (Can add Remarks), Return, Reject
       - When Approving, prompt pls upload bir \
Payment Approval - VTM (OIC)
        -  Cannot Edit
       - Can Approve (Can add Remarks), Return, Reject
Disbursement - BBG RSB LAP (Accounts Payable Officers)
Acknowledgement - *simply notify requestor
Closing - *close after notified\

*/