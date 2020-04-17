<?php

use Illuminate\Database\Seeder;
use App\User;
// use Bouncer;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Accounts and Clients
        $this->call(AccountsAndClientsRolesSeeder::class);
        // Project Development 
        $this->call(ProjectDevelopmentRolesSeeder::class);
        // Project List - Create Project (CRUD)

        Bouncer::allow('super-admin')->everything();
        $user = User::first();
        $user->assign('super-admin');
    }
}
