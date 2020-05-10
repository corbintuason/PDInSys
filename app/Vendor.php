<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\ModelsTrait;


class Vendor extends Model
{

    use LogsActivity, CausesActivity, ModelsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_name',
        'trade_name',
        'registered_address',
        'type_business',
        'line_business',
        'contact_person',
        'contact_number',
        'email_address',
        'bank_details',
        'tin_number',
        'type_vat',
        'ewt_details',
        'status',
        'change_logs'
    ];

    //
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'registered_address' => 'object',
        'contact_person' => 'array',
        'bank_details' => 'object',
        'ewt_details' => 'object',
        'clients' => 'array',
        'change_logs' => 'array'
    ];

    protected static $logFillable = true;
    protected static $logName = 'Vendor';

    protected function getStagesAttribute()
    {
        $stages = collect([
            (object) [
                "names" => ["Returned to Creator"],
                "responsible" => "vendor-creator"
            ],
            (object) [
                "names" => ["For Approval", "Returned to Approver"],
                "responsible" => "vendor-approver"
            ], (object) [
                "names" => ["Approved"],
                "responsible" => "vendor-creator"
            ]
        ]);
        return $stages;
    }

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }

    public function contributors()
    {
        return $this->morphMany("App\Contributor", 'contributable')->with('user');
    }

    public function remarks()
    {
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }

    // Vendor Code
    public function getCodeAttribute()
    {
        $year = date("y");
        return $year . "-" . sprintf('%04d', $this->attributes['id']);
    }
}
