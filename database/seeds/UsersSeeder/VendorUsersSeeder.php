<?php

use Illuminate\Database\Seeder;
use App\User;
class VendorUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               //  Vendor Creator

               $vendor_creator = User::create([
                'last_name' => "Vendor",
                'first_name' => "Creator",
                'middle_name' => "Middle",
                'employment_date' => date("Y/m/d"),
                'birth_date' => date("Y/m/d"),
                'pdem_email' => 'vendorcreator@pdem.com',
                'pdem_gmail' => 'vendorcreator@gmail.com',
                'contact_numbers' => json_encode(["09999999999", "01111111"]),
                'positions' => array(
                    array(
                        "name" => 'Vendor Creator',
                        'job_level' => '1A'
                    )
                ),
                'password' => Hash::make("password")
            ]);
            $vendor_creator->assign('vendor-creator');

            $vendor_approver = User::create([
                'last_name' => "Vendor",
                'first_name' => "Approver",
                'middle_name' => "Middle",
                'employment_date' => date("Y/m/d"),
                'birth_date' => date("Y/m/d"),
                'pdem_email' => 'vendorapprover@pdem.com',
                'pdem_gmail' => 'vendorapprover@gmail.com',
                'contact_numbers' => json_encode(["09999999999", "01111111"]),
                'positions' => array(
                    array(
                        "name" => 'Vendor Approver',
                        'job_level' => '1A'
                    )
                ),
                'password' => Hash::make("password")
            ]);
    
            $vendor_approver->assign('vendor-approver');
    }
}
