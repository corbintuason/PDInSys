<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountDepartment extends Model
{
    protected $fillable = [
        "account_id", "name"
    ];
}
