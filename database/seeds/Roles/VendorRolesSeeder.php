<?php

use Illuminate\Database\Seeder;
use App\Traits\SeedsTrait;
use App\Vendor;

class VendorRolesSeeder extends Seeder
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
            (object) array(
                "name" => "Reviewer",
                "ability" => "review"
            ),
            
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];

        $role_text = "vendor";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, Vendor::class, $role_text);

    }
}
