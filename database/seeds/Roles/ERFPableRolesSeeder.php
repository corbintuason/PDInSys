<?php

use Illuminate\Database\Seeder;
use App\ERFPable;
use App\Traits\SeedsTrait;

class ERFPableRolesSeeder extends Seeder
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
        ];

        // Define Generic Abilities
        $generic_abilities = ["view-all", "view", "create"];

        $role_text = "erfpable";

        // Create Roles
        $bouncer_roles = $this->createRoles($roles, $generic_abilities, ERFPable::class, $role_text);

    }
}
