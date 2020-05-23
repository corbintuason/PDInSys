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