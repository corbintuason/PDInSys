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
    public function client_brands(){
        return $this->hasMany('App\\ClientBrand', 'client_id')->with('account_brand');
    }

    public function brands(){
        return $this->hasManyThrough('App\\AccountBrand', 'App\\ClientBrand', 'client_id', 'account_id');
    }   

    public function departments(){
        return $this->hasManyThrough('App\\AccountDepartment', 'App\\ClientDepartment', 'client_id', 'account_id');
    }
}
