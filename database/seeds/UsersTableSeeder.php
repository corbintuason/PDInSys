<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'last_name' => "Super",
            'first_name' => "Admin",
            'middle_name' => "Middle",
            'employment_date' => date("Y/m/d"),
            'birth_date' => date("Y/m/d"),
            'pdem_email' => 'superadmin@pdem.com',
            'pdem_gmail' => 'superadmin@gmail.com',
            'contact_numbers' => json_encode(["09999999999", "01111111"]),
            'job_details' => json_encode([
                "office" => "PGOS",
                "group" => "Creatives Group",
                "department" => "Design and Multimedia",
                "job_level" => "5C"]),
            'password' => Hash::make("password"),
        ]);
    }
}
