<?php

use Illuminate\Database\Seeder;

class BudgetRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BudgetRequestRolesSeeder::class);

    }
}
