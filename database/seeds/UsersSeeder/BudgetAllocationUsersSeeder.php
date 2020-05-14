<?php

use Illuminate\Database\Seeder;
use App\User;

class BudgetAllocationUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Budget Allocation Creator

        $budget_allocation_creator = User::create([
            'last_name' => "Budget Allocation",
            'first_name' => "Creator",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'bacreator@pdem.com',
            'pdem_gmail' => 'bacreator@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Budget Allocation Creator',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $budget_allocation_creator->assign('budget-allocation-creator');

        $budget_allocation_receiver = User::create([
            'last_name' => "Head",
            'first_name' => "Admin",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'admbudget@pdem.com',
            'pdem_gmail' => 'admbudget@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Admin Head',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $budget_allocation_receiver->assign('budget-allocation-receiver');

        $budget_allocation_receiver = User::create([
            'last_name' => "Head",
            'first_name' => "Accounting",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'afgbudget@pdem.com',
            'pdem_gmail' => 'afgbudget@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'Accounting Head',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $budget_allocation_receiver->assign('budget-allocation-receiver');

        $budget_allocation_receiver = User::create([
            'last_name' => "Head",
            'first_name' => "HR",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'hrbudget@pdem.com',
            'pdem_gmail' => 'hrbudget@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'HR Head',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $budget_allocation_receiver->assign('budget-allocation-receiver');

        $budget_allocation_receiver = User::create([
            'last_name' => " Gen Ops",
            'first_name' => "VP",
            'middle_name' => "for",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'opsbudget@pdem.com',
            'pdem_gmail' => 'opsbudget@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'VP for Gen Ops',
                    'job_level' => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);
        $budget_allocation_receiver->assign('budget-allocation-receiver');
    }
}
