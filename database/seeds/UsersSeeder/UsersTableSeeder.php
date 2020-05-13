<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectDevelopmentUsersSeeder::class);
        $this->call(CostEstimateUsersSeeder::class);
        $this->call(VendorUsersSeeder::class);
        $this->call(MandateUsersSeeder::class);
        $this->call(BudgetAllocationUsersSeeder::class);

        $super_admin = User::create([
            'last_name' => "Super",
            'first_name' => "Admin",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'superadmin@pdem.com',
            'pdem_gmail' => 'superadmin@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'positions' => array(
                array(
                    "name" => 'President, CEO',
                    'job_level' => '1A'
                ),
                array(
                    "name" => 'Standing Officer',
                    "job_level" => '1A'
                )
            ),
            'password' => Hash::make("password")
        ]);

        $super_admin->assign('super-admin');
    }
}
