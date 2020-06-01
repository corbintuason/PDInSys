<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\Account;
class AccountRolesSeeder extends Seeder
{
    use SeedsTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define Roles
        $roles = [
            (object) array(
                "name" => "Creator",
                "ability" => null
            ),
            (object) array(
                "name" => "Approver",
                "ability" => "approve"
            ),
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];

        $role_text = "account";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, Account::class, $role_text);

    }
}
