<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBrand extends Model
{
    protected $fillable=[
        "client_id", "brand_id"
    ];

    public function account_brand(){
        return $this->belongsTo('App\\AccountBrand', 'brand_id');
    }
}
