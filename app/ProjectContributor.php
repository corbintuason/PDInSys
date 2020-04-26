<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectContributor extends Model
{
    protected $fillable = ['project_id','contributor_id', 'responsibility'];

    public function user()
{
    return $this->belongsTo('App\User', 'contributor_id');
}

    public function project(){
        return $this->belongsTo("App/Project");
    }
}
