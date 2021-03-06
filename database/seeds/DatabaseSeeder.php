<?php

use Illuminate\Database\Seeder;
use App\Account;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(CostEstimateSeeder::class);
        $this->call(BudgetRequestSeeder::class);
        $this->call(VendorSeeder::class);
        $this->call(ERFPSeeder::class);
        $this->call(ERFPableSeeder::class);

        
        $this->call(UsersSeeder::class);
    }
}
