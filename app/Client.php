<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'salutation', 'last_name', 'first_name', 
        'designation', 'mobile_number', 'local_number',
        'email_address', 'birthday', 'account_id'
    ];
}
