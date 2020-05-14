<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
class AccountsUsersRolesSeeder extends Seeder
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
            (object) array("name" => "Creator",
            "ability" => null),
            (object) array("name" => "Approver",
            "ability" => "approve"),
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];
        
        // Will primarily be used in the email (role_text will be combined with the role title i.e 'accountcreator@pdem.com')
        $role_text = "account";
        
        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, "App\Account", $role_text);
        
        // Create Users
        $this->createUsers($bouncer_roles, "Account");
    
    }
}
