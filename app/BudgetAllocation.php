<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetAllocation extends Model
{

    protected $fillable = [
        'adm_cost_centers',
        'acc_cost_centers',
        'bod_cost_centers',
        'hum_cost_centers',
        'ops_cost_centers',
    ];

    protected $casts = [
        'adm_cost_centers' => 'object',
        'acc_cost_centers' => 'object',
        'bod_cost_centers' => 'object',
        'hum_cost_centers' => 'object',
        'ops_cost_centers' => 'object',
    ];

    public function getAdmGrandTotalAttribute()
    {
    }


    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
