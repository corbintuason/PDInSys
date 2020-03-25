<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'registered_name',
        'registered_address',
        'registered_tin',
        'terms_of_payment',
        'payment_milestone',
        'company_tel_number',
        'company_email_address',
        'accrediation_status',
        "brands",
        "departments",
        'clients'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'registered_address' => 'object',
        'terms_of_payment' => 'array',
        'payment_milestone' => 'array',
        'company_tel_number'=> 'array',
        'company_email_address'=> 'array',
        'accrediation_status'=> 'array',
        'brands'=> 'array',
        'departments'=> 'array',
        'clients'=> 'array',
    ];

}
