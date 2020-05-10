<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class MandateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  mandate Creator

        $mandate_creator = User::create([
            'last_name' => "Mandate",
            'first_name' => "Creator",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'mandatecreator@pdem.com',
            'pdem_gmail' => 'mandatecreator@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Mandate Creator',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $mandate_creator->assign('mandate-creator');

        $mandate_approver = User::create([
            'last_name' => "Mandate",
            'first_name' => "Approver",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'mandateapprover@pdem.com',
            'pdem_gmail' => 'mandateapprover@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Mandate Approver',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $mandate_approver->assign('mandate-approver');
    }
}
