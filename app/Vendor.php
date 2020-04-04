<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'clients' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo("App\User", "creator_id");
    }
}
