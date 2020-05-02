<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostEstimate extends Model
{
    
    public function contributors(){
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function remarks(){
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }
}
