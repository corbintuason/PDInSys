<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelsTrait;
use App\Traits\BudgetRequestsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
class BudgetRequest extends Model
{
    use LogsActivity, CausesActivity, ModelsTrait, BudgetRequestsTrait;

    protected static $logFillable = true; 
    public static $module = 'Budget Request Module';
    protected static $logName = 'Budget Request';

    protected $fillable = [
        "brable_type",
        "brable_id",
        "status",
        "start_date",
        "end_date",
        "entries",
        "ce_number_id",
        "version",
        "isActive",
        "reference_number",
        "br_requestor_id",
        "afg_counterpart_id",
        "rate"
    ];

    protected $casts = [
        "entries" => "Array"
    ];

    // Relationships
    public function brable(){
        return $this->morphTo();
    }

    public function liquidation_journal(){
        return $this->hasOne('App\LiquidationJournal');
    }

    public function cost_estimate_detail(){
        return $this->belongsTo("App\CostEstimateDetail", "ce_number_id");
    }

    public function afg_counterpart(){
        return $this->belongsTo("App\User", "afg_counterpart_id");
    }
    public function br_requestor(){
        return $this->belongsTo("App\User", "br_requestor_id");
    }
    
    
}
