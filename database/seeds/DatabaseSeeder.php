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
        $this->call(AccountsSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(CostEstimatesSeeder::class);
    }
}
