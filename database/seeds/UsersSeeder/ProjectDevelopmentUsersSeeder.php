<?php

use Illuminate\Database\Seeder;
use App\User;
class ProjectDevelopmentUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $project_creator = User::create([
            'last_name' => "Project",
            'first_name' => "Creator",
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

        $project_creator->assign('project-creator');

        $project_reviewer = User::create([
            'last_name' => "Project",
            'first_name' => "Reviewer",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'projectreviewer@pdem.com',
            'pdem_gmail' => 'projectreviewer@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Project Reviewer',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $project_reviewer->assign('project-reviewer');

        $project_approver = User::create([
            'last_name' => "Project",
            'first_name' => "Approver",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'projectapprover@pdem.com',
            'pdem_gmail' => 'projectapprover@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Some Project Approver',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $project_approver->assign('project-approver');

        // Project Assigners
        $head_account_biz = User::create([
            'last_name' => "Head",
            'first_name' => "Account Biz",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'accountbizhead@pdem.com',
            'pdem_gmail' => 'accountbizhead@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Head of Accounts & Biz Development',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $head_account_biz->assign('project-assigner');

        $head_project_execution = User::create([
            'last_name' => "Head",
            'first_name' => "Project Execution",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'projectexecutionhead@pdem.com',
            'pdem_gmail' => 'projectexecutionhead@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Project Execution Head',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $head_project_execution->assign('project-assigner');

        $head_creatives = User::create([
            'last_name' => "Head",
            'first_name' => "Creatives",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'creativeshead@pdem.com',
            'pdem_gmail' => 'creativeshead@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Associate CD - Copy and Digital',
                    'job_level' => '1A'
                ),
                array(
                    "name" => 'Associate CD - Design and Multimedia',
                    'job_level' => '1A'
                ),
            ),
            'password' => Hash::make("password")
        ]);

        $head_creatives->assign('project-assigner');
    }
}
