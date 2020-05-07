<?php

use Illuminate\Database\Seeder;
use App\User;
// use Bouncer;
class RolesSeeder extends Seeder
{
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
                // Accounts and Clients
                $this->call(AccountsAndClientsRolesSeeder::class);
                // Project Development 
                $this->call(ProjectDevelopmentRolesSeeder::class);
                // Mandate Seeder
                $this->call(MandateRolesSeeder::class);
                // Project List - Create Project (CRUD)
                // Vendor Accreditation
                $this->call(VendorAccreditationRolesSeeder::class);

                $this->call(CostEstimatesRolesSeeder::class);

                Bouncer::allow('super-admin')->everything();
        }
}
