<?php

use Illuminate\Database\Seeder;

class RFPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RFPRolesSeeder::class);

    }
}
