<?php

use Illuminate\Database\Seeder;

class ERFPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ERFPRolesSeeder::class);
        // $this->call(ERFPModelsSeeder::class);
    }
}
