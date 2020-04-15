<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserRegistered;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Builders\UserBuilder;
use App\Collections\UserCollection;
use Spatie\Permission\Traits\HasRoles;
use App\Vendor;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LogsActivity, CausesActivity, HasRoles;

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }

    public function newEloquentBuilder($builder) 
    { 
       return new UserBuilder($builder); 
    }

    public function newCollection(array $models = []) 
   { 
      return new UserCollection($models); 
   } 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'official_photo', 'birth_date', 'pdem_email', 'pdem_gmail', 'contact_numbers', 'employment_date', 'job_details', 'module_access', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'contact_numbers' => 'array',
        'job_details' => 'object',
        'module_access' => 'array'
    ];

    public function accounts()
    {
        return $this->hasMany("App/Account");
    }

    public function vendors()
    {
        return $this->hasMany("App/Vendor");
    }
}
