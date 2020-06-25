<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelsTrait;
use App\Traits\LiquidationJournalsTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class LiquidationJournal extends Model
{
    use LogsActivity, CausesActivity, ModelsTrait, LiquidationJournalsTrait;

    protected static $logFillable = true; 
    public static $module = 'Liquidation Journal Module';
    protected static $logName = 'Liquidation Journal';

    protected $fillable = [
        "budget_request_id",
        "status",
        "entries"
    ];

    protected $casts = [
        "entries" => "Array"
    ];

    public function budget_request(){
        return $this->belongsTo("App\BudgetRequest");
    }
}
