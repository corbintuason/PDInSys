<?php

use Illuminate\Database\Seeder;

class ERFPableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ERFPableRolesSeeder::class);

    }
}
