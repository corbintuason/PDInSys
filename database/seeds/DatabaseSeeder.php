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
        $this->call(AccountsUsersRolesSeeder::class);
        $this->call(ProjectsUsersRolesSeeder::class);
        $this->call(MandatesUsersRolesSeeder::class);
    }
}
