<?php

use Illuminate\Database\Seeder;

class CostEstimatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CostEstimatesRolesSeeder::class);
        $this->call(CostEstimatesUsersSeeder::class);
    }
}
