<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use LogsActivity, CausesActivity;

    protected $fillable = [];
}
