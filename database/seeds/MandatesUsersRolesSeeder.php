<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;

class MandatesUsersRolesSeeder extends Seeder
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
        $generic_abilities = ["view-all", "view", "create"];

        // Will primarily be used in the email (role_text will be combined with the role title i.e 'mandatecreator@pd.com')
        $role_text = "mandate";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, "App\Mandate", $role_text);

        // Create Users
        $this->createUsers($bouncer_roles, "Mandate");
    }
}
