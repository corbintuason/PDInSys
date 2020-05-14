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
                $this->call(AccountsAndClientsRolesSeeder::class);
                $this->call(ProjectDevelopmentRolesSeeder::class);
                $this->call(MandateRolesSeeder::class);
                $this->call(VendorAccreditationRolesSeeder::class);
                $this->call(BudgetAllocationRolesSeeder::class);
                $this->call(CostEstimatesRolesSeeder::class);

                Bouncer::allow('super-admin')->everything();
        }
}
