<?php

use Illuminate\Database\Seeder;
use App\User;
class ExecutiveUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // von.mauleon.pdem@gmail.com

        $von_mauleon = User::create([
            'last_name' => "Mauleon",
            'first_name' => "Von",
            'middle_name' => "Torres",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'von.mauleon@pd.com',
            'pd_gmail' => 'von.mauleon@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "President",
                    "job_level" => "8"
                ],

            ],
            'password' => Hash::make("password")
        ]);

        // Roles
        $von_mauleon->assign("account-approver");
        $von_mauleon->assign("vendor-approver");
        $von_mauleon->assign("cost-estimate-clearer");
        $von_mauleon->assign("project-approver");
        $von_mauleon->assign('budget-request-releaser');
        $von_mauleon->assign('rfp-closer');

        // biboy.arcilla.pdem@gmail.com

        $biboy_arcilla = User::create([
            'last_name' => "Arcilla",
            'first_name' => "Robbie Boy",
            'middle_name' => "Torres",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pd_email' => 'biboy.arcilla@pd.com',
            'pd_gmail' => 'biboy.arcilla@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => [
                (object)[
                    "name" => "COO/VP for Gen.Operations",
                    "job_level" => "8"
                ],

            ],
            'password' => Hash::make("password")
        ]);

        $biboy_arcilla->assign("cost-estimate-approver");
        $biboy_arcilla->assign("vendor-creator");
        $biboy_arcilla->assign('project-reviewer');
        $biboy_arcilla->assign('budget-request-approver');
        $biboy_arcilla->assign('rfp-acknowledger');



    }
}
