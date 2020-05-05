<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostEstimateDetail extends Model
{
    public function cost_estimate(){
        return $this->belongsTo('App\CostEstimate');
    }
}
