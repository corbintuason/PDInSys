<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Vendor extends Model
{

    use LogsActivity, CausesActivity;

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
        'creator_id',
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
    protected static $logName = 'Mandate';

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }

    public function vendor_contributors()
    {
        return $this->hasManyThrough("App\User", 'App\VendorContributor', 'vendor_id', 'id', 'id', 'contributor_id');
    }

    public function contributors()
    {
        return $this->hasMany("App\VendorContributor")->with('user');
    }

    // Vendor Code
    public function getCodeAttribute()
    {
        $year = date("y");
        return $year . "-" . sprintf('%04d', $this->attributes['id']);
    }

    public function remarks()
    {
        return $this->morphMany("App\Remark", 'remarkable')->with('returned_by');
    }
}
