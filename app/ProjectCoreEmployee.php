<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCoreEmployee extends Model
{
    protected $fillable = ['project_id','user_id','type','score_percentage'];
    
}
