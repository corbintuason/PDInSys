<?php

use Illuminate\Database\Seeder;

class CostEstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CostEstimateRolesSeeder::class);
    }
}
