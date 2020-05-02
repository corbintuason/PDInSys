<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorContributor extends Model
{
    protected $fillable = ['vendor_id', 'contributor_id', 'responsibility'];

    public function user()
    {
        return $this->belongsTo('App\User', 'contributor_id');
    }

    public function vendor()
    {
        return $this->belongsTo("App/Vendor");
    }
}
