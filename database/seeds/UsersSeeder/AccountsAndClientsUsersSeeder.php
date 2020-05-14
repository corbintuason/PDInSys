<?php

use Illuminate\Database\Seeder;
class AccountsAndClientsUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    foreach($roles as $role){
        User::create([
            'last_name' => $role->title,
            'first_name' => $role->name,
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'projectcreator@pdem.com',
            'pdem_gmail' => 'projectcreator@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Project Creator',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        }
    }
}
