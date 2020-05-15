<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountBrand extends Model
{
    protected $fillable = [
        "account_id", "name"
    ];
}
