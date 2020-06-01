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
        "categories",
        "isActive"
    ];

    protected $casts = [
        "categories" => "Array"
    ];

    // Relationships
    public function brable(){
        return $this->morphTo();
    }
    
    
}
