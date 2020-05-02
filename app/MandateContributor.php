<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandateContributor extends Model
{
    protected $fillable = ['mandate_id', 'contributor_id', 'responsibility'];

    public function user()
    {
        return $this->belongsTo('App\User', 'contributor_id');
    }

    public function mandate()
    {
        return $this->belongsTo("App/Mandate");
    }
}
