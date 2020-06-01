<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ExecutiveUsersSeeder::class);
        $this->call(PGOSUsersSeeder::class);
        $this->call(PGASUsersSeeder::class);
    }
}
