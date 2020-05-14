<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\Account;
class AccountsAndClientsRolesSeeder extends Seeder
{
    use SeedsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            (object) array("name" => "Creator",
            "ability" => null),
            (object) array("name" => "Approver",
            "ability" => "approve"),
        ];
        $generic_abilities = ["view-all", "view", "create"];

        $this->createRoles($roles, $generic_abilities, Account::class, "account");
        
    } 
}
