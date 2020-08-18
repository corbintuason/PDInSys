<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\Client;
use App\AccountBrand;
use App\AccountDepartment;

class AccountModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Account 1
        $sample_account = Account::create([
            'registered_name' => "A sample account!",
            'registered_address' => (object)[
                "street" => "Sesame",
                "barangay" => "Brgy",
                "city" => "Pasig",
                "zip_code" => 1600
            ],
            "status" => "Approved",
            "terms_of_payment" => ["First Term"],
            "payment_milestone" => ["First Milestone"],
            "company_tel_number" => ["First Tel Number"],
            "company_email_address" => ["First Email Add"],
            "accreditation_status" => ["First Accred Status"]
        ]); 

            // Brands of Account 1
            AccountBrand::create([
                "name" => "Brand 1",
                "account_id" => 1
                ]);
            // Departments of Account 1
            AccountDepartment::create([
                "name" => "Department 1",
                "account_id" => 1
            ]);
            // Clients of Account 1
            Client::create([
                'salutation' => "Mr", 
                'last_name' => "Last Name",
                'first_name' => "First Name", 
                'designation' => "Here and There", 
                'mobile_number' => 123123123, 
                'local_number' => 134,
                'email_address' => "client@gmail.com", 
                'birthday' => "2020-01-01", 
                'account_id' => 1    
            ]);
    }
}
