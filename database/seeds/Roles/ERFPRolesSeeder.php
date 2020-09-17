<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\ERFP;

class ERFPRolesSeeder extends Seeder
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
                "name" => "Reviewer",
                "ability" => "review"
            ),
            (object) array(
                "name" => "ERFP-Approver",
                "ability" => "erfp-approve"
            ),
            (object) array(
                "name" => "Validator",
                "ability" => "validate"
            ),
            (object) array(
                "name" => "Payment-Approver",
                "ability" => "payment-approve"
            ),
            (object) array(
                "name" => "Disburser",
                "ability" => "disburse"
            ),
            (object) array(
                "name" => "Acknowledger",
                "ability" => "acknowledge"
            ),
            (object) array(
                "name" => "Closer",
                "ability" => "close"
            ),
            
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];

        $role_text = "erfp";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, ERFP::class, $role_text);

    }
}
