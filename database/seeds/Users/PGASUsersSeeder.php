<?php

use Illuminate\Database\Seeder;
use App\User;
class PGASUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deleon_justine = User::create([
            'last_name' => "De Leon",
            'first_name' => "Justine Joy",
            'middle_name' => "Vinarao",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'justine.deleon@pd.com',
            'pd_gmail' => 'justine.deleon@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "A position",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]);
        $deleon_justine->assign("account-creator");
        $deleon_justine->assign('erfp-acknowledger');

        $deguzman_bengie = User::create([
            'last_name' => "De Guzman",
            'first_name' => "Bengie",
            'middle_name' => "Basilio",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'bengie.deguzman@pd.com',
            'pd_gmail' => 'bengie.deguzman@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "Accounts Payable Officer",
                    "job_level" => "3C7"
                ],
            ],
            'password' => Hash::make("password")
        ]); 
        
        $deguzman_bengie->assign('erfp-validator');
        // $deguzman_bengie->assign('erfp-disburser');
    }
}
