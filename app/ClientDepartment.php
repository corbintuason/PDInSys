<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDepartment extends Model
{

    protected $fillable=[
        "client_id", "department_id"
    ];
}
