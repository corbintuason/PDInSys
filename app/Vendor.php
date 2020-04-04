<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Vendor extends Model
{

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
        'bank_name',
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
        'bank_name' => 'array',
        'clients' => 'array',
        'change_logs' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
