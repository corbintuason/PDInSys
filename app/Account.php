<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\AccountsTrait;

class Account extends Model
{

    use AccountsTrait, LogsActivity, CausesActivity;

    public static $module = 'Account Module';
    protected static $logFillable = true; 
    protected static $logName = 'Account';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registered_name',
        'registered_address',
        'registered_tin',
        'status',
        'terms_of_payment',
        'payment_milestone',
        'company_tel_number',
        'company_email_address',
        'accreditation_status',
    ];



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
        'terms_of_payment' => 'array',
        'payment_milestone' => 'array',
        'company_tel_number' => 'array',
        'company_email_address' => 'array',
        'accreditation_status' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }

    public function brands(){
        return $this->hasMany('App\AccountBrand');
    }

    public function departments(){
        return $this->hasMany('App\AccountDepartment');
    }

    public function clients(){
        return $this->hasMany("App\Client");
    }
}
