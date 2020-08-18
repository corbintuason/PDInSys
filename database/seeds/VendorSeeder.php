<?php

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VendorRolesSeeder::class);
        $this->call(VendorModelsSeeder::class);
    }
}
