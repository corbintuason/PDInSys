<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\VendorsTrait;


class Vendor extends Model
{

    use VendorsTrait, LogsActivity, CausesActivity;

    protected static $logFillable = true;
    protected static $logName = 'Vendor';
    public static $module = 'Vendor Module';

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

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
