<?php

namespace App\Collections;
use Illuminate\Database\Eloquent\Collection; 

class UserCollection extends Collection 
{ 
   public function whereRole() 
   { 
    $approvers = collect([]);
      foreach($this as $user){
        foreach($user->module_access as $access){
            if($access["name"] == 'PGOS'){
                foreach($access["modules"] as $module){
                    if($module["section"] == 'Accounts and Clients'){
                        foreach($module["features"] as $feature){
                            if($feature["name"] == 'Account and Client Accreditation'){
                                if($feature["role"] == 'Approver'){
                                    $approvers->push($user);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
      return $approvers;
    } 
}