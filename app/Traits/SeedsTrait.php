<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Bouncer;
use Hash;
use App\User;

trait SeedsTrait
{
    public function createRoles($roles, $generic_abilities, $class, $model_name)
    {
        foreach ($roles as $role) {
            $user_role = Bouncer::role()->firstOrCreate([
                'name' => $model_name . "-" . strtolower($role->name),
                'title' => $role->name,
                'entity' => $class
            ]);

            $user_abilities = $generic_abilities;
            if ($role->ability != null) {
                array_push($user_abilities, $role->ability);
            }
            $bouncer_role = Bouncer::allow($user_role)->to($user_abilities, $class);  
        }
        return Bouncer::role()->where('entity', $class)->get();
    }
}
