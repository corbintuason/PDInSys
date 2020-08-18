<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectRolesSeeder::class);
        $this->call(ProjectModelsSeeder::class);
    }
}
