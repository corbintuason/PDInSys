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
            Bouncer::allow($user_role)->to($user_abilities, $class);
        }

        return Bouncer::role()->where('entity', $class)->get();
    }

    public function createUsers($role, $users)
    {
        foreach ($users as $user) {
            $user = User::firstOrCreate([
                'pd_email' => $user->mail.'@pd.com'
            ],[
                'last_name' => $user->last_name,
                'first_name' => $user->first_name,
                'middle_name' => $user->middle_name,
                'employment_date' => date("Y/m/d"),
                'birth_date' => date("Y/m/d"),
                'pd_email' => $user->mail . '@pd.com',
                'pd_gmail' => $user->mail . '@gmail.com',
                'contact_numbers' => json_encode(["09999999999", "01111111"]),
                'positions' => array(
                    array(
                        "name" => "Position",
                        'job_level' => '1A'
                    )
                ),
                'password' => Hash::make("password")
            ]);
            $user->assign($role);
        }
    }
}
