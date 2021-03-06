<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Traits\MandatesTrait;

class Mandate extends Model
{

    use MandatesTrait, LogsActivity, CausesActivity;

    public static $module = 'Mandate Module';
    protected static $logFillable = true;
    protected static $logName = 'Mandate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'position',
        'full_name',
        'region',
        'permanent_address',
        'present_address',
        'gender',
        'civil_status',
        'birthdate',
        'age',
        'mobile_number',
        'telephone_number',
        'religion',
        'sss_number',
        'tin_number',
        'pagibig_number',
        'philhealth_number',
        'passport_number',
        'tertiary_details',
        'secondary_details',
        'primary_details',
        'work_details',
        'father_details',
        'mother_details',
        'spouse_details',
        'emergency_details',
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
        'full_name' => 'array',
        'tertiary_details' => 'object',
        'secondary_details' => 'object',
        'primary_details' => 'object',
        'work_details' => 'object',
        'father_details' => 'object',
        'mother_details' => 'object',
        'spouse_details' => 'object',
        'emergency_details' => 'object',
        'change_logs' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
