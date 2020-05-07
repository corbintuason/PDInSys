<?php

use Illuminate\Database\Seeder;
use App\User;
class CostEstimateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cost_estimate_creator = User::create([
            'last_name' => "Cost Estimate",
            'first_name' => "Creator",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'costestimatecreator@pdem.com',
            'pdem_gmail' => 'costestimatecreator@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Cost Estimate Creator',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $cost_estimate_creator->assign('cost-estimate-creator');
        
        $cost_estimate_reviewer = User::create([
            'last_name' => "Cost Estimate",
            'first_name' => "Reviewer",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'costestimatereviewer@pdem.com',
            'pdem_gmail' => 'costestimatereviewer@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Cost Estimate Reviewer',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $cost_estimate_reviewer->assign('cost-estimate-reviewer');

        $cost_estimate_approver = User::create([
            'last_name' => "Cost Estimate",
            'first_name' => "Approver",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'costestimateapprover@pdem.com',
            'pdem_gmail' => 'costestimateapprover@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Cost Estimate Approver',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $cost_estimate_approver->assign('cost-estimate-approver');

        $cost_estimate_clearer = User::create([
            'last_name' => "Cost Estimate",
            'first_name' => "Clearer",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'costestimateclearer@pdem.com',
            'pdem_gmail' => 'costestimateclearer@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Cost Estimate Clearer',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $cost_estimate_clearer->assign('cost-estimate-clearer');
    }
}
