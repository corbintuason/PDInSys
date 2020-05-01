<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $fillable = ['contributable_type','contributable_id', 'contributor_id', 'responsibility'];


    public function contributable(){
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'contributor_id');
    }
}
